<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriaMedica extends Model
{
    use SoftDeletes;

    protected $table= "historiasmedicas";

    protected $fillable = [
        'cita_id','paciente_id', 'especialidad_id', 'medico_id', 'motivoconsulta',
        'a_familiares', 'a_personales','examenfisico', 'indicacionesHM',
    ];

    public function recipe()
    {
        return $this->hasOne('App\Recipe', 'historiamedica_id');
    }
    public function cita()
    {
        return $this->belongsTo('App\Cita');
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad', 'especialidad_id');
    }

}
