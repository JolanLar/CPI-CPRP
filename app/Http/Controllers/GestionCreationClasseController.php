<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionCreationClasseController extends Controller
{
    /**
     *
     * Liste toutes les filieres et classes
     * @return retour page avec les filieres et classes
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
        $lesFilieres = App\Filiere::all();

        $find = false;
        foreach ($lesClasses as $i => $uneClasse) {
            if ($i + 1 != $uneClasse->idAnneeEtude) {
                $idAjout = $i;
                $find = true;
            }
        }
        if ($find == false) {
            $idAjout = count($lesClasses) + 1;
        }

        return view('back/formulairegestioncreationclasse', compact('lesClasses', 'lesFilieres', 'idAjout'));
    }

    /**
     * Liste les étudiants pour une classe spécifique
     * @return retour les étudiants
     */
    public function oneClasse(Request $request)
    {
        $laClasse = $request->classe;
        return App\AnneeEtudeFiliere::join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
            ->where('anneeetudefiliere.idAnneeEtude', $laClasse)
            ->get();
    }

    /*
     * @param nothing
     *
     * @return array
     */
    public function liste() {
        $lesClasse = App\AnneeEtude::all();
        return $lesClasse;
    }

    /**
     * Ajoute un étudiant dans une classe
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $idAnnee = request('selectcreationclasse');
        $filiere = request('selectfiliereassociee');
        $libelle = request('idnomclasse');
        $message = "";
        $error = "";
        $laClasse = App\AnneeEtude::where('idAnneeEtude', $idAnnee)->first();

        if (isset($laClasse)) {
            App\AnneeEtude::where('idAnneeEtude', $idAnnee)->update(['libelleAnneeEtude' => $libelle]);

            if ( is_array($filiere) ) {
                    App\AnneeEtudeFiliere::where('idAnneeEtude', $idAnnee)->delete();

                foreach ($filiere as $fil) {
                    $anneeetudefiliere = new App\AnneeEtudeFiliere;
                    $anneeetudefiliere->idAnneeEtude = $idAnnee;
                    $anneeetudefiliere->idFiliere = $fil;
                    $anneeetudefiliere->save();
                }

            } else {
                App\AnneeEtudeFiliere::where('idAnneeEtude', $idAnnee)->delete();
                $anneeetudefiliere = new App\AnneeEtudeFiliere;
                $anneeetudefiliere->idAnneeEtude = $idAnnee;
                $anneeetudefiliere->idFiliere = $filiere;
                $anneeetudefiliere->save();
            }

            $message = "La classe à bien été modifié !";

        } else {

            if( empty($filiere) ) {
                $error = 'Erreur vous devez choisir au moins une filière !';
                } else {
                // Insertion daans anneeetude
                $anneeetude = new App\AnneeEtude;
                $anneeetude->idAnneeEtude = $idAnnee;
                $anneeetude->libelleAnneeEtude = $libelle;
                $anneeetude->save();
                // Insertion dans anneeetudefilière
                foreach ($filiere as $fil) {
                    $anneeetudefiliere = new App\AnneeEtudeFiliere;
                    $anneeetudefiliere->idAnneeEtude = $idAnnee;
                    $anneeetudefiliere->idFiliere = $fil;
                    $anneeetudefiliere->save();
            }
                $message = "La classe à bien été crée !";
            }

        }
        return $message;
    }

    /**
     * Supprime un étudiant d'une classe
     * @param Request $request
     * @return string
     */
    public function delete(Request $request)
    {

        $classe = App\AnneeEtude::where('idAnneeEtude', $request->idAnneeEtude)->first();
        $notations = App\Notation::where('idAnneeEtude', $request->idAnneeEtude)->get();
        foreach ($notations as $notation) {
            App\NotationIndicateur::where('idNotation', $notation->idNotation)->delete();
        }

        App\Notation::where('idAnneeEtude', $request->idAnneeEtude)->delete();
        App\AnneeEtudeFiliere::where('idAnneeEtude', $request->idAnneeEtude)->delete();
        App\AnneeEtude::where('idAnneeEtude', $request->idAnneeEtude)->delete();

        return "La classe " . $classe->libelleAnneeEtude . " à bien été supprimé !";
    }
}
