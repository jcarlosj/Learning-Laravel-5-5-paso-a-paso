<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    # Agrega propiedad $casts para convertir el campo/columna 'is_admin' de la tabla de un valor entero a un booleano
    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function isAdmin() {
        return $this -> email === 'jcjimenez29@misena.edu.co';
    }

    public static function findByEmail( $email ) {
        return static :: where( compact( 'email' ) ) -> first();   # Escribir static equivale a escribir User
    }
}
