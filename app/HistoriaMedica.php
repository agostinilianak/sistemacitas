<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaMedica extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cita_id','paciente_id', 'especialidad_id', 'medico_id', 'motivoconsulta',
        'a_familiares', 'a_personales','examenfisico', 'indicacionesHM',
    ];

    public function recipe()
    {
        return $this->hasOne('App\Recipe');
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
