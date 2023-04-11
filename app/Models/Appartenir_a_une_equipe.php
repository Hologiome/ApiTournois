<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartenir_a_une_equipe extends Model
{
    use HasFactory;
    protected $table = 'Appartenir_a_une_equipe';
    public $timestamps = false;
    // protected $primaryKey = 'id_joueur';
}