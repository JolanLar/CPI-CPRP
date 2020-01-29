<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;


class ProfesseurVRController extends Controller
{
    public function VisuPro()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_vr', compact('nom', 'prenom'));
        } else {
            return redirect('connexion');
        }
    }

    /**
     * Permet de récupérer les informations pour les select afin de choisir une classe / élève / année
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            $lesClasses = App\AnneeEtude::all();
            $lesAnneesScolaires = App\AnneeScolaire::all();
            $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->get();
            $lesFilieres = App\Filiere::all();
            return view('professeur_vr', compact('nom', 'prenom', 'lesClasses', 'lesAnneesScolaires', 'lesEtudiants'));
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            $lesClasses = App\AnneeEtude::all();
            $lesAnneesScolaires = App\AnneeScolaire::all();
            $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->get();
            $lesFilieres = App\Filiere::all();
            return view('professeur_vr', compact('nom', 'prenom', 'lesClasses', 'lesAnneesScolaires', 'lesEtudiants'));

        } else {
            return redirect('connexion');
        }
    }

    /**
     * Permet de lister les étudiant pour une année sélectionner
     */
    public function majBDD(Request $request)
    {

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $annee = $request->annee;

            $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('etudiantannee.annee', $annee)
                ->get();

            return $lesEtudiants;

        } else {
            return redirect('connexion');
        }

    }
}
?>
