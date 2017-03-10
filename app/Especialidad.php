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
        return $this->hasOne('App\User');
    }
    public function cita()
    {
        return $this->hasMany('App\Cita');
    }
    public function usuarios()
    {
        return $this->hasMany('App\Users');
    }
    public function historiaMedica()
    {
        return $this->hasMany('App\HistorisMedica');
    }

}
