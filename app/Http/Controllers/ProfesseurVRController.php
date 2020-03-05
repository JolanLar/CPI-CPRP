<?php

namespace App\Http\Controllers;

use App\Charts\histogramme;
use App\Charts\radar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;


class ProfesseurVRController extends Controller
{
    public function init(){
        Session::put('etudiant', $_POST['etudiantidtls']);
        Session::put('classe', $_POST['lyceeclasse']);
        Session::put('annee', $_POST['anneidvr']);
        return redirect('/professeur/vr/' . Session::get('etudiant') . '/histo');
    }
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
     * @param $fil
     * @param $annee
     * @return array $tab
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
     * @param $fil
     * @param $annee
     * @return array $tab
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
    public function getLesHistogrammes($infoEtudiant, $idUtilisateur) {

        $lesHistogrammes = [];

        foreach ($infoEtudiant as $iE) {
            $lesCompetences = App\Competence::where('idFiliere', $iE->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');

            $annee = Session::get('annee');

            // Récupération des tableaux pour les notes
            $dataEleve = $key = $this->recuperationCaseEleve($idUtilisateur, $iE->idFiliere, $annee);
            $dataMax = $this->recuperationCaseNoteMax($iE->idFiliere, $annee);

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
     * @return
     */
    public function getLesRadars($infoEtudiant, $idUtilisateur) {

        $lesRadars = [];

        foreach ($infoEtudiant as $iE) {
            $lesCompetences = App\Competence::where('idFiliere', $iE->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');

            $annee = Session::get('annee');

            // Récupération des tableaux pour les notes
            $dataEleve = $this->recuperationCaseEleve($idUtilisateur, $iE->idFiliere, $annee);
            $dataMax = $this->recuperationCaseNoteMax($iE->idFiliere, $annee);
            $dataMoyenne = $this->recuperationCaseMoyenne($iE->idFiliere, $annee);

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


    /**
     * Permet de récupérer les informations pour les select afin de choisir une classe / élève / année
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $nom = $dr->Nom;
            $prenom = $dr->Prenom;
            $lesClasses = App\AnneeEtude::all();
            $lesAnneesScolaires = App\AnneeScolaire::all();
            $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->get();

            // Return blade
            return view('professeur_vr', compact('nom', 'prenom' ,'lesClasses', 'lesAnneesScolaires', 'lesEtudiants'));

        } else {
            return redirect('connexion');
        }
    }

    /**
     * Permet de lister les étudiant pour une année sélectionner
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function majBDD(Request $request)
    {

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $classe = $request->classe;

            return App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('anneeetude.idAnneeEtude', $classe)
                ->get();

        } else {
            return redirect('connexion');
        }

    }


    public function getHistogramme($idUtilisateur) {

        $user = App\Utilisateur::where('idUtilisateur', $idUtilisateur)->first();

        if(!$user) {
            return redirect('professeur/vr');
        }

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            // Histogramme
            $infoEtudiant = App\AnneeEtudeFiliere::select('anneeetudefiliere.idFiliere', 'etudiantannee.idUtilisateur', 'utilisateur.Nom', 'filiere.libelleFiliere')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
                ->join('etudiantannee', 'etudiantannee.idAnneeEtude', '=', 'anneeetude.idAnneeEtude')
                ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
                ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
                ->where('utilisateur.idUtilisateur', $idUtilisateur)
                ->get();

            $lesHistogrammes = $this->getLesHistogrammes($infoEtudiant, $idUtilisateur);

            return view('professeur_vr_detail', compact('nom', 'prenom', 'idUtilisateur', ['lesHistogrammes'], 'infoEtudiant'));

        } else {
            return redirect('connexion');
        }

}

    public function getRadar($idUtilisateur) {

        $user = App\Utilisateur::where('idUtilisateur', $idUtilisateur)->first();

        if(!$user) {
            return redirect('professeur/vr');
        }

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            $infoEtudiant = App\AnneeEtudeFiliere::select('anneeetudefiliere.idFiliere', 'etudiantannee.idUtilisateur', 'utilisateur.Nom', 'filiere.libelleFiliere')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
                ->join('etudiantannee', 'etudiantannee.idAnneeEtude', '=', 'anneeetude.idAnneeEtude')
                ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
                ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
                ->where('utilisateur.idUtilisateur', $idUtilisateur)
                ->get();

            $lesRadars = $this->getLesRadars($infoEtudiant, $idUtilisateur);

            return view('professeur_vr_detail_radar', compact('nom', 'prenom', 'idUtilisateur', ['lesRadars'], 'infoEtudiant'));

        } else {
            return redirect('connexion');
        }

    }

    public function getLivret($idUtilisateur) {

        $user = App\Utilisateur::where('idUtilisateur', $idUtilisateur)->first();

        if(!$user) {
            return redirect('professeur/vr');
        }

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $nom = $dr->Nom;
            $prenom = $dr->Prenom;

            $fil = App\EtudiantAnnee::select('anneeetudefiliere.idFiliere as idFiliere')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->join('anneeetudefiliere', 'anneeetudefiliere.idAnneeEtude', '=', 'anneeetude.idAnneeEtude')
                ->where('idUtilisateur', $idUtilisateur)
                ->get();

            $lesCompetences = App\Competence::where('idFiliere', $fil[0]->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
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

            return view('professeur_vr_detail_livret',
                compact('lesFilieres', 'nom', 'prenom', 'idUtilisateur', 'lesCompetences', 'lesDonneesFilieres'));

        } else {
            return redirect('connexion');
        }

    }

    public function recupererNote(Request $request)
    {
        $tabfinal = [];
        $idUtilisateur = $request->nom;
        $annee = Session::get('annee');

        $tableaunote = App\AvoirNote::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'avoir_note.idUtilisateur')
            ->where('avoir_note.idUtilisateur', $idUtilisateur)
            ->where('avoir_note.annee', $annee)
            ->where('etudiantannee.annee', $annee)
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
?>
