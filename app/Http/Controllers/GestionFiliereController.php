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
        $id = $request->id;
        $libelle = $request->libelle;

        $filiere = new App\Filiere;
        $filiere->idFiliere = $id;
        $filiere->libelleFiliere = $libelle;
        $filiere->save();
    }

    public function edit(Request $request) {
        $idFiliere = $request->idFiliere;
        $libelle = $request->libelle;

        App\Filiere::where('idFiliere', $idFiliere)->update(['libelleFiliere' => $libelle]);

        return ('Succès');
    }

    public function delete(Request $request) {
        App\Filiere::where('idFiliere', $request->idFiliere)->delete();
    }
}