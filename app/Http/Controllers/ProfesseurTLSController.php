<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class ProfesseurTLSController extends Controller
{
    /**
     * Liste toutes les competences, competences détaillées, données et indicateurs de performance de chaques filiere
     * @return retour page avec les variables
     */
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
        $classe = $lesClasses[0]->idAnneeEtude;
        $lesAnneesScolaires = App\AnneeScolaire::all();
        $annee = $lesAnneesScolaires[0]->annee;
        $lesEtudiants = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
            ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->where('anneeetude.idAnneeEtude', $classe)
            ->where('etudiantannee.annee', $annee)
            ->get();
        $lesFilieres = App\Filiere::all();
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

        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        return view('professeur_tls', compact('lesFilieres', 'lesAnneesScolaires', 'lesClasses', 'lesEtudiants', 'lesDonneesFilieres', 'nom', 'prenom'));
    }

    /**
     * Liste toutes les étudiants pour une filiere spécifique
     * @param Request $request
     * @return retour les étudiantscompetence
     */
    public function majBDD(Request $request)
    {
        $classe = $request->classe;

        $liste = App\Utilisateur::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'utilisateur.idUtilisateur')
        ->join('anneeetude', 'anneeetude.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
        ->where('anneeetude.idAnneeEtude', $classe)
        ->get();
        return $liste;
    }

    /**
     * Ajoute/Modifie toutes les notes pour un utilisateur et une année spécifique
     * @param Request $request
     */
    public function noter(Request $request)
    {
        $tableaunote = $request->note;
        $idUtilisateur = explode(" : ", $request->nom);
        $annee = $request->annee;


        foreach ($tableaunote as $tab) {
            $aa = explode(" aa : ", $tab);
            $ca1 = explode(" ca1 : ", $tab);
            $ca2 = explode(" ca2 : ", $tab);
            $ar1 = explode(" ar1 : ", $tab);
            $ar2 = explode(" ar2 : ", $tab);
            $ar3 = explode(" ar3 : ", $tab);
            $c1 = explode(" c1 : ", $tab);
            $c2 = explode(" c2 : ", $tab);
            $c3 = explode(" c3 : ", $tab);
            $c4 = explode(" c4 : ", $tab);

            $idindicateur = explode(" = ", $tab);

            if(!isset($request->idLangue)) {
                //Quand idLangue n'est pas définit
                $siexiste = App\AvoirNote::where('idIndicateurPerformance', $idindicateur[0])->where('idUtilisateur', $idUtilisateur[0])->first();

                if ($siexiste == null) {
                    $note = new App\AvoirNote;
                    $note->valeurAacquerir = substr($aa[1], 0, 1);
                    $note->valeurEnCours_1 = substr($ca1[1], 0, 1);
                    $note->valeurEnCours_2 = substr($ca2[1], 0, 1);
                    $note->valeurRenforcer_1 = substr($ar1[1], 0, 1);
                    $note->valeurRenforcer_2 = substr($ar2[1], 0, 1);
                    $note->valeurRenforcer_3 = substr($ar3[1], 0, 1);
                    $note->valeurConfirmee_1 = substr($c1[1], 0, 1);
                    $note->valeurConfirmee_2 = substr($c2[1], 0, 1);
                    $note->valeurConfirmee_3 = substr($c3[1], 0, 1);
                    $note->valeurConfirmee_4 = substr($c4[1], 0, 1);
                    $note->idUtilisateur = $idUtilisateur[0];
                    $note->annee = $annee;
                    $note->idIndicateurPerformance = $idindicateur[0];
                    $note->save();
                    $message = "Notes ajoutées";
                } else {
                    App\AvoirNote::where('idUtilisateur', $idUtilisateur[0])
                        ->where('annee', $annee)
                        ->where('idIndicateurPerformance', $idindicateur[0])
                        ->update([
                            'valeurAacquerir' => substr($aa[1], 0, 1),
                            'valeurEnCours_1' => substr($ca1[1], 0, 1),
                            'valeurEnCours_2' => substr($ca2[1], 0, 1),
                            'valeurRenforcer_1' => substr($ar1[1], 0, 1),
                            'valeurRenforcer_2' => substr($ar2[1], 0, 1),
                            'valeurRenforcer_3' => substr($ar3[1], 0, 1),
                            'valeurConfirmee_1' => substr($c1[1], 0, 1),
                            'valeurConfirmee_2' => substr($c2[1], 0, 1),
                            'valeurConfirmee_3' => substr($c3[1], 0, 1),
                            'valeurConfirmee_4' => substr($c4[1], 0, 1)
                        ]);
                }
            } else {
                //Quand idLangue est défini
                $idLangue = $request->idLangue;
                $siexiste = App\AvoirNoteLangue::where('idIndicateurPerformance', $idindicateur[0])->where('idUtilisateur', $idUtilisateur[0])->where('idLangue', $idLangue)->first();

                if ($siexiste == null) {
                    $note = new App\AvoirNoteLangue;
                    $note->valeurAacquerir = substr($aa[1], 0, 1);
                    $note->valeurEnCours_1 = substr($ca1[1], 0, 1);
                    $note->valeurEnCours_2 = substr($ca2[1], 0, 1);
                    $note->valeurRenforcer_1 = substr($ar1[1], 0, 1);
                    $note->valeurRenforcer_2 = substr($ar2[1], 0, 1);
                    $note->valeurRenforcer_3 = substr($ar3[1], 0, 1);
                    $note->valeurConfirmee_1 = substr($c1[1], 0, 1);
                    $note->valeurConfirmee_2 = substr($c2[1], 0, 1);
                    $note->valeurConfirmee_3 = substr($c3[1], 0, 1);
                    $note->valeurConfirmee_4 = substr($c4[1], 0, 1);
                    $note->idUtilisateur = $idUtilisateur[0];
                    $note->annee = $annee;
                    $note->idIndicateurPerformance = $idindicateur[0];
                    $note->idLangue = $idLangue;
                    $note->save();
                } else {
                    App\AvoirNoteLangue::where('idUtilisateur', $idUtilisateur[0])
                        ->where('annee', $annee)
                        ->where('idIndicateurPerformance', $idindicateur[0])
                        ->where('idLangue', $idLangue)
                        ->update([
                            'valeurAacquerir' => substr($aa[1], 0, 1),
                            'valeurEnCours_1' => substr($ca1[1], 0, 1),
                            'valeurEnCours_2' => substr($ca2[1], 0, 1),
                            'valeurRenforcer_1' => substr($ar1[1], 0, 1),
                            'valeurRenforcer_2' => substr($ar2[1], 0, 1),
                            'valeurRenforcer_3' => substr($ar3[1], 0, 1),
                            'valeurConfirmee_1' => substr($c1[1], 0, 1),
                            'valeurConfirmee_2' => substr($c2[1], 0, 1),
                            'valeurConfirmee_3' => substr($c3[1], 0, 1),
                            'valeurConfirmee_4' => substr($c4[1], 0, 1)
                        ]);
                }
            }
        }
    }

    /**
     * Recupere toutes les notes pour un utilisateur et une année spécifique
     * @return les notes sous forme d'un tableau de chaines de caractères
     */
    public function recuperernote(Request $request)
    {
        $tabfinal = [];
        $idUtilisateur = $request->nom;
        $annee = $request->annee;

        $tableaunote = App\AvoirNote::join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'avoir_note.idUtilisateur')
            ->where('avoir_note.idUtilisateur', $idUtilisateur)
            ->where('etudiantannee.annee', $annee)
            ->where('avoir_note.annee', $annee)
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
            $idindicateur = $tab->idIndicateurPerformance;

            array_push($tabfinal, "$idindicateur = aa : $aa , ca1 : $ca1, ca2 : $ca2, ar1 : $ar1, ar2 : $ar2, ar3 : $ar3, c1 : $c1, c2 : $c2, c3 : $c3, c4 : $c4");
        }
        return $tabfinal;
    }

    /**
     * Recupere toutes les notes pour un utilisateur et une année spécifique
     * @return les notes sous forme d'un tableau de chaines de caractères
     */
    public function recuperernotelangue(Request $request)
    {
        $tabfinal = [];
        $idUtilisateur = $request->nom;
        $annee = $request->annee;

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

    public function recupererFiliere(Request $request) {

        return App\EtudiantAnnee::select('anneeetudefiliere.idFiliere', 'filiere.libelleFiliere')
            ->join('anneeetudefiliere', 'anneeetudefiliere.idAnneeEtude', '=', 'etudiantannee.idAnneeEtude')
            ->join('filiere', 'filiere.idFiliere', '=', 'anneeetudefiliere.idFiliere')
            ->where('etudiantannee.idUtilisateur', $request->idUtilisateur)
            ->get();
    }
}
