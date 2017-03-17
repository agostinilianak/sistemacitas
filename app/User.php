<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'fecha_nacimiento', 'sexo', 'telefono', 'celular', 'direccion', 'email',
        'password', 'especialidad_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cita()
    {
        return $this->hasMany('App\Cita', Auth::user()->hasRole('Medico')?'medico_id':'paciente_id');
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad');
    }
    public function recipe()
    {
        return $this->hasMany('App\Recipe');
    }
    public function scopeNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', '%'.$nombre.'%');
    }
    public function scopeApellido($query, $apellido)
    {
        return $query->orWhere('apellido', 'like', '%'.$apellido.'%');
    }
    public function scopeCedula($query, $cedula)
    {
        return $query->orWhere('cedula', 'like', '%'.$cedula.'%');
    }
    public function scopeCedulaPaciente($query, $cedula)
    {
        return $query->where('cedula', '=', $cedula);
    }
}
