<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionFiliereController extends Controller
{
    public function lister() {

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
        return view('back/formulairegestionfiliere', compact('lesFilieres'));
    }

    public function majBDD() {
        return App\Filiere::all();
    }

    public function creation(Request $request) {
        $id = $request->idFiliere;
        $libelle = $request->libelle;

        $existe = App\Filiere::where('idFiliere', $id)->first();
        if(!isset($existe)) {
            $filiere = new App\Filiere;
            $filiere->idFiliere = $id;
            $filiere->libelleFiliere = $libelle;
            $filiere->save();
        }
    }

    public function edit(Request $request) {
        $idFiliere = $request->idFiliere;
        $libelle = $request->libelle;

        App\Filiere::where('idFiliere', $idFiliere)->update(['libelleFiliere' => $libelle]);

        return ('Succès');
    }

    public function delete(Request $request) {
        $lesIndicateurs = App\IndicateurPerformance::where('idFiliere', $request->idFiliere)->get();
        foreach($lesIndicateurs as $unIndicateur) {
            App\NoteMax::where('idIndicateurPerformance', $unIndicateur->idIndicateurPerformance)->delete();
            App\IndicateurPerformanceLangue::where('idIndicateurPerformance', $unIndicateur->idIndicateurPerformance)->delete();
        }
        App\Contenir::where('idFiliere', $request->idFiliere)->delete();
        App\Tache::where('idFiliere', $request->idFiliere)->delete();
        App\Activite::where('idFiliere', $request->idFiliere)->delete();
        App\AnneeEtudeFiliere::where('idFiliere', $request->idFiliere)->delete();
        App\SousSavoirDetaille::where('idFiliere', $request->idFiliere)->delete();
        App\SavoirDetaille::where('idFiliere', $request->idFiliere)->delete();
        App\IndicateurPerformance::where('idFiliere', $request->idFiliere)->delete();
        App\CompetenceDetaillee::where('idFiliere', $request->idFiliere)->delete();
        App\Competence::where('idFiliere', $request->idFiliere)->delete();
        App\Filiere::where('idFiliere', $request->idFiliere)->delete();
    }
}
