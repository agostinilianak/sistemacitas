<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'medicina_id', 'farmaceuta_id',
    ];

    public function medicina()
    {
        return $this->belongsToMany('App\Medicina', 'medicinas_recipe');
    }
    public function historiaMedica()
    {
        return $this->belongsTo('App\HistoriaMedica');
    }
    public function farmaceuta()
    {
        return $this->belongsTo('App\User', 'farmaceuta_id');
    }
    public function scopeHistoriaMedica($query)
    {
        return $query->where('historia_medica_id', '=', $historia->id);
    }
}
