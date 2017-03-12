<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Especialidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
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
        $citas = Cita::paginate(10);
        return view('citas.index', ['citas'=>$citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente = User::role('Paciente')->get();
        $medico = User::role('Medico')->get();
        $especialidad =Especialidad::all();
        return view('citas.create', ['especialidad'=>$especialidad, 'paciente'=>$paciente, 'medico'=>$medico]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medico = User::findOrFail($request->input('medico'));

        try {
            \DB::beginTransaction();

            Cita::create([
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $medico->especialidad->id,
                'medico_id' => $medico->id,
                'fecha_cita' => $request->input('fecha_cita'),
                'hora_cita' => $request->input('hora_cita'),
                'status' => ($request->input('status')!='')?$request->input('status'):'solicitada',
            ]);

        } catch (\Exception $e) {
            \DB::rollback();

        } finally {
            \DB::commit();
        }
        return redirect('/citas')->with('mensaje', 'Cita creada Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = User::role('Paciente')->get();
        $medico = User::role('Medico')->get();
        $especialidades = Especialidad::all();
        return view('citas.edit', ['especialidades'=>$especialidades, 'paciente'=>$paciente, 'medico'=>$medico]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medico = User::findOrFail($request->input('medico'));

        try {
            \DB::beginTransaction();
            $cita=Cita::findOrFail($id);
            $cita->update([
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $medico->especialidad->id,
                'medico_id' => $medico->id,
                'fecha_cita' => $request->input('fecha_cita'),
                'hora_cita' => $request->input('hora_cita'),
                'status' => $request->input('status'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
        return redirect('/citas')->with('mensaje', 'Cita editada Exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('EliminarUsuario'))
            abort(403, 'Permiso Denegado.');

        User::destroy($id);
        return redirect('/citas')->with('mensaje', 'Cita eliminado satisfactoriamente');
    }

    public function vermiscitas()
    {
        if(!Auth::user()->can('VerMisCitas'))
            abort(403);

        return view('pacientes.vermiscitas');
    }

}
