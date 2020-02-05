<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionSavoirDetailleController extends Controller
{
    //Fonction appelé lors de l'affichage de la page public/gestionsavoir
    public function lister() {
        $lesSavoirs = App\Savoir::all();
        $lesSavoirDetaille = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille', 'idFiliere')->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idFiliere')->orderByRaw('LENGTH(idSavoirDetaille), idSavoirDetaille', 'ASC')->get();
        $lesFilieres = App\Filiere::all();
        $lesCompetences = [];
        foreach($lesFilieres as $uneFiliere){
            array_push($lesCompetences, App\Competence::where('idFiliere', $uneFiliere->idFiliere)->get());
        }
        return view('back/formulairegestionsavoirdetaille', compact('lesCompetences', 'lesSavoirs', 'lesSavoirDetaille', 'lesFilieres'));
    }

    public function savoirsdetaille(Request $request) {
        $savoirdetaille = $request->savoirdetaille;
        $filiere = $request->filiere;
        $leSavoirDetaille = App\SavoirDetaille::where('idSavoirDetaille', $savoirdetaille)->where('idFiliere', $filiere)->get();
        return $leSavoirDetaille;
    }

    public function majBDD() {
        $lesSavoirsDetailles = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille', 'idFiliere', 'libelleSavoirDetaille')->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idFiliere', 'libelleSavoirDetaille')->orderByRaw('LENGTH(idSavoirDetaille), idSavoirDetaille', 'ASC')->get();
        return $lesSavoirsDetailles;
    }

    public function creation(Request $request) {
        //récupération des données du formulaire
        $savoir = $request->savoir;
        $savoirdetaille = $request->savoirdetaille;
        $titre = $request->titre;
        $libelle = $request->libelle;
        $filiere = $request->filiere;
        $tabComp = json_decode($request->tabComp);

        //Supprime les lignes déjà existantes        
        App\SavoirDetaille::where('idSavoirDetaille', $savoirdetaille)->where('idFiliere', $filiere)->delete();

        foreach($tabComp as $uneComp){
            $tabfc = explode('-', $uneComp);
            if($tabfc[0]==$filiere){
            $sv = new App\SavoirDetaille;
            $sv->idCompetence = $tabfc[1];
            $sv->idFiliere = $tabfc[0];
            $sv->idSavoirDetaille = $savoirdetaille;
            $sv->idSavoir = $savoir;
            $sv->titreSavoirDetaille = $titre;
            $sv->libelleSavoirDetaille = $libelle;
            $sv->save();
            }
        }
        return('succès');
    }

    public function delete(Request $request) {
        $id = $request->savoirdetaille;
        $filiere = $request->filiere;
        App\SavoirDetaille::where('idSavoirDetaille', $id)->where('idFiliere', $filiere)->delete();
        return('succès de la suppression');
    }
}
