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
            return view('professeur_rtc', compact('nom', 'prenom', 'contenir', 'activite', 'tache', 'nbTaches', 'competences', 'filieres', 'nbCompetences'));
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
            $lesSavoirs = App\Savoir::select('savoirdetaille.idsavoir as idSavoir', 'savoir.libelleSavoir as libelleSavoir', 'savoirdetaille.idFiliere as idFiliere')->distinct()
            ->join('savoirdetaille', 'savoirdetaille.idSavoir', '=', 'savoir.idSavoir')->orderBy('idSavoir', 'ASC')
            ->get();;
            $lesSavoirsDetaille = App\SavoirDetaille::select('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir', 'idFiliere')
                ->distinct()
                ->groupBy('idSavoirDetaille', 'titreSavoirDetaille', 'idSavoir', 'idFiliere')
                ->get();;
            $filieres = App\Filiere::all();
            $competences = App\Competence::all();
            $lesCompSavoirsDetaille = App\SavoirDetaille::select('idSavoirDetaille', 'idCompetence', 'idFiliere')->get();
            $lesSousSavoirsDetaille = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'titreSousSavoirDetaille',
                'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir', 'soussavoirdetaille.idFiliere')
                ->join('savoirdetaille', 'savoirdetaille.idSavoirDetaille', '=', 'soussavoirdetaille.idSavoirDetaille')
                ->distinct()->groupBy('idSousSavoirDetaille', 'titreSousSavoirDetaille', 'soussavoirdetaille.idSavoirDetaille', 'savoirdetaille.idSavoir')->get();;
            $lesCompSousSavoirsDetaille = App\SousSavoirDetaille::select('idSousSavoirDetaille', 'idCompetence', 'idFiliere')->get();

            $nbCompetences = [];
            foreach ($filieres as $uneFiliere) {
                array_push($nbCompetences, App\Competence::where('idFiliere', '=', $uneFiliere->idFiliere)->count());
            }

            return view('professeur_rcs', compact('nom', 'prenom', 'filieres', 'competences', 'competences', 'nbCompetences', 'lesSavoirs',
            'lesCompSavoirsDetaille', 'lesSousSavoirsDetaille', 'lesSavoirsDetaille', 'lesCompSousSavoirsDetaille'));
        }
        else
        {
            return redirect('connexion');
        }
    }

}
