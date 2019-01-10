<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $table = 'tb_profesiones';
    public $timestamps = false;        # Indica a ORM Eloquent que no usaremos los campos 'created_at' y 'updated_at' en la tabla
}
