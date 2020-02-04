<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionIndicateurPerformanceController extends Controller
{

    /**
     * Liste toutes les Indicateurs Performance pour une compétence détaillée spécifique,
     * les competences detaillees pour une filière spécifique,
     * lesFilieres
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
        $lesFilieres = App\Filiere::all();
        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('filiere.idFiliere', $lesFilieres[0]->idFiliere)
            ->join('filiere', 'competencedetaillee.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetenceDetaillee), idCompetenceDetaillee', 'ASC')
            ->get();

        $lesIndicateursPerformance = App\IndicateurPerformance::where('idCompetenceDetaillee', $lesCompetencesDetaillees[0]->idCompetenceDetaillee)
            ->where('filiere.idFiliere', $lesFilieres[0]->idFiliere)
            ->join('filiere', 'indicateurperformance.idFiliere', '=', 'filiere.idFiliere')
            ->get();



        return view('back/formulairegestionindicateurperformance', compact('lesIndicateursPerformance', 'lesFilieres', 'lesCompetencesDetaillees'));
    }
    /**
     * Ajoute/Modifie un indicateur de performance 
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $error = "";
        $message = "";

        if (request('lyceefiliereindicateurperformance') == "CPI")
            $filiere = "1";
        else
            $filiere = "2";

        $laupdate = request('selectindicateurperformance');
        $competencedetaillee = explode(' - ', request('selectcdindicateurperformance'));
        $competence = explode('.', $competencedetaillee[0]);
        $ancienlibelle = request('ancienlibelle');

        if ($laupdate == "Nouvel indicateur de performance") {
            try {

                $indicateur = new App\IndicateurPerformance;
                $indicateur->libelleIndicateurPerformance = request('libelleindicateurperformance');
                $indicateur->idCompetenceDetaillee = $competencedetaillee[0];
                $indicateur->idCompetence = $competence[0];
                $indicateur->idFiliere = $filiere;
                $indicateur->save();

                $message = "Indicateur de performance ajouté";
            } catch (\Illuminate\Database\QueryException $e) {

                if ($e->errorInfo[1] == "1452") {
                    $error = "Veuillez choisir une compétence";
                }
            }
        } else {

            App\IndicateurPerformance::where('idCompetenceDetaillee', $competencedetaillee[0])
                ->where('idFiliere', $filiere)
                ->where('idCompetence', $competence[0])
                ->where('libelleIndicateurPerformance', $ancienlibelle)
                ->update(['libelleIndicateurPerformance' => request('libelleindicateurperformance')]);

            $message = "Indicateur de performance modifié";
        }

        return back()
            ->withError($error)
            ->withSuccess($message);
    }
    /**
     * Liste toutes les compétences détaillées pour une filière spécifique
     * @return retour des compétences détaillées
     */
    public function majBDD1(Request $request)
    {
        $filiere = $request->filiere;

        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('libelleFiliere', $filiere)
            ->join('filiere', 'competencedetaillee.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetenceDetaillee), idCompetenceDetaillee', 'ASC')
            ->get();
        return $lesCompetencesDetaillees;
    }

    /**
     * Liste les indicateurs de performance pour une filière et une compétence détaillée spécifique
     * @return retour des indicateurs de performance
     */
    public function majBDD2(Request $request)
    {
        $filiere = $request->filiere;
        $competenced = $request->competenced;
        $lesIndicateursPerformance = App\IndicateurPerformance::where('idCompetenceDetaillee', $competenced)
            ->where('libelleFiliere', $filiere)
            ->join('filiere', 'indicateurperformance.idFiliere', '=', 'filiere.idFiliere')
            ->get();
        return $lesIndicateursPerformance;
    }
    /**
     * Supprime un indicateur de performance
     */
    public function supprimer(Request $request)
    {
        if ($request->filiere == "CPI")
            $filiere = "1";
        else
            $filiere = "2";

        $id = $request->idCompetenceDetaillee;
        $ancienlibelle = $request->ancienlibelle;
        $idcomp = explode(".", $id);

        App\IndicateurPerformance::where('idCompetenceDetaillee', $id)
            ->where('idFiliere', $filiere)
            ->where('idCompetence', $idcomp[0])
            ->where('libelleIndicateurPerformance', $ancienlibelle)
            ->delete();
    }
}
