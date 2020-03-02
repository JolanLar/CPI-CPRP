<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionActiviteController extends Controller
{

    public function lister() {
        $filieres = App\Filiere::get();
        $activites = App\Activite::where('idFiliere', $filieres[0]->idFiliere)->get();
        return view('back/formulairegestionactivite', compact('filieres', 'activites'));
    }

    public function listeActivite(Request $request) {
        $filiere = $request->idFiliere;
        $activites = App\Activite::where('idFiliere', $filiere)->get();
        return $activites;
    }

    public function edit(Request $request) {
        $idFiliere = $request->idFiliere;
        $idActivite = $request->idActivite;
        $libelleActivite = $request->libelleActivite;

        $activite = App\Activite::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->first();

        if(isset($activite->idActivite)) {
            $newActivite = App\Activite::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->update(['libelleActivite' => $libelleActivite]);
            return "Modifié avec succès !";
        } else {
            $newActivite = new App\Activite;
            $newActivite->idFiliere = $idFiliere;
            $newActivite->idActivite = $idActivite;
            $newActivite->libelleActivite = $libelleActivite;
            $newActivite->save();
            return "Ajouté avec succès !";
        }

    }

    public function delete(Request $request) {
        $idFiliere = $request->idFiliere;
        $idActivite = $request->idActivite;
        App\Contenir::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->delete();
        App\Tache::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->delete();
        App\Activite::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->delete();
    }

}
