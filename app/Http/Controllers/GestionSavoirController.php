<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class GestionSavoirController extends Controller
{
    //Fonction appelé lors de l'affichage de la page public/gestionsavoir
    public function lister() {
        $lesSavoirs = App\Savoir::all();
        return view('back/formulairegestionsavoir', compact('lesSavoirs'));
    }

    //Fonction appelé dans le fichier backListeSavoirs.js
    public function savoirs(Request $request) {
        $lesSavoirs = App\Savoir::where('idSavoir', $request->data)->first();
        return $lesSavoirs;
    }

    public function liste() {
        $lesSavoirs = App\Savoir::all();
        return $lesSavoirs;
    }

    //Fonction appelé lors de la sauvergarde ou de l'ajout d'une compétence
    public function creation(Request $request) {
        //Récupère la valeur des champs du formulaire
        $idSavoir = (int)$request->idlesavoir;
        $libelleSavoir = $request->libellelesavoir;

        if(is_integer($idSavoir)&&is_string($libelleSavoir)) {
            $leSavoir = App\Savoir::where('idSavoir', $idSavoir)->first();
            if(isset($leSavoir)){
                App\Savoir::where('idSavoir', $idSavoir)
                ->update(['libelleSavoir' => $libelleSavoir]);
                $message = "Savoir modifié !";
            }else{
                $unSavoir = new App\Savoir;
                $unSavoir->idSavoir = $idSavoir;
                $unSavoir->libelleSavoir = $libelleSavoir;
                $unSavoir->save();
                $message = "Savoir sauvegardé !";
            }
        } else {
            $message = "Veuillez entrer des valeurs correctes !";
        }

        return $message;
    }

    public function delete(Request $request){
        App\Savoir::where('idSavoir', $request->idSavoir)->delete();
        App\SavoirDetaille::where('idSavoir', $request->idSavoir)->delete();
        App\SousSavoirDetaille::where('idSavoirDetaille', 'like', $request->idSavoir.'.%')->delete();
    }
}
