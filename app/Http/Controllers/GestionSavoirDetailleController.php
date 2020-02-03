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
        $lesSavoirDetaille = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille')->groupBy('idSavoirDetaille', 'titreSavoirDetaille')->orderByRaw('LENGTH(idSavoirDetaille), idSavoirDetaille', 'ASC')->get();
        $lesFilieres = App\Filiere::all();
        return view('back/formulairegestionsavoirdetaille', compact('lesSavoirs', 'lesSavoirDetaille', 'lesFilieres'));
    }

    public function savoirsdetaille(Request $request) {
        $savoirdetaille = $request->savoirdetaille;
        $leSavoirDetaille = App\SavoirDetaille::where('idSavoirDetaille', $savoirdetaille)->first();
        return $leSavoirDetaille;
    }
}
