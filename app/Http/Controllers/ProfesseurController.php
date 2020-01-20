<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            return view('professeur_rcs', compact('nom', 'prenom'));
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