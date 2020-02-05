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

            // Récupération des informations - pour BTS CPI
            $lesCompetencesCPI = App\Competence::where('idFiliere', 1)->get();
            $lesSavoirsCPI = App\Savoir::select('savoirdetaille.idsavoir as idSavoir', 'savoir.libelleSavoir as libelleSavoir')->distinct()
            ->join('savoirdetaille', 'savoirdetaille.idSavoir', '=', 'savoir.idSavoir')
            ->where('idFiliere', 1)->get();
            //tab savoirDetaille S1.1 ...
            $lesSavoirsDetailleCPI = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->where('idFiliere', 1)->distinct()->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->get();
            // compte le nb de compétences
            $countCPI = App\Competence::where('idFiliere', 1)->count();
            $lesCompSavoirsDetailleCPI = App\SavoirDetaille::select('idSavoirDetaille', 'idCompetence')->where('idFiliere', 1)->get();
            // les sous-savoirsDetaille
            $lesSousSavoirsDetailleCPI = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir')->join('savoirdetaille', 'savoirdetaille.idSavoirDetaille', '=',
                'soussavoirdetaille.idSavoirDetaille')
                ->where('soussavoirdetaille.idFiliere', 1)->distinct()->groupBy('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir')->get();
            $lesCompSousSavoirsDetailleCPI = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'idCompetence')->where('idFiliere', 1)->get();

            // Récupération des informations - pour BTS CPRP
            $lesCompetencesCPRP = App\Competence::where('idFiliere', 2)->get();
            $lesSavoirsCPRP = App\Savoir::all();
            //tab sous savoirs S1.1 ...
            $lesSavoirsDetailleCPRP = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->where('idFiliere', 2)->distinct()->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir')->get();
            // compte le nb de compétences
            $countCPRP = App\Competence::where('idFiliere', 2)->count();
            $lesCompSavoirsDetailleCPRP = App\SavoirDetaille::select('idSavoirDetaille', 'idCompetence')->where('idFiliere', 2)->get();
            // les sous-savoirsDetaille
            $lesSousSavoirsDetailleCPRP = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir')->join('savoirdetaille', 'savoirdetaille.idSavoirDetaille', '=',
                'soussavoirdetaille.idSavoirDetaille')
                ->where('soussavoirdetaille.idFiliere', 2)->distinct()->groupBy('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir')->get();
            $lesCompSousSavoirsDetailleCPRP = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'idCompetence')->where('idFiliere', 2)->get();

            return view('professeur_rcs', compact('nom', 'prenom', 'lesCompetencesCPI', 'lesSavoirsCPI', 'lesSavoirsDetailleCPI',
                'countCPI', 'lesCompSavoirsDetailleCPI', 'lesSousSavoirsDetailleCPI', 'lesCompSousSavoirsDetailleCPI' ,
                'lesCompetencesCPRP', 'lesSavoirsCPRP', 'lesSavoirsDetailleCPRP', 'countCPRP', 'lesCompSavoirsDetailleCPRP', 'lesSousSavoirsDetailleCPRP', 'lesCompSousSavoirsDetailleCPRP'));
        }
        else
        {
            return redirect('connexion');
        }
    }

}
