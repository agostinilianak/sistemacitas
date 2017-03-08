<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = "especialidades";

    protected $fillable = [
        'nombre',
    ];

    public function medico()
    {
        return $this->hasOne('App\User');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Users');
    }

}
