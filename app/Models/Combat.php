<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combat extends Model
{
    use HasFactory;
    protected $table = 'Combat';
    public $timestamps = false;
    protected $primaryKey = 'id_match';
}
