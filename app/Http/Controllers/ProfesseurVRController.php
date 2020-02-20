<?php

namespace App\Http\Controllers;

use App\Charts\histogramme;
use App\Charts\radar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;


class ProfesseurVRController extends Controller
{
    /**
     * Récupère les cases validées pas l'élève
     * @return $tab
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
     * Permet de récupérer les informations pour les select afin de choisir une classe / élève / année
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function lister(Request $request)
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
     */
    public function majBDD(Request $request)
    {

        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 5) {
                Session::flush();
                return redirect('connexion');
            }

            $annee = $request->annee;

            $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('etudiantannee.annee', $annee)
                ->get();

            return $lesEtudiants;

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
            $nomEtu = App\EtudiantAnnee::select('anneeetude.idFiliere as idFiliere', 'etudiantannee.idUtilisateur as idUtilisateur', 'utilisateur.Nom as Nom')
                ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('utilisateur.idUtilisateur', $idUtilisateur)->get();

            $lesCompetences = App\Competence::where('idFiliere', $nomEtu[0]->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');


            $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->first();

            // Récupération des tableaux pour les notes
            $dataEleve = $this->recuperationCaseEleve($idUtilisateur, $nomEtu[0]->idFiliere, $annee->annee);
            $dataMax = $this->recuperationCaseNoteMax($nomEtu[0]->idFiliere, $annee->annee);

            $histogramme = new histogramme;
            $histogramme->labels($lesCompetences);
            $histogramme->dataset($nomEtu[0]->Nom . ' % ', 'horizontalBar', $dataEleve)->options([
                'backgroundColor' => 'rgba(17, 79, 255,0.4)', 'borderColor' => 'rgb(0, 50, 193)'
            ]);
            $histogramme->dataset('Valeur max en %', 'horizontalBar', $dataMax)->options([
                'backgroundColor' => 'rgba(66, 170, 244,0.4)', 'borderColor' => 'rgb(53, 141, 204)'
            ]);
            $histogramme->height(450);
            $histogramme->width(250);

            return view('professeur_vr_detail', compact('nom', 'prenom', 'idUtilisateur', ['histogramme']));

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

            $nomEtu = App\EtudiantAnnee::select('anneeetude.idFiliere as idFiliere', 'etudiantannee.idUtilisateur as idUtilisateur', 'utilisateur.Nom as Nom')
                ->join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('utilisateur.idUtilisateur', $idUtilisateur)->get();

            $lesCompetences = App\Competence::where('idFiliere', $nomEtu[0]->idFiliere)
                ->orderByRaw('idCompetence', 'ASC')
                ->pluck('idCompetence');

            $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->first();

            // Récupération des tableaux pour les notes
            $dataEleve = $this->recuperationCaseEleve($idUtilisateur, $nomEtu[0]->idFiliere, $annee->annee);
            $dataMax = $this->recuperationCaseNoteMax($nomEtu[0]->idFiliere, $annee->annee);
            $dataMoyenne = $this->recuperationCaseMoyenne($nomEtu[0]->idFiliere, $annee->annee);

            // Radar
            $radar = new radar;
            $radar->labels($lesCompetences);
            $radar->dataset($nomEtu[0]->Nom, 'radar', $dataEleve )->options([
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


            return view('professeur_vr_detail_radar', compact('nom', 'prenom', 'idUtilisateur', ['radar']));

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

            $fil = App\EtudiantAnnee::select('anneeetude.idFiliere as idFiliere')
                ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
                ->where('idUtilisateur', $idUtilisateur)->get();

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
                    App\Competence::join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                        ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                        ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                        ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                        ->where('competence.idFiliere', $uneFiliere->idFiliere)
                        ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                        ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                        ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee', 'ASC')
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
?>
