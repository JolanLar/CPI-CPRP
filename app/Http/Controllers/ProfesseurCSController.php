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
        $lesClasses = App\AnneeEtude::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        return view('professeur_cs', compact('lesClasses', 'nom', 'prenom'));
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

}
