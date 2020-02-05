<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionCreationClasseController extends Controller
{
    /**
     * Liste toutes les filieres et classes
     * @return retour page avec les filieres et classes
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
        $lesClasses = App\AnneeEtude::all();
        $lesFilieres = App\Filiere::all();

        $find = false;
        foreach ($lesClasses as $i => $uneClasse) {
            if ($i + 1 != $uneClasse->idAnneeEtude) {
                $idAjout = $i;
                $find = true;
            }
        }
        if ($find == false) {
            $idAjout = count($lesClasses) + 1;
        }

        return view('back/formulairegestioncreationclasse', compact('lesClasses', 'lesFilieres', 'idAjout'));
    }

    /**
     * Liste les étudiants pour une classe spécifique
     * @return retour les étudiants
     */
    public function majBDD(Request $request)
    {
        $laClasse = $request->classe;
        $laFiliere = App\Filiere::join('anneeetude', 'anneeetude.idFiliere', '=', 'filiere.idFiliere')
            ->where('idAnneeEtude', $laClasse)
            ->first();

        return $laFiliere;
    }

    /**
     * Ajoute un étudiant dans une classe
     * @return retour avec message/erreur
     */
    public function creation()
    {
        $idAnnee = request('selectcreationclasse');
        $filiere = request('selectfiliereassociee');
        $libelle = request('idnomclasse');

        $laClasse = App\AnneeEtude::where('idAnneeEtude', $idAnnee)->first();

        if (isset($laClasse)) {
            App\AnneeEtude::where('idAnneeEtude', $idAnnee)->update(['libelleAnneeEtude' => $libelle, 'idFiliere' => $filiere]);
        } else {
            $anneeetude = new App\AnneeEtude;
            $anneeetude->idAnneeEtude = $idAnnee;
            $anneeetude->libelleAnneeEtude = $libelle;
            $anneeetude->idFiliere = $filiere;
            $anneeetude->save();
        }

        return redirect('gestioncreationclasse');
    }

    /**
     * Supprime un étudiant d'une classe
     */
    public function delete(Request $request)
    {
        App\AnneeEtude::where('idAnneeEtude', $request->idAnneeEtude)->delete();
    }
}
