<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournois;
use App\Models\Combat;
use Validator;
use Illuminate\Support\Facades\DB;

class CombatController extends Controller
{


//Information match
public function infoMatch(Request $request){
    $id_match = $request->id_match;
    $match = Combat::find($id_match);
    

    if ($match) {
        return response()->json($match);
        }
    else {
        return response()->json(["status" => 0, "message" => "Cette equipe n'existe pas"],400);
    }
    
}





//Faire un match
public function faireUnMatch(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'id_equipe1' => 'required|numeric',
        'id_equipe2' => 'required|numeric',
        'id_tournois' => 'required|numeric',
         ]);

    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $combat = new Combat;
    
    $combat  ->id_tournois = $request->id_tournois;
    $combat  ->id_equipe1 = $request->id_equipe1;
    $combat  ->id_equipe2 = $request->id_equipe2;
    $ok = $combat ->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Combat creé"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la création"],400);
    }
    }

//Modifier resultat match
public function gagnantMatch(Request $request)
    {
    $validator = Validator::make($request->all(),[
        'id_match' => 'required|numeric',  
        'resultat' => 'required|numeric',        
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $id_match = $request->id_match;
    $combat = Combat::find($id_match);
    
    $combat  ->resultat = $request->resultat;

    $ok = $combat->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le combat est modifier"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la modification"],400);
    }
    }

}