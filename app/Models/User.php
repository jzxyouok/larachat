<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 1;
    const USER = 2;

    protected $casts = ['id' => 'integer'];
    protected $table = 'users';
    protected $fillable = ['name', 'address', 'age', 'weight', 'height', 'hair_colour', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        if($this->role == self::ADMIN) return true;

        return false;
    }
}
