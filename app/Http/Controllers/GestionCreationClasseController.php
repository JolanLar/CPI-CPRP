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
        if(Session::has('droit'))
        {
            $dr = Session::get('droit');
            if($dr->Droit != 1)
            {
                Session::flush();
                return redirect('connexion');
            }
        }
        else
        {
            return redirect('connexion'); 
        }
        $laFiliere = "ST1CPI";
        $lesClasses = App\AnneeEtude::all();
        $lesFilieres = App\Filiere::all();
        
        return view('back/formulairegestioncreationclasse',compact('lesClasses','lesFilieres'));
    }

    /**
    * Liste les étudiants pour une classe spécifique
    * @return retour les étudiants
    */       
    public function majBDD(Request $request)
    {
        $laClasse = $request->classe;
        $laFiliere = App\Filiere::join('anneeetude', 'anneeetude.idFiliere', '=', 'filiere.idFiliere')
                ->where('libelleAnneeEtude',$laClasse)
                ->first();
        
        return $laFiliere;
    }

    /**
    * Ajoute un étudiant dans une classe
    * @return retour avec message/erreur
    */    
    public function creation()
    {
         if(request('selectgestionclasse') =="ST1CPI")
         {
            $idAnnee = "1";
            $filiere="1";
         }
         else if(request('selectgestionclasse') =="ST2CPI")
         {
            $idAnnee = "2";
            $filiere="1";
         }
         else if(request('selectgestionclasse') =="ST1CPRP")
         {
            $idAnnee = "3";
            $filiere="2";
         }
         else if(request('selectgestionclasse') =="ST2CPRP")
         {
            $idAnnee = "4";
            $filiere ="2";
         }
         
        $error = "";
        $message = "";
        $classe = request('selectgestionclasse');
        $id = explode(" : ",request('selectgestionutilisateur'));
        $annee = request('selectgestionclasseannee');
        
        $siexistant = App\EtudiantAnnee::where('idUtilisateur',$id[0])
                ->first();
        
        if($siexistant == null)
        {
		$etudiantannee = new App\EtudiantAnnee;
		$etudiantannee->idUtilisateur = $id[0];
                $etudiantannee->annee = $annee;
                $etudiantannee->idAnneeEtude = $idAnnee;
                $etudiantannee->idFiliere = $filiere;   
		$etudiantannee->save();
		$message = "Etudiant ajouté à la classe ".$classe;
        }
        else
        {
            $error = "Etudiant déjà dans une classe";
        }
        return back()->withError($error)->withSuccess($message);
	}

    /**
    * Supprime un étudiant d'une classe
    * @return retour message
    */ 
    public function supprimer($id)
    {
                 App\EtudiantAnnee::where('idUtilisateur', $id)
                    ->delete();
                 $message = "Etudiant supprimé de la classe"; 
        
         return back()->withSuccess($message);
    }
}