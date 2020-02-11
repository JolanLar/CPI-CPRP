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

    }

}
