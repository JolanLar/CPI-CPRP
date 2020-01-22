<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;


class ProfesseurController extends Controller
{
    /**
     * redirection en fonction de la page sélectionnée
     * @return type Vue connexion ou cs ou tls ou rtc ou rcs ou vr
     */
    public function CompSel(){
        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 5)
            {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            return view('professeur_cs', compact('nom', 'prenom'));
        }
        else
        {
            return redirect('connexion');
        }
    }

    public function ToutesCompetences(){
        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 5)
            {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_tls', compact('nom', 'prenom'));
        }
        else
        {
            return redirect('connexion');
        }
    }

    public function RelationTC(){
        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 5)
            {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_rtc', compact('nom', 'prenom'));
        }
        else
        {
            return redirect('connexion');
        }
    }

    public function RelationCS(){

        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 5)
            {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            // Récupération des informations - pour BTS CPI
            $lesCompetencesCPI = App\Competence::where('idFiliere', 1)->get();
            $lesSavoirsCPI = App\Savoir::all()->take(7);
            //tab sous savoirs S1.1 ...
            $lesSousSavoirsCPI = App\SavoirDetaillee::select('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->where('idFiliere', 1)->distinct()->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->get();
            // compte le nb de compétences
            $countCPI = App\Competence::where('idFiliere', 1)->count();
            $lesCompSousSavoirsCPI = App\SavoirDetaillee::select('idSavoirDetaille', 'idCompetence')->where('idFiliere', 1)->get();

            // Récupération des informations - pour BTS CPRP
            $lesCompetencesCPRP = App\Competence::where('idFiliere', 2)->get();
            $lesSavoirsCPRP = App\Savoir::all();
            //tab sous savoirs S1.1 ...
            $lesSousSavoirsCPRP = App\SavoirDetaillee::select('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->where('idFiliere', 2)->distinct()->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->get();
            // compte le nb de compétences
            $countCPRP = App\Competence::where('idFiliere', 2)->count();

            return view('professeur_rcs', compact('nom', 'prenom', 'lesCompetencesCPI', 'lesSavoirsCPI', 'lesSousSavoirsCPI', 'countCPI', 'lesCompSousSavoirsCPI', 'lesCompetencesCPRP', 'lesSavoirsCPRP', 'lesSousSavoirsCPRP', 'countCPRP'));
        }
        else
        {
            return redirect('connexion');
        }
    }

    public function VisuPro(){
        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 5)
            {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_vr', compact('nom', 'prenom'));
        }
        else
        {
            return redirect('connexion');
        }
    }
}
