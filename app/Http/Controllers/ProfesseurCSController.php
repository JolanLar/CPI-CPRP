<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class ProfesseurCSController extends Controller
{
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }
        $classes = App\AnneeEtude::all();
        $annees = App\AnneeScolaire::all();
        $fiches = App\Notation::where('notation.idAnneeEtude', $classes[0]->idAnneeEtude)->where('annee', $annees[0]->annee)->get();
        $filieres = App\Filiere::all();
        $types = App\TypeNotation::all();
        $modules = App\Module::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $lesDonneesFilieres = [];
        foreach ($filieres as $uneFiliere) {
            array_push(
                $lesDonneesFilieres,
                App\Competence::select('indicateurperformance.idIndicateurPerformance', 'libelleIndicateurPerformance', 'filiere.idFiliere', 'filiere.libelleFiliere', 'competence.idCompetence', 'competence.libelleCompetence', 'donnee.libelleDonnee', 'competencedetaillee.idCompetenceDetaillee', 'libelleCompetenceDetaillee')
                    ->join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                    ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                    ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                    ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                    ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                    ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee', 'ASC')
                    ->get()
            );
        }
        return view('professeur_cs_creation', compact('classes', 'annees',  'nom', 'prenom', 'types', 'fiches', 'modules', 'lesDonneesFilieres'));
    }

    public function listerGestion()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }
        $lesNotations = App\Notation::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;

        $lesFilieres = App\EtudiantAnnee::select('anneeetudefiliere.idFiliere', 'filiere.libelleFiliere')
            ->join('anneeetudefiliere', 'anneeetudefiliere.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
            ->get();

        $lesDonneesFilieres = [];

        foreach ($lesFilieres as $uneFiliere) {
            array_push(
                $lesDonneesFilieres,
                App\Competence::select('indicateurperformance.idIndicateurPerformance', 'libelleIndicateurPerformance', 'filiere.idFiliere', 'filiere.libelleFiliere', 'competence.idCompetence', 'competence.libelleCompetence', 'donnee.libelleDonnee', 'competencedetaillee.idCompetenceDetaillee', 'libelleCompetenceDetaillee', 'idIndicateurPerformanceLangue', 'libelleLangue')
                    ->join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                    ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                    ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                    ->leftjoin('indicateurperformancelangue', 'indicateurperformance.idIndicateurPerformance', '=', 'indicateurperformancelangue.idIndicateurPerformance')
                    ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                    ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                    ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee, indicateurperformancelangue.idIndicateurPerformanceLangue', 'ASC')
                    ->get()
            );
        }

        return view('professeur_cs_gestion', compact('lesNotations', 'lesDonneesFilieres', 'nom', 'prenom'));
    }

    /**
     * Renvoie les étudiant selon la notation séléctionner
     * @param Request $request
     * @return LesEtudiants
     */
    public function getEtudiant(Request $request) {
        return App\EtudiantAnnee::select('etudiantannee.idUtilisateur')
            ->join('anneeetudefiliere', 'anneeetudefiliere.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->where('idFiliere', $request->filiere)
            ->get();
    }

    /**
     * @param Request $request
     * Renvoie les observations
     * @return LesObservations
     */
    public function getObservation(Request $request) {
        return App\AvoirNotation::where('idUtilisateur', $request->user)->get();
    }

    /**
     * @param Request $request
     * Enregistre les observations
     * @return string
     */
    public function saveObservation(Request $request) {

        try {

            App\AvoirNotation::where('idUtilisateur', $request->user)
                ->where('idNotation', $request->notation)
                ->update(['observationProfesseur' => $request->text]);



        } catch (Exception $ex) {
            echo 'Exception reçue : ',  $ex->getMessage(), "\n";
        }

    }

    /**
     * @param Request $request
     * Renvoie les fiches de notations
     * @return Object
     */
    public function getNotation(Request $request) {
        $idAnneeEtude = $request->idAnneeEtude;
        $annee = $request->annee;

        $notations = App\Notation::where('idAnneeEtude', $idAnneeEtude)->where('annee', $annee)->get();

        return $notations;
    }

    /**
     * @param Request $request
     * Renvoie la donnée de Notation correspondant
     * @return Object
     */
    public function getOneNotation(Request $request) {
        $idNotation = $request->idNotation;
        $notation = App\Notation::where('idNotation', $idNotation)->first();
        return $notation;
    }

    /**
     * @param Request $request
     * Renvoie la liste des filieres de la classe
     * @return Object
     */
    public function getFilieres(Request $request) {
        $idAnneeEtude = $request->idAnneeEtude;
        $filieres = App\Filiere::join('anneeetudefiliere', 'anneeetudefiliere.idFiliere', '=', 'filiere.idFiliere')->where('idAnneeEtude', $idAnneeEtude)->get();
        return $filieres;
    }

    /**
     * @param Request $request
     * Ajoute une notation a la table notation
     * @return Int
     */
    public function addNotation(Request $request) {
        $idNotation = $request->idNotation;
        $libelleNotation = $request->libelleNotation;
        $idTypeNotation = $request->idTypeNotation;
        $idModule = $request->idModule;
        $annee = $request->annee;
        $idAnneeEtude = $request->idAnneeEtude;

        $existe = App\Notation::where('idNotation', $idNotation)->first();
        $message = '';

        if(isset($existe) && $libelleNotation != null) {
            App\Notation::where('idNotation', $idNotation)->update(['libelleNotation' => $libelleNotation, 'idTypeNotation' => $idTypeNotation, 'idModule' => $idModule, 'annee' => $annee, 'idAnneeEtude' => $idAnneeEtude ]);
            $message = $idNotation;
        } else if ($idNotation=='-1' && $libelleNotation != null ) {
            $newNotation = new App\Notation;
            $newNotation->libelleNotation = $libelleNotation;
            $newNotation->idTypeNotation = $idTypeNotation;
            $newNotation->idModule = $idModule;
            $newNotation->annee = $annee;
            $newNotation->idAnneeEtude = $idAnneeEtude;
            $newNotation->save();
            $newID = App\Notation::select('idNotation')->whereRaw('idNotation = (select max(`idNotation`) from notation)')->get();
            $message = $newID[0]->idNotation;
        }
        return $message;

    }

    /**
     * @param Request $request
     * Supprime une fiche de notation et tout ce qui lui est lié
     * @return String
     */
    public function supprimer(Request $request) {
        $idNotation = $request->idNotation;
        try {
            App\Notation::where('idNotation', $idNotation)->delete();
            App\NotationIndicateur::where('idNotation', $idNotation)->delete();
            return 'La fiche de notation à bien été supprimée !';
        } catch (Exception $e) {
            return ' Erreur : La fiche de notation n\'a pus être supprimée !';
        }
    }

    /**
     * @param Request $request
     * Récupère la liste des indicateurs performance lié à une fiche de notation;
     * @return Object
     */
    public function getNotationIndicateur(Request $request) {
        $idNotation = $request->idNotation;

        try {
            return App\NotationIndicateur::where('idNotation', $idNotation)->get();
        } catch (Exception $e) {
            return $e;
        }

    }

    /**
     * @param Request $request
     * Enregistre la liste des indicateurs performance lié à une fiche de notation;
     * @return Object
     */
    public function setNotationIndicateur(Request $request) {
        $idNotation = $request->idNotation;
        $indicateurs = $request->indicateurs;

        try {
            App\NotationIndicateur::where('idNotation', $idNotation)->delete();
            foreach($indicateurs as $indicateur) {
                $newNotationIndicateur = new App\NotationIndicateur;
                $newNotationIndicateur->idNotation = $idNotation;
                $newNotationIndicateur->idIndicateurPerformance = $indicateur;
                $newNotationIndicateur->save();
            }
        } catch (Exception $e) {
            return $e;
        }

    }
}
