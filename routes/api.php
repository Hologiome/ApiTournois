<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Combat;
use App\Models\Equipe;
use App\Models\Jeu;
use App\Models\Joueur;
use App\Models\Tournois;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    return response()->json(["message" => "Bienvenue dans l'API Tournois"],200);
   });


   

Route::get('/tournois', [App\Http\Controllers\TournoisController::class, 'listTournois']);

Route::post('/tournois', [App\Http\Controllers\TournoisController::class, 'ajouterTournois']);

Route::delete('/tournois/{id_tournois}', [App\Http\Controllers\TournoisController::class, 'deleteTournois']);

Route::put('/tournois', [App\Http\Controllers\TournoisController::class, 'putTournois']);

Route::get('/tournois/{id_tournois}', [App\Http\Controllers\TournoisController::class, 'infoTournois']);





Route::get('/joueur', [App\Http\Controllers\JoueurController::class, 'listJoueur']);

Route::delete('/joueur/{id_joueur}', [App\Http\Controllers\JoueurController::class, 'deleteJoueur']);

Route::put('/joueur', [App\Http\Controllers\JoueurController::class, 'putJoueur']);

Route::get('/joueur/{id_joueur}', [App\Http\Controllers\JoueurController::class, 'infoJoueur']);

Route::post('/inscription', [App\Http\Controllers\JoueurController::class, 'inscriptionJoueur']);

Route::post('/connexion', [App\Http\Controllers\JoueurController::class, 'connexionJoueur']);




Route::get('/equipe', [App\Http\Controllers\EquipeController::class, 'listEquipe']);

Route::post('/equipe', [App\Http\Controllers\EquipeController::class, 'ajouterEquipe']);

Route::delete('/equipe/{id_equipe}', [App\Http\Controllers\EquipeController::class, 'deleteEquipe']);

Route::put('/equipe', [App\Http\Controllers\EquipeController::class, 'putEquipe']);

Route::get('/equipe/{id_equipe}', [App\Http\Controllers\EquipeController::class, 'infoEquipe']);




Route::get('/appartenir/{id_equipe}', [App\Http\Controllers\Appartenir_a_une_equipeController::class, 'listMembre']);

Route::post('/appartenir', [App\Http\Controllers\Appartenir_a_une_equipeController::class, 'rejoindreEquipe']);

Route::delete('/appartenir/equipe/{id_equipe}/joueur/{id_joueur}', [App\Http\Controllers\Appartenir_a_une_equipeController::class, 'deleteMembre']);




Route::get('/participer/{id_tournois}', [App\Http\Controllers\Equipe_d_un_tournoisController::class, 'listDesEquipe']);

Route::post('/participer', [App\Http\Controllers\Equipe_d_un_tournoisController::class, 'rejoindreTournois']);




Route::get('/match/{id_match}', [App\Http\Controllers\CombatController::class, 'infoMatch']);

Route::post('/match', [App\Http\Controllers\CombatController::class, 'faireUnMatch']);

Route::put('/match', [App\Http\Controllers\CombatController::class, 'gagnantMatch']);





