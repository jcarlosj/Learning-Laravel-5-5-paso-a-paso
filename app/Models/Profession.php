<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profession extends Model
{
    protected $table = 'tb_profesiones';
    public $timestamps = false;        # Indica a ORM Eloquent que no usaremos los campos 'created_at' y 'updated_at' en la tabla
    protected $fillable = [ 'title' ]; # Campos o columnas que deseamos permitir cargar de forma masiva (Reiniciar Tinker si se esta usando para pruebas)

    # Define relación entre este entidad/objeto/tabla con otro a muchos
    public function users() {                           # Eloquent buscará un campo con el nombre de este método más el postfijo _id para hacer dicha busqueda ( profession_id )
        return $this -> hasMany( User :: class );    # Profession "tiene muchos" Users (devolviendo un objeto de la clase User)
    }
}
