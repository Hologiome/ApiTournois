<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Appartenir_a_une_equipe;
use Validator;
use Illuminate\Support\Facades\DB;

class Appartenir_a_une_equipeController extends Controller
{
// Liste des membres d'une équipe
public function listMembre($id_equipe){
    
    
    $membre = DB::table("Joueur")
    ->join("Appartenir_a_une_equipe","Joueur.id_joueur","=","Appartenir_a_une_equipe.id_joueur")
    ->where('id_equipe','=',$id_equipe) -> get();
    return response()->json($membre);
}   
    
//Rejoindre equipe
public function rejoindreEquipe(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'id_joueur' => 'required|numeric',
        'id_equipe' => 'required|numeric',
         ]);

    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $membre = new Appartenir_a_une_equipe;
    
    $membre ->id_joueur = $request->id_joueur;
    $membre ->id_equipe = $request->id_equipe;
    $ok = $membre ->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Equipe rejoin"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de l'entrée"],400);
    }
    }

//Suprime un membre
public function deleteMembre($id_equipe, $id_joueur){
    $membre = Appartenir_a_une_equipe::where('id_equipe','=',$request->id_equipe)->where('id_joueur','=',$request->id_joueur) -> get(); 
    $ok = $membre->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Equipe supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Cette equipe n'existe pas"],400);
        }
}

}