<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    use HasFactory;
    protected $fillable = ['client', 'date', 'status','fileUrl', 'departement_affecte', 'agent_affecte'];
}
