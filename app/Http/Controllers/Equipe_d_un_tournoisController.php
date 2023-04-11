<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournois;
use App\Models\Equipe;
use App\Models\Equipe_d_un_tournois;
use Validator;
use Illuminate\Support\Facades\DB;

class Equipe_d_un_tournoisController extends Controller
{

// Liste des equipes d'un tournois
public function listDesEquipe($id_tournois){
    
    
    $participant = DB::table("Equipe")
    ->join("Equipe_d_un_tournois","Equipe.id_equipe","=","Equipe_d_un_tournois.id_equipe")
    ->where('id_tournois','=',$id_tournois) -> get();
    return response()->json($participant );
} 




//Rejoindre tournois
public function rejoindreTournois(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'id_tournois' => 'required|numeric',
        'id_equipe' => 'required|numeric',
         ]);

    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $participant = new Equipe_d_un_tournois;
    
    $participant ->id_tournois = $request->id_tournois;
    $participant ->id_equipe = $request->id_equipe;
    $ok = $participant ->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Tournois rejoin"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de l'entrée"],400);
    }
    }


}