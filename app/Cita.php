<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'especialidad_id', 'medico_id', 'paciente_id', 'fecha_cita', 'status',
    ];

    public function paciente()
    {
        return $this->belongsTo('App\User');
    }

    public function especialidad()
    {
        return $this->hasOne('App\Especialidad', 'especialidad_id');
    }

    public function medico()
    {
        return $this->hasMany('App\User', 'medico_id');
    }
}