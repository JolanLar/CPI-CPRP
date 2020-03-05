<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class ProfesseurCSController extends Controller
{
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
        $classes = App\AnneeEtude::all();
        $annees = App\AnneeScolaire::all();
        $fiches = App\Notation::where('notation.idAnneeEtude', $classes[0]->idAnneeEtude)->where('annee', $annees[0]->annee)->get();
        $filieres = App\Filiere::all();
        $types = App\TypeNotation::all();
        $modules = App\Module::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        $lesDonneesFilieres = [];
        foreach ($filieres as $uneFiliere) {
            array_push(
                $lesDonneesFilieres,
                App\Competence::select('indicateurperformance.idIndicateurPerformance', 'libelleIndicateurPerformance', 'filiere.idFiliere', 'filiere.libelleFiliere', 'competence.idCompetence', 'competence.libelleCompetence', 'donnee.libelleDonnee', 'competencedetaillee.idCompetenceDetaillee', 'libelleCompetenceDetaillee')
                    ->join('competencedetaillee', 'competencedetaillee.idCompetence', '=', 'competence.idCompetence')
                    ->join('donnee', 'donnee.idDonnee', '=', 'competencedetaillee.idDonnee')
                    ->join('indicateurperformance', 'indicateurperformance.idcompetencedetaillee', '=', 'competencedetaillee.idcompetencedetaillee')
                    ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competence.idFiliere', $uneFiliere->idFiliere)
                    ->where('competencedetaillee.idFiliere', $uneFiliere->idFiliere)
                    ->where('indicateurperformance.idFiliere', $uneFiliere->idFiliere)
                    ->orderByRaw('indicateurperformance.idCompetence, indicateurperformance.idCompetenceDetaillee', 'ASC')
                    ->get()
            );
        }
        return view('professeur_cs_creation', compact('classes', 'annees',  'nom', 'prenom', 'types', 'fiches', 'modules', 'lesDonneesFilieres'));
    }

    public function listerGestion()
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
        $lesNotations = App\Notation::all();
        $nom = $dr->Nom;
        $prenom = $dr->Prenom;

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

        return view('professeur_cs_gestion', compact('lesNotations', 'lesDonneesFilieres', 'nom', 'prenom'));
    }

    /**
     * Renvoie les étudiant selon la notation séléctionner
     * @param Request $request
     * @return LesEtudiants
     */
    public function getEtudiant(Request $request) {
        return App\EtudiantAnnee::select('etudiantannee.idUtilisateur')
            ->where('etudiantannee.idAnneeEtude', $request->annee)
            ->get();
    }

    /**
     * @param Request $request
     * Renvoie les observations
     * @return LesObservations
     */
    public function getObservation(Request $request) {
        return App\AvoirNotation::where('idUtilisateur', $request->user)->get();
    }

    /**
     * @param Request $request
     * Enregistre les observations
     * @return string
     */
    public function saveObservation(Request $request) {

        try {

            App\AvoirNotation::where('idUtilisateur', $request->user)
                ->where('idNotation', $request->notation)
                ->update(['observationProfesseur' => $request->text]);

        } catch (Exception $ex) {
            echo 'Exception reçue : ',  $ex->getMessage(), "\n";
        }

    }

    /**
     * Enregistre le tableau
     * @param Request $request
     */
    public function saveTableau(Request $request) {
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
    public function recupNote(Request $request)
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
    public function recupNoteLangue(Request $request)
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

    /**
     * Retourne les indicateurs d'une notation
     */
    public function getIndicateurNotation(Request $request) {
        return App\NotationIndicateur::where('idNotation', $request->notation)->get();
    }

    /**
     * @param Request $request
     * Renvoie les fiches de notations
     * @return Object
     */
    public function getNotation(Request $request) {
        $idAnneeEtude = $request->idAnneeEtude;
        $annee = $request->annee;

        $notations = App\Notation::where('idAnneeEtude', $idAnneeEtude)->where('annee', $annee)->get();

        return $notations;
    }

    /**
     * @param Request $request
     * Renvoie la donnée de Notation correspondant
     * @return Object
     */
    public function getOneNotation(Request $request) {
        $idNotation = $request->idNotation;
        $notation = App\Notation::where('idNotation', $idNotation)->first();
        return $notation;
    }

    /**
     * @param Request $request
     * Renvoie la liste des filieres de la classe
     * @return Object
     */
    public function getFilieres(Request $request) {
        $idAnneeEtude = $request->idAnneeEtude;
        $filieres = App\Filiere::join('anneeetudefiliere', 'anneeetudefiliere.idFiliere', '=', 'filiere.idFiliere')->where('idAnneeEtude', $idAnneeEtude)->get();
        return $filieres;
    }

    /**
     * @param Request $request
     * Ajoute une notation a la table notation
     * @return Int
     */
    public function addNotation(Request $request) {
        $idNotation = $request->idNotation;
        $libelleNotation = $request->libelleNotation;
        $idTypeNotation = $request->idTypeNotation;
        $idModule = $request->idModule;
        $annee = $request->annee;
        $idAnneeEtude = $request->idAnneeEtude;

        $existe = App\Notation::where('idNotation', $idNotation)->first();
        $message = '';

        if(isset($existe) && $libelleNotation != null) {
            App\Notation::where('idNotation', $idNotation)->update(['libelleNotation' => $libelleNotation, 'idTypeNotation' => $idTypeNotation, 'idModule' => $idModule, 'annee' => $annee, 'idAnneeEtude' => $idAnneeEtude ]);
            $message = $idNotation;
        } else if ($idNotation=='-1' && $libelleNotation != null ) {
            $newNotation = new App\Notation;
            $newNotation->libelleNotation = $libelleNotation;
            $newNotation->idTypeNotation = $idTypeNotation;
            $newNotation->idModule = $idModule;
            $newNotation->annee = $annee;
            $newNotation->idAnneeEtude = $idAnneeEtude;
            $newNotation->save();
            $newID = App\Notation::select('idNotation')->whereRaw('idNotation = (select max(`idNotation`) from notation)')->get();
            $message = $newID[0]->idNotation;
        }
        return $message;

    }

    /**
     * @param Request $request
     * Supprime une fiche de notation et tout ce qui lui est lié
     * @return String
     */
    public function supprimer(Request $request) {
        $idNotation = $request->idNotation;
        try {
            App\NotationIndicateur::where('idNotation', $idNotation)->delete();
            App\Notation::where('idNotation', $idNotation)->delete();
            return 'La fiche de notation à bien été supprimée !';
        } catch (Exception $e) {
            return ' Erreur : La fiche de notation n\'a pus être supprimée !';
        }
    }

    /**
     * @param Request $request
     * Récupère la liste des indicateurs performance lié à une fiche de notation;
     * @return Object
     */
    public function getNotationIndicateur(Request $request) {
        $idNotation = $request->idNotation;

        try {
            return App\NotationIndicateur::where('idNotation', $idNotation)->get();
        } catch (Exception $e) {
            return $e;
        }

    }

    /**
     * @param Request $request
     * Enregistre la liste des indicateurs performance lié à une fiche de notation;
     * @return Object
     */
    public function setNotationIndicateur(Request $request) {
        $idNotation = $request->idNotation;
        $indicateurs = $request->indicateurs;

        try {
            App\NotationIndicateur::where('idNotation', $idNotation)->delete();
            foreach($indicateurs as $indicateur) {
                $newNotationIndicateur = new App\NotationIndicateur;
                $newNotationIndicateur->idNotation = $idNotation;
                $newNotationIndicateur->idIndicateurPerformance = $indicateur;
                $newNotationIndicateur->save();
            }
        } catch (Exception $e) {
            return $e;
        }

    }
}
