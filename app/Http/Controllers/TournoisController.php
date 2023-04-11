<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournois;
use Validator;

class TournoisController extends Controller
{

//Liste tous les tournois
 public function listTournois(Request $request)
    {
    
    if($request->search){
        if($request->nom_jeu){
            $tournois = Tournois::where('nom_tournois','LIKE','%'.$request->search.'%')->Where('nom_jeu','=',$request->nom_jeu) -> get();
            return response()->json($tournois);
            }
        else{
            $tournois = Tournois::where('nom_tournois','LIKE','%'.$request->search.'%')-> get();
            return response()->json($tournois);
        }
        }
    if($request->nom_jeu){
        $tournois = Tournois::Where('nom_jeu','=',$request->nom_jeu) -> get();
        return response()->json($tournois);
    }
    else{
        $tournois = Tournois::select('id_tournois','nom_tournois','date_tournois','recompense','ranks','slotes','nom_jeu')->get();
        return response()->json($tournois);
    }
    }


//Ajoute un tournois
public function ajouterTournois(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'nom_tournois' => 'required|string',
        'date_tournois' => 'required|date',
        'recompense' => 'required|numeric',
        'ranks' => 'required|string',
        'slotes' => 'required|numeric',
        'nom_jeu' => 'required|string',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }

    $tournois = new Tournois;
    
    $tournois->nom_tournois = $request->nom_tournois;
    $tournois->date_tournois = $request->date_tournois;
    $tournois->recompense = $request->recompense;
    $tournois->ranks = $request->ranks;
    $tournois->slotes = $request->slotes;
    $tournois->nom_jeu = $request->nom_jeu;
    $ok = $tournois->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le tournois ajouté"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de
   l'ajout"],400);
    }
    }


//Suprime un tournoi 
public function deleteTournois($id_tournois){
    $tournois = Tournois::find($id_tournois); 
    $ok = $tournois->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Tournois supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Ce produit n'existe pas"],400);
        }
}



//Modifie un tournoi
public function putTournois(Request $request){
    $validator = Validator::make($request->all(), [
        'id_tournois' => 'required|numeric',
        'nom_tournois' => 'required|string',
        'date_tournois' => 'required|date',
        'recompense' => 'required|numeric',
        'ranks' => 'required|string',
        'slotes' => 'required|numeric',
        'nom_jeu' => 'required|string',
         ]);

    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $id_tournois = $request->id_tournois;
    $tournois = Tournois::find($id_tournois);
    $tournois->nom_tournois = $request->nom_tournois;
    $tournois->date_tournois = $request->date_tournois;
    $tournois->recompense = $request->recompense;
    $tournois->ranks = $request->ranks;
    $tournois->slotes = $request->slotes;
    $tournois->nom_jeu = $request->nom_jeu;
    $ok = $tournois->save();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Tournois modifier"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Ce produit n'existe pas"],400);
        }
}



//Donne le profil/information d'un tournois
public function infoTournois(Request $request){
    $id_tournois = $request->id_tournois;
    $tournois = Tournois::find($id_tournois);
    
    if ($tournois) {
        return response()->json($tournois);
        }
    else {
        return response()->json(["status" => 0, "message" => "Ce produit n'existe pas"],400);
    }
}

}
