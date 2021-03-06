<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Charts\radar;
use App\Charts\histogramme;
use App;

class EleveController extends Controller
{
    /**
     * Récupère les cases validées pas l'élève
     * @param $id
     * @param $fil
     * @param $annee
     * @return array $tab
     */
    public function recuperationCaseEleve($id, $fil, $annee) {

        $noteEleve = App\V_case_validee_etudiant::select('NbCaseValidee')
            ->where('idUtilisateur', $id)
            ->where('idFiliere', $fil)
            ->where('Annee', $annee)
            ->orderBy('idCompetence')
            ->get();

        $caseMax = App\V_case_max::select('NbCaseMax')
            ->where('idFiliere', $fil)
            ->orderBy('idCompetence')
            ->get();

        $dataEleve = [];
        foreach ($noteEleve as $key => $note) {

            if ($note->NbCaseValidee != 0)
            {
                $pourcentage = round(($note->NbCaseValidee / $caseMax[$key]->NbCaseMax) * 100 );
            } else {
                $pourcentage = null;
            }

            array_push($dataEleve, $pourcentage);
        }

        return $dataEleve;

    }

    /**
     * Récupère les cases maximales validées
     * @return $tab
     */
    public function recuperationCaseNoteMax($fil, $annee) {

        $noteMax = App\V_case_validee_note_max::select('NbCaseValidee')
            ->where('idFiliere', $fil)
            ->where('Annee', $annee)
            ->orderBy('idCompetence')
            ->get();

        $caseMax = App\V_case_max::select('NbCaseMax')
            ->where('idFiliere', $fil)
            ->orderBy('idCompetence')
            ->get();

        $dataNoteMax = [];
        foreach ($noteMax as $key => $note) {

            if ($note->NbCaseValidee != 0)
            {
                $pourcentage = round(($note->NbCaseValidee / $caseMax[$key]->NbCaseMax) * 100 );
            } else {
                $pourcentage = null;
            }


            array_push($dataNoteMax, $pourcentage);
        }

        return $dataNoteMax;

    }

    /**
     * Récupère les cases maximales validées de l'ensemble de la classe
     * @return $tab
     */
    public function recuperationCaseMoyenne($fil, $annee) {

        $noteMoyenne = App\V_case_validee_moyenne_classe::select('NbCaseValidee')
            ->where('idFiliere', $fil)
            ->where('Annee', $annee)
            ->orderBy('idCompetence')
            ->get();

        $caseMax = App\V_case_max::select('NbCaseMax')
            ->where('idFiliere', $fil)
            ->orderBy('idCompetence')
            ->get();

        $dataNoteMoyenne = [];
        foreach ($noteMoyenne as $key => $note) {

            if ($note->NbCaseValidee != 0)
            {
                $pourcentage = round(($note->NbCaseValidee / $caseMax[$key]->NbCaseMax) * 100 );
            } else {
                $pourcentage = null;
            }

            array_push($dataNoteMoyenne, $pourcentage);
        }

        return $dataNoteMoyenne;

    }

    /**
     * Retourne un tableau contenant les histogrammes
     * @param $infoEtudiant
     * @param $idUtilisateur
     * @return array $lesHistogrammes
     */
    public function getLesHistogrammes($infoEtudiant, $idUtilisateur)
    {

        $lesHistogrammes = [];

        foreach ($infoEtudiant as $iE) {
            $lesCompetences = App\Competence::where('idFiliere', $iE->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');

            $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->first();

            // Récupération des tableaux pour les notes
            $dataEleve = $this->recuperationCaseEleve($idUtilisateur, $iE->idFiliere, $annee->annee);
            $dataMax = $this->recuperationCaseNoteMax($iE->idFiliere, $annee->annee);

            $histogramme = new histogramme;
            $histogramme->labels($lesCompetences);
            $histogramme->dataset($iE->Nom . ' % ', 'horizontalBar', $dataEleve)->options([
                'backgroundColor' => 'rgba(17, 79, 255,0.4)', 'borderColor' => 'rgb(0, 50, 193)'
            ]);
            $histogramme->dataset('Valeur max en %', 'horizontalBar', $dataMax)->options([
                'backgroundColor' => 'rgba(66, 170, 244,0.4)', 'borderColor' => 'rgb(53, 141, 204)'
            ]);
            $histogramme->height(450);
            $histogramme->width(250);

            array_push($lesHistogrammes, $histogramme);

        }

        return $lesHistogrammes;
    }

    /**
     * Retourne un tableau avec les radars
     * @param $infoEtudiant
     * @param $idUtilisateur
     * @return array $lesRadars
     */
    public function getLesRadars($infoEtudiant, $idUtilisateur) {

        $lesRadars = [];

        foreach ($infoEtudiant as $iE) {
            $lesCompetences = App\Competence::where('idFiliere', $iE->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');

            $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->first();

            // Récupération des tableaux pour les notes
            $dataEleve = $this->recuperationCaseEleve($idUtilisateur, $iE->idFiliere, $annee->annee);
            $dataMax = $this->recuperationCaseNoteMax($iE->idFiliere, $annee->annee);
            $dataMoyenne = $this->recuperationCaseMoyenne($iE->idFiliere, $annee->annee);

            // Radar
            $radar = new radar;
            $radar->labels($lesCompetences);
            $radar->dataset($iE->Nom, 'radar', $dataEleve )->options([
                'pointBackgroundColor' => 'rgb(0, 50, 193)', 'backgroundColor' => 'rgba(17, 79, 255,0.4)', 'borderColor' => 'rgb(0, 50, 193)'
            ]);
            $radar->dataset('Moyenne de la classe', 'radar', $dataMoyenne)->options([
                'pointBackgroundColor' => 'rgb(204, 52, 52)', 'backgroundColor' => 'rgba(226, 83, 83,0.4)', 'borderColor' => 'rgb(204, 52, 52)'
            ]);
            $radar->dataset('Valeur max en %', 'radar', $dataMax)->options([
                'pointBackgroundColor' => 'rgb(83, 226, 94)', 'backgroundColor' => 'rgba(103, 239, 113,0.4)', 'borderColor' => 'rgb(83, 226, 94)'
            ]);

            $radar->height(450);
            $radar->width(250);

            array_push($lesRadars, $radar);

        }

        return $lesRadars;

    }

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
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $idUtilisateur = $dr->idUtilisateur;

        $infoEtudiant = App\AnneeEtudeFiliere::select('anneeetudefiliere.idFiliere', 'etudiantannee.idUtilisateur', 'utilisateur.Nom', 'filiere.libelleFiliere')
            ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
            ->join('etudiantannee', 'etudiantannee.idAnneeEtude', '=', 'anneeetude.idAnneeEtude')
            ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
            ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
            ->where('utilisateur.idUtilisateur', $idUtilisateur)
            ->get();

        $lesHistogrammes = $this->getLesHistogrammes($infoEtudiant, $idUtilisateur);

        return view('eleve', compact(['lesHistogrammes'], 'nom', 'prenom', 'idUtilisateur', 'infoEtudiant'));
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

        $infoEtudiant = App\AnneeEtudeFiliere::select('anneeetudefiliere.idFiliere', 'etudiantannee.idUtilisateur', 'utilisateur.Nom', 'filiere.libelleFiliere')
            ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
            ->join('etudiantannee', 'etudiantannee.idAnneeEtude', '=', 'anneeetude.idAnneeEtude')
            ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
            ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
            ->where('utilisateur.idUtilisateur', $idUtilisateur)
            ->get();

        $lesRadars = $this->getLesRadars($infoEtudiant, $idUtilisateur);

        return view('eleve_radar', compact(['lesRadars'], 'nom', 'prenom', 'idUtilisateur', 'infoEtudiant'));
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

        $lesFilieres = App\EtudiantAnnee::select('anneeetudefiliere.idFiliere', 'filiere.libelleFiliere')
            ->join('anneeetudefiliere', 'anneeetudefiliere.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
            ->where('etudiantannee.idUtilisateur', $idUtilisateur)
            ->get();

        $lesDonneesFilieres = [];
        foreach ($lesFilieres as $uneFiliere) {
            array_push(
                $lesDonneesFilieres,
                App\Competence::select('indicateurperformance.idIndicateurPerformance', 'libelleIndicateurPerformance', 'filiere.idFiliere', 'filiere.libelleFiliere', 'competence.idCompetence', 'competence.libelleCompetence', 'donnee.libelleDonnee', 'competencedetaillee.idCompetenceDetaillee', 'libelleCompetenceDetaillee', 'langue.idLangue', 'libelleLangue')
                    ->join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                    ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                    ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                    ->leftjoin('indicateurperformancelangue', 'indicateurperformance.idIndicateurPerformance', '=', 'indicateurperformancelangue.idIndicateurPerformance')
                    ->leftjoin('langue', 'indicateurperformancelangue.idLangue', '=', 'langue.idLangue')
                    ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                    ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                    ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee, indicateurperformancelangue.idIndicateurPerformance', 'ASC')
                    ->get()
            );
        }

        $indicateurLangue = App\IndicateurPerformanceLangue::all();

        return view('eleve_livret', compact('lesDonneesFilieres', 'lesFilieres', 'indicateurLangue', 'idUtilisateur', 'nom', 'prenom', 'fil', 'idUtilisateur'));
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

    public function noteLangue(Request $request) {

        $tabfinal = [];
        $idUtilisateur = $request->nom;
        $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->get();

        $tableaunote = App\AvoirNoteLangue::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'avoir_note_langue.idUtilisateur')
            ->where('avoir_note_langue.idUtilisateur', $idUtilisateur)
            ->where('etudiantannee.annee', $annee)
            ->where('avoir_note_langue.annee', $annee)
            ->get();

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
            $langue = $tab->idLangue;
            $idindicateur = $tab->idIndicateurPerformance;

            array_push($tabfinal, "$idindicateur = aa : $aa , ca1 : $ca1, ca2 : $ca2, ar1 : $ar1, ar2 : $ar2, ar3 : $ar3, c1 : $c1, c2 : $c2, c3 : $c3, c4 : $c4, langue : $langue");
        }
        return $tabfinal;
    }

}
