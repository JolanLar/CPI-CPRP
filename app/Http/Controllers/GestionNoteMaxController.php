<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionNoteMaxController extends Controller {

    /**
     * Liste toutes les competences, competences détaillées, données et indicateurs de performance de chaques filiere
     * @return retour page avec les variables
     */
    public function lister() {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 1) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }

        $lesAnnees = App\AnneeScolaire::all();

        $lesFilieres = App\Filiere::all();

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

        $nom = $dr->Nom;
        $prenom = $dr->Prenom;
        return view('back/formulairegestionnotemax',
            compact( 'lesFilieres', 'lesAnnees', 'lesDonneesFilieres', 'nom', 'prenom'));

    }

    /**
     * Recupere toutes les notes pour un utilisateur et une année spécifique
     * @return les notes sous forme d'un tableau de chaines de caractères
     */
    public function recuperernote(Request $request)
    {
        $tabfinal = [];
        $filiere = $request->filiere;
        $annee = $request->annee;

        $tableaunote = App\NoteMax::join('indicateurperformance' , 'indicateurperformance.idIndicateurPerformance', '=', 'notemax.idIndicateurPerformance')
            ->where('indicateurperformance.idFiliere', $filiere)
            ->where('annee', $annee)
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

    /**
     * Ajoute/Modifie toutes les notes pour un utilisateur et une année spécifique
     */
    public function noter(Request $request) {
        $tableaunote = $request->note;
        $annee = $request->annee;

        $siexiste = App\NoteMax::where('annee', $annee)
            ->first();

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

            if ($siexiste == null) {
                $note = new App\NoteMax();
                $note->valeurAacquerir = substr($aa[1], 0, 1);
                $note->valeurEnCours_1  = substr($ca1[1], 0, 1);
                $note->valeurEnCours_2 = substr($ca2[1], 0, 1);
                $note->valeurRenforcer_1 = substr($ar1[1], 0, 1);
                $note->valeurRenforcer_2 = substr($ar2[1], 0, 1);
                $note->valeurRenforcer_3 = substr($ar3[1], 0, 1);
                $note->valeurConfirmee_1 = substr($c1[1], 0, 1);
                $note->valeurConfirmee_2 = substr($c2[1], 0, 1);
                $note->valeurConfirmee_3 = substr($c3[1], 0, 1);
                $note->valeurConfirmee_4 = substr($c4[1], 0, 1);
                $note->annee = $annee;
                $note->idIndicateurPerformance = $idindicateur[0];
                $note->save();
                $message = "Notes ajoutées";
            } else {
                App\NoteMax::where('annee', $annee)
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
        }
    }

}
