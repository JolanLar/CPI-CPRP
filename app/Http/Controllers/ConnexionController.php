<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App;

class ConnexionController extends Controller
{

    public function formulaire()
    {
        /**
         * oubli de la session droit (en cas de déconnexion par example)
         * @return type Vue welcome
         */
        Session::forget('droit');
        return view('welcome');
    }

    public function traitement(Request $request)
    {
        /**
         * traitement de la connexion en fonction du type d'utilisateur (droits)
         * @return type Vue gestionutilisateur ou professeur ou eleve
         */
        $idUtilisateur = $request->idUtilisateur;
        $mdpUtilisateur = $request->mdpUtilisateur;
        $co = App\Utilisateur::where('utilisateur.idUtilisateur', $idUtilisateur)
            ->where('utilisateur.mdpUtilisateur', sha1($mdpUtilisateur))
            ->first();
        if ($co == null) {
            $error = "Le nom d'utilisateur ou le mot de passe est incorrect";
            return back()->withError($error);
        } else {
            Session::put('droit', $co);
            if ($co->Droit == '1') {
                return redirect('/gestionutilisateur');
            } else if ($co->Droit == '5') {
                return redirect('/professeur/tls');
            } else {
                $co = App\Utilisateur::where('utilisateur.idUtilisateur', $idUtilisateur)
                    ->join('etudiant', 'etudiant.idUtilisateur', '=', 'utilisateur.idUtilisateur')
                    ->join('etudiantannee', 'etudiant.idUtilisateur', '=', 'etudiantannee.idUtilisateur')
                    ->join('filiere', 'filiere.idFiliere', '=', 'etudiantannee.idFiliere')
                    ->where('utilisateur.mdpUtilisateur', sha1($mdpUtilisateur))
                    ->first();
                Session::put('droit', $co);
                return redirect('/eleve');
            }
        }
    }
}
