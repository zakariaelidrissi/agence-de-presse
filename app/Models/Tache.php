<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'coll_id',
        'article_id',
        'body',
        'prix',
        'start_date',
        'end_date',
        'status',
    ];

    // chaque tache admet un seul article
    public function article() {
        return $this->belongsTo(Article::class);
    }

    // chaque tache affecte à un seul collaborateur
    public function collaborateur() {
        return $this->belongsTo(Collaborateur::class);
    }
}
