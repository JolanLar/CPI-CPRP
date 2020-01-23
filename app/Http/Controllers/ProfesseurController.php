<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Metier\CpiCprp;
use App;
use App\Competence;

class ProfesseurController extends Controller
{
    /**
     * redirection en fonction de la page sélectionnée
     * @return type Vue connexion ou cs ou tls ou rtc ou rcs ou vr
     */
    public function CompSel()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_cs', compact('nom', 'prenom'));
        } else {
            return redirect('connexion');
        }
    }

    public function ToutesCompetences()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_tls', compact('nom', 'prenom'));
        } else {
            return redirect('connexion');
        }
    }

    public function RelationTC()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            $contenir = App\Contenir::orderByRaw('idFiliere, idActivite, idTache, idCompetence', 'ASC')->get();
            $tache = App\Tache::all();
            $activite = App\Activite::all();
            $filieres = App\Filiere::all();
            $competences = App\Competence::all();
            $nbCompetences = [];
            foreach ($filieres as $uneFiliere) {
                array_push($nbCompetences, App\Competence::where('idFiliere', '=', $uneFiliere->idFiliere)->count());
            }
            $nbTaches = [];
            foreach ($filieres as $uneFiliere) {
                $filiere = [];
                foreach ($activite as $uneActivite) {
                    if ($uneActivite->idFiliere == $uneFiliere->idFiliere) {
                        array_push($filiere, App\Tache::where('idActivite', '=', $uneActivite->idActivite)->where('idFiliere', '=', $uneFiliere->idFiliere)->count());
                    }
                }
                array_push($nbTaches, $filiere);
            }
            $couleurs = ['orange', 'rouge', 'gris', 'violet', 'bleuc'];
            return view('professeur_rtc', compact('nom', 'prenom', 'contenir', 'activite', 'couleurs', 'tache', 'nbTaches', 'competences', 'filieres', 'nbCompetences'));
        } else {
            return redirect('connexion');
        }
    }

    public function RelationCS()
    {

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            return view('professeur_rcs', compact('nom', 'prenom'));
        } else {
            return redirect('connexion');
        }
    }

    public function VisuPro()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }
            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            return view('professeur_vr', compact('nom', 'prenom'));
        } else {
            return redirect('connexion');
        }
    }
}
