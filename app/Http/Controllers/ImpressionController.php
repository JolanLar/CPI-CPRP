<?php

namespace App\Http\Controllers;

use App\Charts\radar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;
use PDF;


class ImpressionController extends Controller
{

    public function imprimerLivret($id)
    {

        ini_set('memory_limit', '-1');

        $nom = App\Utilisateur::select('Nom')->where('idUtilisateur', $id)->first();
        $prenom = App\Utilisateur::select('Prenom')->where('idUtilisateur', $id)->first();
        $nom = $nom->Nom;
        $prenom = $prenom->Prenom;

        $nomEtu = App\EtudiantAnnee::join('utilisateur', 'utilisateur.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
            ->where('utilisateur.idUtilisateur', $id)
            ->first();

        $idUtilisateur = $id;
        $lesCompetences = App\Competence::where('idFiliere', $nomEtu->idFiliere)
            ->orderByRaw('idCompetence', 'ASC')
            ->pluck('idCompetence');

        $uneFiliere = App\Filiere::join('anneeetudefiliere', 'anneeetudefiliere.idFiliere', '=', 'filiere.idFiliere')
            ->join('etudiantannee', 'etudiantannee.idAnneeEtude', '=', 'anneeetudefiliere.idAnneeEtude')
            ->where('etudiantannee.idUtilisateur', $idUtilisateur)
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

        $annee = App\EtudiantAnnee::where('idUtilisateur', $idUtilisateur)->orderByRaw('annee', 'DESC')->get();

        $tableaunote = App\AvoirNote::select(
            'valeurAacquerir  as aa',
            'valeurEnCours_1 as ca1',
            'valeurEnCours_2 as ca2',
            'valeurRenforcer_1 as ar1',
            'valeurRenforcer_2 as ar2',
            'valeurRenforcer_3 as ar3',
            'valeurConfirmee_1 as c1',
            'valeurConfirmee_2 as c2',
            'valeurConfirmee_3 as c3',
            'valeurConfirmee_4 as c4',
            'idIndicateurPerformance'
        )
            ->join('etudiantannee', 'etudiantannee.idUtilisateur', '=', 'avoir_note.idUtilisateur')
            ->where('avoir_note.idUtilisateur', $idUtilisateur)
            ->where('avoir_note.annee', $annee[0]->annee)
            ->where('etudiantannee.annee', $annee[0]->annee)
            ->get();

        $data = compact('lesDonneesUneFiliere', 'tableaunote');

        $pdf = PDF::loadView('print_livret', $data)
            ->setPaper('a2', 'portrait');
        $filename = $nom . '_' . $prenom . '_livret';

        return $pdf->stream($filename . '.pdf');;
    }
}
