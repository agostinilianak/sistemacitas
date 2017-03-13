<?php

namespace App\Http\Controllers;

use App\Historia_Medica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SoftDeletes;
use App\User;
use App\Especialidad;
use App\Cita;

class HistoriasMedicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('CrearHistoriaMedica'))
            abort(403, 'Acceso Prohibido');

        $user= User::all();
        $roles = Role::all();
        $especialidades = Especialidad::all();
        $citas= Cita::all();
        return view('historiasmedicas.create', ['user'=>$user, 'roles' => $roles, 'especialidades'=>$especialidades, 'citas'=>$citas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function vermiscitasmedico()
    {
        if(!Auth::user()->can('ModuloMedico'))
            abort(403);

        $hmedicas=Historia_Medica::all();
        return view('medicos.vermiscitas', ['hmedicas'=>$hmedicas]);
    }
}
