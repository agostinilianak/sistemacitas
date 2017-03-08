<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Cita;
use Validator;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $citas = Cita::paginate(10);
        return view('citas.index', ['citas'=>$citas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('SolicitarCita'))
            abort(403, 'Acceso Prohibido');

        $pacientes = User::role('Paciente')->get();
        $especialidades = Especialidad::all();
        $medicos = User::role('Medico')->get();
        return view('citas.create', ['especialidades'=>$especialidades, 'pacientes'=>$pacientes, 'medicos'=>$medicos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function solicitarcita()
    {
        return view('pacientes.solicitarcita');
    }

}
