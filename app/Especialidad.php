<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especialidad extends Model
{
    use SoftDeletes;

    protected $table = "especialidades";

    protected $fillable = [
        'nombre',
    ];

    public function medico()
    {
        return $this->hasMany('App\User');
    }
    public function usuario()
    {
        return $this->hasMany('App\User');
    }
    public function cita()
    {
        return $this->hasMany('App\Cita');
    }
    public function historiaMedica()
    {
        return $this->hasMany('App\HistorisMedica');
    }

}
