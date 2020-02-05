<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Charts\radar;
use App\Charts\histogramme;
use App;

class EleveController extends Controller
{
    public function AfficheHistogramme()
    {
        /**
         * verif droit puis affichage du livret et des charts
         * @return type Vue eleve
         */
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 10) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }

        $fil = $dr->idFiliere;
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $idUtilisateur = $dr->idUtilisateur;

        $lesCompetences = App\Competence::where('idFiliere', $fil)
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->pluck('idCompetence');

        $histogramme = new histogramme;
        $histogramme->labels($lesCompetences);
        $histogramme->dataset($nom, 'horizontalBar', [3, 14, 15, 20, 15, 23, 30, 55, 64, 40, 30, 30, 80, 90])->options([
            'backgroundColor' => 'rgba(17, 79, 255,0.4)', 'borderColor' => 'rgb(0, 50, 193)'
        ]);
        $histogramme->dataset('Valeur max', 'horizontalBar', [7, 14, 21, 28, 35, 42, 49, 56, 64, 71, 79, 86, 93, 100])->options([
            'backgroundColor' => 'rgba(66, 170, 244,0.4)', 'borderColor' => 'rgb(53, 141, 204)'
        ]);
        $histogramme->height(450);
        $histogramme->width(250);

        return view('eleve', compact(['histogramme'], 'nom', 'prenom', 'idUtilisateur'));
    }

    public function AfficheRadar()
    {
        /**
         * verif droit puis affichage du livret et des charts
         * @return type Vue eleve
         */
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 10) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }

        $fil = $dr->idFiliere;
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $idUtilisateur = $dr->idUtilisateur;
        $lesCompetences = App\Competence::where('idFiliere', $fil)
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->pluck('idCompetence');

        $radar = new radar;
        $radar->labels($lesCompetences);
        $radar->dataset($nom, 'radar', [7, 14, 21, 28, 35, 30, 49])->options([
            'pointBackgroundColor' => 'rgb(0, 50, 193)', 'backgroundColor' => 'rgba(17, 79, 255,0.4)', 'borderColor' => 'rgb(0, 50, 193)'
        ]);
        $radar->dataset('Moyenne de la classe', 'radar', [15, 13, 30, 15, 20, 19, 55])->options([
            'pointBackgroundColor' => 'rgb(204, 52, 52)', 'backgroundColor' => 'rgba(226, 83, 83,0.4)', 'borderColor' => 'rgb(204, 52, 52)'
        ]);
        $radar->dataset('Valeur max', 'radar', [25, 15, 30, 43, 38, 50, 70])->options([
            'pointBackgroundColor' => 'rgb(83, 226, 94)', 'backgroundColor' => 'rgba(103, 239, 113,0.4)', 'borderColor' => 'rgb(83, 226, 94)'
        ]);

        $radar->height(450);
        $radar->width(250);

        return view('eleve_radar', compact(['radar'], 'nom', 'prenom', 'idUtilisateur'));
    }

    public function AfficheLivret()
    {
        /**
         * verif droit puis affichage du livret et des charts
         * @return type Vue eleve
         */
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 10) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }

        $fil = $dr->idFiliere;
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $idUtilisateur = $dr->idUtilisateur;
        $lesCompetences = App\Competence::where('idFiliere', $fil)
            ->orderByRaw('LENGTH(idCompetence), idCompetence', 'ASC')
            ->pluck('idCompetence');
        $uneFiliere = App\Filiere::join('etudiantannee', 'etudiantannee.idFiliere', '=', 'filiere.idFiliere')
            ->where('etudiantannee.idUtilisateur', $dr->idUtilisateur)
            ->get();
        $lesDonneesUneFiliere = App\Competence::join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
            ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
            ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
            ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
            ->where('competence.idFiliere', $uneFiliere[0]->idFiliere)
            ->where('competencedetaillee.idFiliere', $uneFiliere[0]->idFiliere)
            ->where('indicateurperformance.idFiliere', $uneFiliere[0]->idFiliere)
            ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee', 'ASC')
            ->get();
        $laFiliere = $dr->libelleFiliere;


        return view('eleve_livret', compact('lesDonneesUneFiliere', 'laFiliere', 'idUtilisateur', 'nom', 'prenom', 'fil', 'idUtilisateur'));
    }


    public function note(Request $request)
    {
        $tabfinal = [];
        $idUtilisateur = $request->nom;
        $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->get();

        $tableaunote = App\AvoirNote::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'avoir_note.idUtilisateur')
            ->where('avoir_note.idUtilisateur', $idUtilisateur)
            ->where('avoir_note.annee', $annee[0]->annee)
            ->where('etudiantannee.annee', $annee[0]->annee)
            ->get();
        $tabfinal[0] = $tableaunote[0]->idFiliere;
        foreach ($tableaunote as $tab) {
            $aa = $tab->valeurAacquerir;
            $ca1 = $tab->valeurEnCours_1;
            $ca2 = $tab->valeurEnCours_2;
            $ar1 = $tab->valeurRenforcer_1;
            $ar2 = $tab->valeurRenforcer_2;
            $ar3 = $tab->valeurRenforcer_3;
            $c1 = $tab->valeurConfirmee_1;
            $c2 = $tab->valeurConfirmee_2;
            $c3 = $tab->valeurConfirmee_3;
            $c4 = $tab->valeurConfirmee_4;
            $idindicateur = $tab->idIndicateurPerformance;

            array_push($tabfinal, "$idindicateur = aa : $aa , ca1 : $ca1, ca2 : $ca2, ar1 : $ar1, ar2 : $ar2, ar3 : $ar3, c1 : $c1, c2 : $c2, c3 : $c3, c4 : $c4");
        }
        return $tabfinal;
    }
}
