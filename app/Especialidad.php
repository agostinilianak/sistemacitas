<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = "especialidades";

    protected $fillable = [
        'nombre',
    ];

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

    public function especialidad()
    {
        return $this->belongsToMany('App\Especialidad', 'especialidad_id');
    }
}
