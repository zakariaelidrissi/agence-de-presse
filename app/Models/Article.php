<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'etat',
        'categorie',
        'photo',
        'likes',
        'dis_likes',
        'redacteur_id',
        'correcteur_id',
        'traducteur_id',
    ];

    // chaque article admet plusieurs taches
    public function taches() {
        return $this->hasMany(Tache::class);
    }
}
