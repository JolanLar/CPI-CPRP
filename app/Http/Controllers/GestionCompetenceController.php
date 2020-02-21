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
        $lesFilieres = App\Filiere::all();
        $lesCompetences = App\Competence::where('filiere.idFiliere', $lesFilieres[0]->idFiliere)
            ->join('filiere', 'competence.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->get();
        return view('back/formulairegestioncompetence', compact('lesCompetences', 'lesFilieres'));
    }

    /**
     * Liste toutes les compétences pour une filière spécifique
     * @return retour avec les compétences
     */
    public function majBDD(Request $request)
    {
        $filiere = $request->filiere;
        $lesCompetences = App\Competence::where('filiere.idFiliere', $filiere)
            ->join('filiere', 'competence.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->get();
        return $lesCompetences;
    }

    /**
     * Ajoute/Modifie une compétence
     * @return retour avec message/erreur
     */
    public function creation(Request $request)
    {
        $error="";
        $message="";
        $filiere = (int)$request->lyceefilierecompetence;
        $competence = (int)$request->idlacompetence;
        $libelle = (string)$request->libellelacompetence;
        if(is_int($filiere)&&is_int($competence)&&is_string($libelle)){
            $laCompetence = App\Competence::where('idCompetence', $competence)->where('idFiliere', $filiere)->first();
            if(isset($laCompetence)){
                App\Competence::where('idCompetence', $competence)
                ->where('idFiliere', $filiere)
                ->update(['libelleCompetence' => $libelle]);
                $message="La compétence à bien été modifié";
            }else{
                $laCompetence = new App\Competence;
                $laCompetence->idCompetence = $competence;
                $laCompetence->libelleCompetence = $libelle;
                $laCompetence->codeCompetence = 'C'.$competence;
                $laCompetence->idFiliere = $filiere;
                $laCompetence->save();
                $message="La compétence à bien été ajouté";
            }
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
        $filiere = $request->filiere;
        $message = "";

        $indicateurPerformance = App\IndicateurPerformance::where('idFiliere', $filiere)->where('idCompetence', $id)->get();
        foreach ( $indicateurPerformance as $idIn) {
            App\NoteMax::where('idIndicateurPerformance', $idIn->idIndicateurPerformance)->delete();
            App\AvoirNote::where('idIndicateurPerformance', $idIn->idIndicateurPerformance)->delete();
        }
        App\SousSavoirDetaille::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();
        App\SavoirDetaille::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();
        App\Contenir::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();
        App\IndicateurPerformance::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();
        App\CompetenceDetaillee::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();
        App\Competence::where('idCompetence', $id)->where('idFiliere', $filiere)->delete();

        return $message;
    }
}
