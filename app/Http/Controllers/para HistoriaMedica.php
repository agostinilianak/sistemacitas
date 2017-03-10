<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 09/03/2017
 * Time: 18:00
 */
CONTROLADOR HISTORIA;

$historia = HistoriaMedica::findOrFails($id)
    $historia->id;
    $historia->paciente_id;
    $historia->medico_id;
    $historia->cita_id;
    $hitoria->especialidad_id;
    $hitoria->fecha;

    $medico = User::find($historia->medico_id)
    $cita = Cita::findOrFails($historia->cita_id)
        return view('historia.detalle', ['historia'=>$historia, 'cita'=>$cita]);

    $historia->medico->nombre,

    $recipe=Recipe::historiaMedica($historia->id)->get();