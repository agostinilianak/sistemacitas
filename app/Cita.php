<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'paciente_id', 'especialidad_id', 'medico_id', 'fecha_cita', 'hora_cita','status',
    ];

    public function paciente()
    {
        return $this->belongsTo('App\User', 'paciente_id');
    }

    public function especialidad()
    {
        return $this->hasOne('App\Especialidad', 'especialidad_id');
    }

    public function medicos()
    {
        return $this->belongsTo('App\User', 'medico_id');
    }

    public function historiaMedica()
    {
        return $this->hasOne('App\HistoriaMedica');
    }


}
