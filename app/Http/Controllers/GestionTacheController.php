<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class GestionTacheController extends Controller
{
    
    public function lister() {
        $filieres = App\Filiere::all();
        $activites = App\Activite::where('idFiliere', $filieres[0]->idFiliere)->get();
        $taches = App\Tache::where('idFiliere', $filieres[0]->idFiliere)->where('idActivite', $activites[0]->idActivite)->get();
        return view('back/formulairegestiontache', compact('taches', 'filieres', 'activites'));
    }

    public function edit(Request $request) {
        $idFiliere = $request->idFiliere;
        $idActivite = $request->idActivite;
        $idTache = $request->idTache;
        $libelleTache = $request->libelleTache;

        $laTache = App\Tache::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->where('idTache', $idTache)->first();

        if(isset($laTache)){
            App\Tache::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->where('idTache', $idTache)->update([ 'libelleTache' => $libelleTache ]);
            return "Modifié avec succès !";
        } else {
            $laTache = new App\Tache;
            $laTache->idFiliere = $idFiliere;
            $laTache->idActivite = $idActivite;
            $laTache->idTache = $idTache;
            $laTache->libelleTache = $libelleTache;
            $laTache->save();
            return "Ajouté avec succès !";
        }

    }

    public function listeActivite(Request $request) {
        $idFiliere = $request->idFiliere;
        $activites = App\Activite::where('idFiliere', $idFiliere)->get();
        return $activites;
    }

    public function listeTache(Request $request) {
        $idFiliere = $request->idFiliere;
        $idActivite = $request->idActivite;
        $taches = App\Tache::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->get();
        return $taches;
    }

    public function delete(Request $request) {
        $idFiliere = $request->idFiliere;
        $idActivite = $request->idActivite;
        $idTache = $request->idTache;
        App\Tache::where('idFiliere', $idFiliere)->where('idActivite', $idActivite)->where('idTache', $idTache)->delete();
    }

}
