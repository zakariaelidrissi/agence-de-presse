<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'salaire',
        'compitance',

    ];

    // chaque responsable admet un seul user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
