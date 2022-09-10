<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'phone',
        'birthday',        
        'photo',
        'compitance',
        'devise',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // chaque user admet un seul responsable
    public function responsable() {
        return $this->hasOne(Responsable::class);
    }

    // chaque user admet un seul coolaborateur
    public function collaborateur() {
        return $this->hasOne(Collaborateur::class);
    }

    // chaque user admet plusieurs messages
    public function messages() {
        return $this->hasMany(Message::class);
    }

    // chaque user admet plusieurs article
    public function articles() {
        return $this->hasMany(Article::class);
    }
    
    // chaque User admet plusieurs tache
    public function taches() {
        return $this->hasMany(Tache::class);
    }
}
