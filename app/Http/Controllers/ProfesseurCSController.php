<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class ProfesseurCSController extends Controller
{
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }
        $lesClasses = App\AnneeEtude::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        return view('professeur_cs', compact('lesClasses', 'nom', 'prenom'));
    }
}
