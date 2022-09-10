<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'salaire',
        'score',
        'is_freelancer',
        'compitance',
        'theme',
        'disponible',
    ];

    // chaque collaborateur admet un seul user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // chaque collaborateur admet un seul tache
    public function tache() {
        return $this->hasOne(Tache::class);
    }
}
