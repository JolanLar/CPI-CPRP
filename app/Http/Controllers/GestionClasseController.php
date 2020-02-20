<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionClasseController extends Controller
{

    /**
     * Liste toutes les classes, les étudiants, et les étudiants réliés aux classe
     * @return retour page avec les variables
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
        $lesClasses = App\AnneeEtude::all();
        $lesEtudiants = App\Etudiant::join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiant.idUtilisateur')
            ->get();

        $lesEtudiantsClasse = App\EtudiantAnnee::join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->get();

        $lesAnnees = App\AnneeScolaire::all();

        return view('back/formulairegestionclasse', compact('lesAnnees', 'lesClasses', 'lesEtudiants', 'lesEtudiantsClasse'));
    }

    /**
     * Liste les étudiants pour une classe spécifique
     * @return retour les étudiants
     */
    public function majBDD(Request $request)
    {
        $laFiliere = $request->selectgestionclasse;

        $lesEtudiantsClasse = App\EtudiantAnnee::select('etudiantannee.idUtilisateur', 'utilisateur.nom', 'utilisateur.prenom', 'anneeetude.*')
            ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->join('filiere', 'anneeetude.idFiliere', '=', 'filiere.idFiliere')
            ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
            ->where('libelleAnneeEtude', $laFiliere)
            ->get();

        return $lesEtudiantsClasse;
    }

    /**
     * Ajoute les étudiants pour une classe spécifique
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $idAnneeEtude = request('selectgestionclasse');

        $error = "";
        $message = "";
        $classe = request('selectgestionclasse');
        $id = explode(" : ", request('selectgestionutilisateur'));
        $annee = request('selectgestionclasseannee');

        $siexistant = App\EtudiantAnnee::where('idUtilisateur', $id[0])
            ->first();

        if ($siexistant == null) {
            $etudiantannee = new App\EtudiantAnnee;
            $etudiantannee->idUtilisateur = $id[0];
            $etudiantannee->annee = $annee;
            $etudiantannee->idAnneeEtude = $idAnneeEtude;
            $etudiantannee->save();
            $libelleClasse = App\AnneeEtude::where('idAnneeEtude', $idAnneeEtude)->first();
            $message = "Etudiant ajouté à la classe " . $libelleClasse->libelleAnneeEtude;
        } else {
            $error = "Etudiant déjà dans une classe";
        }
        return back()->withError($error)->withSuccess($message);
    }

    /**
     * Ajoute les étudiants pour une classe spécifique
     * @return retour avec message
     * @param char $id idUtilisateur
     */
    public function supprimer($id)
    {
        App\EtudiantAnnee::where('idUtilisateur', $id)
            ->delete();
        $message = "Etudiant supprimé de la classe";

        return back()->withSuccess($message);
    }
}
