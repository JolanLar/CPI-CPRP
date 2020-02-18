<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;


class GestionUtilisateurController extends Controller
{
    /**
     * Liste toutes les filieres et utilisateurs
     * @return retour page avec les utilisateurs et filières
     */
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 1) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }
        $lesFilieres = App\Filiere::all();
        $lesUtilisateurs = App\Utilisateur::all();

        return view('back/formulairegestionutilisateur', compact('lesUtilisateurs', 'lesFilieres'));
    }

    /**
     * Recupere le droit d'un utilisateur specifique
     * @return retour droit de l'utilisateur
     */
    public function majBDD(Request $request)
    {
        $id = $request->idUtilisateur;
        $Utilisateur = App\Utilisateur::select('Droit')
            ->where('idUtilisateur', $id)
            ->first();

        return $Utilisateur->Droit;
    }

    /**
     * Supprime un utilisateur, si c'est un etudiant, supprime l'etudiant et son année d'étude
     * @return message
     */
    public function supprimer(Request $request)
    {
        $id = $request->idUtilisateur;

        App\EtudiantAnnee::where('idUtilisateur', $id)
            ->delete();
        App\Etudiant::where('idUtilisateur', $id)
            ->delete();
        App\Utilisateur::where('idUtilisateur', $id)
            ->delete();

        return "Utilisateur supprimé";
    }

    /**
     * Ajoute/Modifie un utilisateur
     * @return retour avec message/erreur
     */
    public function creation()
    {
        if (request('etudiantrole') === "Professeur")
            $role = "5";

        else if (request('etudiantrole') === "Administrateur")
            $role = "1";

        else if (request('etudiantrole') === "Etudiant")
            $role = "10";

        $error = "";
        $message = "";

        $nom = request('nomutilisateur');
        $prenom = request('prenomutilisateur');
        $login = substr($prenom, 0, 3);
        $login .= strtolower($nom);
        $laupdate = request('selectutilisateur');

        $siexiste = App\Utilisateur::where('idUtilisateur', $login)
            ->first();

        $caractere = '';
        $chaine = '';

        if ($laupdate == "Nouvel utilisateur") {
            $listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $listeCar2 = '0123456789abcdefghijklmnopqrstuvwxyz';
            $chaine = '';
            $max = mb_strlen($listeCar, '8bit') - 1;
            $max2 = mb_strlen($listeCar2, '8bit') - 1;
            for ($i = 0; $i < 5; ++$i) {
                $chaine .= $listeCar[random_int(0, $max)];
            }
            $caractere =  $listeCar2[random_int(0, $max2)];


            if ($siexiste == null) {
                $utilisateur = new App\Utilisateur;
                $utilisateur->Nom = strtoupper($nom);
                $utilisateur->Prenom = ucfirst($prenom);
                $utilisateur->Droit = $role;
                $utilisateur->idUtilisateur = strtolower($login);
                $utilisateur->mdpUtilisateur = sha1($chaine);
                $utilisateur->save();
                $message = "Utilisateur ajouté";

                if (request('etudiantrole') === "Etudiant") {
                    $utilisateur = new App\Etudiant;
                    $utilisateur->idUtilisateur = strtolower($login);
                    $utilisateur->save();
                }
            } else {
                $utilisateur = new App\Utilisateur;
                $utilisateur->Nom = strtoupper($nom);
                $utilisateur->Prenom = ucfirst($prenom);
                $utilisateur->Droit = $role;
                $utilisateur->idUtilisateur = strtolower($login) . $caractere;
                $utilisateur->mdpUtilisateur = sha1($chaine);
                $utilisateur->save();
                $message = "Utilisateur ajouté";

                if (request('etudiantrole') === "Etudiant") {
                    $utilisateur = new App\Etudiant;
                    $utilisateur->idUtilisateur = strtolower($login) . $caractere;
                    $utilisateur->save();
                }
            }
            if ($siexiste == null) {
                $message = "$message \n Utilisateur : $login \n Mot de passe : $chaine";
            } else {
                $message = "$message \n Utilisateur : $login$caractere \n Mot de passe : $chaine";
            }
        } else {
            try {
                App\Utilisateur::where('idUtilisateur', strtolower($login))
                    ->update(['Nom' => strtoupper($nom), 'Prenom' => ucfirst($prenom), 'Droit' => $role]);

                if (request('etudiantrole') === "Etudiant") {
                    $siexiste2 = App\Etudiant::where('idUtilisateur', strtolower($login))
                        ->first();
                    if ($siexiste2 == null) {
                        $utilisateur = new App\Etudiant;
                        $utilisateur->idUtilisateur = strtolower($login);
                        $utilisateur->save();
                    }
                } else {
                    App\EtudiantAnnee::where('idUtilisateur', $login)
                        ->delete();

                    App\Etudiant::where('idUtilisateur', $login)
                        ->delete();
                }
            } catch (\Illuminate\Database\QueryException $e) {
                dd($e);
            }
            $message = "Utilisateur modifié";
        }


        return back()
            ->withError($error)
            ->withSuccess($message);
    }
}
