<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionDonneeController extends Controller
{
    /**
     * Liste les fillieres, les données, toutes les compétences détaillées d'une filiere et les données d'une filiere
     * @return retour page avec les variables
     */
    public function lister()
    {
        if (Session::has('droit')) {
            $dr = Session::get('droit');
            if ($dr->Droit != 1) {
                Session::flush();
                return redirect('connexion');
            }
        } else {
            return redirect('connexion');
        }
        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('libelleFiliere', "CPI")
            ->join('filiere', 'competencedetaillee.idFiliere', '=', 'filiere.idFiliere')
            ->orderByRaw('LENGTH(idCompetenceDetaillee), idCompetenceDetaillee', 'ASC')
            ->get();

        $lesFilieres = App\Filiere::all();
        $toutesDonnees = App\Donnee::all();
        $lesDonnees = App\Donnee::where('libelleFiliere', "CPI")
            ->where('idCompetenceDetaillee', "C1.1")
            ->join('filiere', 'filiere.idFiliere', '=', 'competencedetaillee.idFiliere')
            ->join('competencedetaillee', 'competencedetaillee.idDonnee', '=', 'donnee.idDonnee');

        return view('back/formulairegestiondonnee', compact('toutesDonnees', 'lesDonnees', 'lesCompetencesDetaillees', 'lesFilieres'));
    }

    /**
     * Liste les compétences détaillées pour une classe spécifique
     * @return retour les compétences détaillées
     */
    public function majBDD(Request $request)
    {
        $filiere = $request->filiere;
        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('idFiliere', $filiere)
            ->orderByRaw('LENGTH(idCompetenceDetaillee), idCompetenceDetaillee', 'ASC')
            ->get();
        return $lesCompetencesDetaillees;
    }

    /**
     * @Author Jolan Largeteau
     * @param idFiliere, iccompetencedetaillee
     * @return retour la donnée correspondant a la competence detaille et a la filiere
     */
    public function affichagedonnee(Request $request)
    {
        $filiere = $request->filiere;
        $idcd = $request->idcd;
        $lesDonnees = App\Donnee::join('competencedetaillee', 'competencedetaillee.idDonnee', '=', 'donnee.idDonnee')
            ->where('idFiliere', $filiere)
            ->where('idCompetenceDetaillee', $idcd)
            ->first();

        return $lesDonnees;
    }

    /**
     * Modifie une donnée
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $error = "";
        $filiere = request('lyceefilieredonnee');

        $idcd = explode(" - ", request('selectcddonnee'));

        $exist = App\Donnee::where('idDonnee', request('numdonnee'))->first();
        if(isset($exist)){
            App\Donnee::where('idDonnee', request('numdonnee'))->update(['libelleDonnee' => request('libelledonnee')]);
            $message = "Donnée modifiée";
        } else {
            $Donnee = new App\Donnee;
            $Donnee->idDonnee = request('numdonnee');
            $Donnee->libelleDonnee = request('libelledonnee');
            $Donnee->save();
            $message = "Donnée ajoutée";
        }


        App\CompetenceDetaillee::where('idCompetenceDetaillee', $idcd[0])
            ->where('idFiliere', $filiere)
            ->update(['idDonnee' => request('numdonnee')]);

        return back()->withError($error)->withSuccess($message);
    }

    /*
    * @Author Jolan Largeteau
    * Fonction permettant de lister toutes les compétences detaillées qui sont lié a une certaine donnée
    * @param idDonnee: id de la donnée recherché dans le tableau
    */
    public function listeCompetenceDetaillee(Request $request) {
        $idDonnee = $request->idDonnee;
        $lesCompetencesDetaillees = App\CompetenceDetaillee::where('idDonnee', $idDonnee)->get();
        return $lesCompetencesDetaillees;
    }

    /*
     * @Author Jolan Largeteau
     * Fonction retournant la liste complète des filières
     * @return lesFilieres
     */
    public function listeFilieres() {
        $lesFilieres = App\Filiere::all();
        return $lesFilieres;
    }

    /*
     * @Author Jolan Largeteau
     * @return Renvoie toutes les données
     */
    public function listeDonnee() {
        $lesDonnees = App\Donnee::get();
        return $lesDonnees;
    }

    /*
     * @Author Jolan Largeteau
     * Permet de supprimer une donnée et de l'enlever de toutes les compétences détaillées
     * @param idDonnee
     */
    public function supprimer(Request $request) {
        App\CompetenceDetaillee::where('idDonnee', $request->idDonnee)->update(['idDonnee' => null]);
        App\Donnee::where('idDonnee', $request->idDonnee)->delete();
    }
}
