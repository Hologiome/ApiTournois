<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;
use Validator;

class JoueurController extends Controller
{

//Liste tous les joueurs et recherche
public function listJoueur(Request $request)
    {
    if($request->search){
        $joueur = Joueur::where('pseudo','LIKE','%'.$request->search.'%') -> get();
        return response()->json($joueur);
        }
    else{
        $joueur = Joueur::select('id_joueur','pseudo','date_inscription','point','win','admin')->get();
        return response()->json($joueur);
    }
    }


//Suprime un joueur
public function deleteJoueur($id_joueur){
    $joueur = Joueur::find($id_joueur); 
    $ok = $joueur->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Joueur supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Ce produit n'existe pas"],400);
        }
}

//Modifier joueur
public function putJoueur(Request $request)
    {
    $validator = Validator::make($request->all(),[
        'id_joueur' => 'required|numeric',        
        'pseudo' => 'required|string',
        'email' => 'required|email',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $id_joueur = $request->id_joueur;
    $joueur = Joueur::find($id_joueur);
    
    $joueur->pseudo = $request->pseudo;
    $joueur->email = $request->email;

    $ok = $joueur->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le joueur modifier"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la modification"],400);
    }
    }



//Donne le profil ou les information d'un joueur
public function infoJoueur(Request $request){
    $id_joueur = $request->id_joueur;
    $joueur = Joueur::find($id_joueur);
    
    if ($joueur) {
        return response()->json($joueur);
        }
    else {
        return response()->json(["status" => 0, "message" => "Ce joueur n'existe pas"],400);
    }
}

//Inscription joueur
public function inscriptionJoueur(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'pseudo' => 'required|string',
        'email' => 'required|email',
        'mdp' => 'required|string',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }


    $joueur = new Joueur;
    
    $joueur->pseudo = $request->pseudo;
    $joueur->point = 0;
    $joueur->email = $request->email;
    $joueur->mdp = $request->mdp;
    $joueur->win = 0;
    $joueur->admin = 0;
    $ok = $joueur->save();
    if ($ok) {
    return response()->json(["status" => 1, "message" => "Le joueur inscript"],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de l'inscription"],400);
    }
    }

//Connexion    
public function connexionJoueur(Request $request)
    {
    $validator = Validator::make($request->all(),[        
        'email' => 'required|email',
        'mdp' => 'required|string',
         ]);


    if ($validator->fails()) {
        return response()->json(["status" => 0, "message" => $validator->errors()],400);
        }

    
    $joueur = Joueur::where('email', '=', $request->email)->where('mdp', '=', $request->mdp) -> get();
        
    // return response()->json(count($joueur));
    
    if (count($joueur)!=0) {
    return response()->json(["status" => 1, "joueur" => $joueur],201);
    } else {
    return response()->json(["status" => 0, "message" => "pb lors de la connexion"],400);
    }
    }



}