<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicina extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
    ];

    public function recipe()
    {
        return $this->belongsToMany('App\Recipe', 'medicinas_recipes', 'medicina_id', 'recipe_id');
    }
}
