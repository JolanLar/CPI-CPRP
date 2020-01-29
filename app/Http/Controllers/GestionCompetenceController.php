<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionCompetenceController extends Controller
{
    /**
     * Liste toutes les filieres et compétences pour une filière spécifique
     * @return retour page avec les compétences et filières
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
        $filiere = "CPI";
        $lesCompetences = App\Competence::where('libelleFiliere', $filiere)
            ->join('filiere', 'competence.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->get();
        $lesFilieres = App\Filiere::all();
        return view('back/formulairegestioncompetence', compact('lesCompetences', 'lesFilieres'));
    }

    /**
     * Liste toutes les compétences pour une filière spécifique
     * @return retour avec les compétences
     */
    public function majBDD(Request $request)
    {
        $filiere = $request->filiere;
        $lesCompetences = App\Competence::where('libelleFiliere', $filiere)
            ->join('filiere', 'competence.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->get();
        return $lesCompetences;
    }

    /**
     * Ajoute/Modifie une compétence
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $error = "";
        $message = "";

        if (request('lyceefilierecompetence') === "CPI")
            $filiere = "1";
        else
            $filiere = "2";

        $laupdate = request('selectcompetence');
        if ($laupdate == "Nouvelle compétence") {
            try {
                $competence = new App\Competence;
                $competence->idFiliere = $filiere;
                $competence->idCompetence = request('idlacompetence');
                $competence->codeCompetence = "C".request('idlacompetence');
                $competence->libelleCompetence = request('libellelacompetence');
                $competence->save();
                $message = "Compétence ajoutée";
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->errorInfo[1] == "1062") {
                    $error = "Compétence déjà existante";
                }
            }
        } else {
            $id = "C" . request('idlacompetence');
            $libelle = request('libellelacompetence');
            App\Competence::where('idCompetence', $id)->update(['libelleCompetence' => $libelle]);
            $message = "Compétence modifiée";
        }
        return back()->withError($error)->withSuccess($message);
    }
    /**
     * Ajoute/Modifie une compétence
     * @return retour avec message/erreur
     */
    public function supprimer(Request $request)
    {
        $id = $request->idCompetence;

        if ($request->filiere === "CPI")
            $filiere = "1";
        else
            $filiere = "2";

        $message = "";
        try {
            App\CompetenceDetaillee::where('idCompetence', $id)
                ->where('idFiliere', $filiere)
                ->delete();

            App\Competence::where('idCompetence', $id)->delete();
        } catch (IlluminateDatabaseQueryException $e) {
            if ($e->errorInfo[0] == "23000") {
                return "Compétence Détaillée";
            }
        }
        return $message;
    }
}
