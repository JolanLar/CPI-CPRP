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
     * Liste les donnees pour une filiere et une compétence détaillée spécifique
     * @return retour les donnees
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
        $message = "";
        $filiere = request('lyceefilieredonnee');

        $idcd = explode(" - ", request('selectcddonnee'));


        App\Donnee::where('idDonnee', request('numdonnee'))->update(['libelleDonnee' => request('libelledonnee')]);

        App\CompetenceDetaillee::where('idCompetenceDetaillee', $idcd[0])
            ->where('idFiliere', $filiere)
            ->update(['idDonnee' => request('numdonnee')]);

        $message = "Donnée modifiée";
        return back()->withError($error)->withSuccess($message);
    }

    /*
    * @Author Jolan Largeteau
    * Fonction permettant de lister toutes les compétences detaillées qui sont lié a une certaine donnée
    * @param idDonnee: id de la donnée recherché dans le tableau
    */
    public function listeCompetenceDetaillee() {
        
    }
}
