<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionSousSavoirDetailleController extends Controller
{
    //Fonction appelé lors de l'affichage de la page public/gestionsavoir
    public function lister() {
        $lesSavoirsDetaille = App\SavoirDetaille::select('idSavoirDetaille', 'idFiliere')->groupBy('idSavoirDetaille', 'idFiliere')->orderByRaw('LENGTH(idSavoirDetaille), idSavoirDetaille')->get();
        $lesSousSavoirDetaille = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'idFiliere')->groupBy('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'idFiliere')->orderByRaw('LENGTH(idSousSavoirDetaille), idSousSavoirDetaille', 'ASC')->get();
        $lesFilieres = App\Filiere::all();
        $lesCompetences = [];
        foreach($lesFilieres as $uneFiliere){
            array_push($lesCompetences, App\Competence::where('idFiliere', $uneFiliere->idFiliere)->get());
        }
        return view('back/formulairegestionsoussavoirdetaille', compact('lesCompetences', 'lesSavoirsDetaille', 'lesSousSavoirDetaille', 'lesFilieres'));
    }

    public function soussavoirsdetaille(Request $request) {
        $soussavoirdetaille = $request->soussavoirdetaille;
        $leSousSavoirDetaille = App\SousSavoirDetaille::where('idSousSavoirDetaille', $soussavoirdetaille)->get();
        return $leSousSavoirDetaille;
    }

    public function majBDD() {
        $lesSousSavoirsDetailles = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'idFiliere')->groupBy('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'idFiliere')->orderByRaw('LENGTH(idSousSavoirDetaille), idSousSavoirDetaille', 'ASC')->get();
        return $lesSousSavoirsDetailles;
    }

    public function creation(Request $request) {
        //récupération des données du formulaire
        $savoirdetaille = $request->savoirdetaille;
        $soussavoirdetaille = $request->soussavoirdetaille;
        $titre = $request->titre;
        $libelle = $request->libelle;
        $tabComp = json_decode($request->tabComp);

        //Supprime les lignes déjà existantes        
        App\SousSavoirDetaille::where('idSousSavoirDetaille', $soussavoirdetaille)->delete();

        foreach($tabComp as $uneComp){
            $tabfc = explode('-', $uneComp);
            $sv = new App\SousSavoirDetaille;
            $sv->idCompetence = $tabfc[1];
            $sv->idFiliere = $tabfc[0];
            $sv->idSousSavoirDetaille = $soussavoirdetaille;
            $sv->idSavoirDetaille = $savoirdetaille;
            $sv->titreSousSavoirDetaille = $titre;
            $sv->libelleSousSavoirDetaille = $libelle;
            $sv->save();
        }
        return('succès');
    }

    public function delete(Request $request) {
        $id = $request->soussavoirdetaille;
        App\SousSavoirDetaille::where('idSousSavoirDetaille', $id)->delete();
        return('succès de la suppression');
    }
}
