<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipe;
use Validator;

class EquipeController extends Controller
{

//Liste tous les equipes et recherche
public function listEquipe(Request $request)
    {
    if($request->search){
        $equipe = Equipe::where('nom_equipe','LIKE','%'.$request->search.'%') -> get();
        return response()->json($equipe);
        }
    else{
        $equipe = Equipe::select('id_equipe','nom_equipe','points','tournoiswin','date_creation')->get();
        return response()->json($equipe);
    }
    }

//Ajout equipe
public function ajouterEquipe(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'nom_equipe' => 'required|string',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $equipe = new Equipe;
    
    $equipe ->nom_equipe = $request->nom_equipe;
    $equipe ->points = 0;
    $equipe ->tournoiswin = 0;
    $equipe ->capitaine = $request->capitaine;
    $ok = $equipe ->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le equipe  créé"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la création de l'équipe"],400);
    }
    }


//Suprime une equipe
public function deleteEquipe($id_equipe){
    $equipe = Equipe::find($id_equipe); 
    $ok = $equipe->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Equipe supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Cette equipe n'existe pas"],400);
        }
}


//Modifier equipe
public function putEquipe(Request $request)
    {
    $validator = Validator::make($request->all(),[
        'id_equipe' => 'required|numeric',        
        'nom_equipe' => 'required|string',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $id_equipe = $request->id_equipe;
    $equipe = Equipe::find($id_equipe);
    
    $equipe ->nom_equipe = $request->nom_equipe;

    $ok = $equipe->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le equipe modifier"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la modification"],400);
    }
    }


//Information equipe
public function infoEquipe(Request $request){
    $id_equipe = $request->id_equipe;
    $equipe = Equipe::find($id_equipe);
    

    if ($equipe) {
        return response()->json($equipe);
        }
    else {
        return response()->json(["status" => 0, "message" => "Cette equipe n'existe pas"],400);
    }
    
}
}