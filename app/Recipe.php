<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table= "recipes";

    protected $fillable = [
        'historiamedica_id', 'status', 'observaciones', 'farmaceuta_id',
    ];

    public function medicina()
    {
        return $this->belongsToMany('App\Medicina', 'medicinas_recipes');
    }
    public function historiaMedica()
    {
        return $this->belongsTo('App\HistoriaMedica', 'historiamedica_id');
    }
    public function farmaceuta()
    {
        return $this->belongsTo('App\User', 'farmaceuta_id');
    }
}
