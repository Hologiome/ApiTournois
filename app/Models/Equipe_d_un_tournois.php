<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe_d_un_tournois extends Model
{
    use HasFactory;
    protected $table = 'Equipe_d_un_tournois';
    public $timestamps = false;
    // protected $primaryKey = 'id_joueur';
}