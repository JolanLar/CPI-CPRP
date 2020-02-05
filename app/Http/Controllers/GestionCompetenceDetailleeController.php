<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionCompetenceDetailleeController extends Controller
{
    /**
     * Liste toutes les filieres et compétences détaillées pour une filière spécifique
     * @return retour page avec les compétences détaillées et filières
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
        $lesCompetences = App\Competence::where('idFiliere', $lesFilieres[0]->idFiliere)->get();

        return view('back/formulairegestioncompetencedetaillee', compact('lesCompetences', 'lesCompetencesDetaillees', 'lesFilieres'));
    }

    /**
     * Liste toutes les compétences détaillées pour une filière spécifique
     * @return retour avec les compétences
     */
    public function majBDD(Request $request)
    {
        $filiere = $request->filiere;
        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('filiere.idFiliere', $filiere)
            ->join('filiere', 'competencedetaillee.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetenceDetaillee), idCompetenceDetaillee', 'ASC')
            ->get();

        return $lesCompetencesDetaillees;
    }

    /**
     * Ajoute/Modifie une compétence détaillée
     * @return retour avec message/erreur
     */
    public function creation(Request $request)
    {
        $error = "";
        $message = "";
        $filiere = $request->lyceefilierecompetencedetaillee;

        $laupdate = request('selectcompetencedetaillee');
        if ($laupdate == "-1") {
            try {

                $competence = new App\CompetenceDetaillee;
                $competence->idFiliere = $filiere;
                $competence->idCompetence = request('idlacompetence1');
                $competence->libelleCompetenceDetaillee = request('libellelacompetencedetaillee');
                $competence->idCompetenceDetaillee = request('idlacompetence1') . "." . request('idlacompetence2');
                $competence->save();

                $message = "Compétence détaillée ajoutée";
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->errorInfo[1] == "1062") {
                    $error = "Compétence détaillée déjà existante";
                }
                if ($e->errorInfo[1] == "1452") {
                    $error = "Compétence associée inéxistante";
                }
            }
        } else {
            $id = request('idlacompetence1') . "." . request('idlacompetence2');

            $competence = request('idlacompetence1');
            $libelle = request('libellelacompetencedetaillee');
            App\CompetenceDetaillee::where('idCompetenceDetaillee', $id)
                ->where('idFiliere', $filiere)
                ->where('idCompetence', $competence)
                ->update(['libelleCompetenceDetaillee' => $libelle]);

            $message = "Compétence détaillée modifiée";
        }

        return back()
            ->withError($error)
            ->withSuccess($message);
    }

    /**
     * Supprime une compétence détaillée
     * @return retour message
     */
    public function supprimer(Request $request)
    {
        $id = $request->idCompetencedetaillee;

        if ($request->filiere === "CPI")
            $filiere = "1";
        else
            $filiere = "2";

        $message = "";
        try {
            App\CompetenceDetaillee::where('idCompetenceDetaillee', $id)
                ->where('idFiliere', $filiere)
                ->delete();
        } catch (IlluminateDatabaseQueryException $e) {
            if ($e->errorInfo[0] == "23000") {
                return "Compétence Détaillée";
            }
        }
        return $message;
    }
}
