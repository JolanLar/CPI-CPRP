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
                App\Competence::select('indicateurperformance.idIndicateurPerformance', 'libelleIndicateurPerformance', 'filiere.idFiliere', 'filiere.libelleFiliere', 'competence.idCompetence', 'competence.libelleCompetence', 'donnee.libelleDonnee', 'competencedetaillee.idCompetenceDetaillee', 'libelleCompetenceDetaillee', 'langue.idLangue', 'libelleLangue')
                    ->join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                    ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                    ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                    ->leftjoin('indicateurperformancelangue', 'indicateurperformance.idIndicateurPerformance', '=', 'indicateurperformancelangue.idIndicateurPerformance')
                    ->leftjoin('langue', 'indicateurperformancelangue.idLangue', '=', 'langue.idLangue')
                    ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                    ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                    ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee, indicateurperformancelangue.idIndicateurPerformance', 'ASC')
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
}
