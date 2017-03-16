<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Especialidad;
use App\HistoriaMedica;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


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
        return view('citas.index', ['citas' => $citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('SolicitarCita'))
            abort(403, 'Permiso Denegado.');

        $paciente = User::role('Paciente')->get();
        $medico = User::role('Medico')->get();
        $especialidad = Especialidad::all();
        return view('citas.create', ['especialidad' => $especialidad, 'paciente' => $paciente, 'medico' => $medico]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'medico' => 'required',
            'fecha_cita' => 'required',
            'hora_cita' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        $medico = User::findOrFail($request->input('medico'));
        try {
            \DB::beginTransaction();

            Cita::create([
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $medico->especialidad->id,
                'medico_id' => $medico->id,
                'fecha_cita' => $request->input('fecha_cita'),
                'hora_cita' => $request->input('hora_cita'),
                'status' => ($request->input('status') != '') ? $request->input('status') : 'solicitada',
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/citas')->with('mensaje', 'No se pudo procesar su solicitud. Verifique si el paciente ya posee una cita en la misma fecha con el Medico seleccionado');
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
        if (!Auth::user()->can('EditarCita'))
            abort(403, 'Permiso Denegado.');

        $cita = Cita::findOrFail($id);
        $paciente = User::findOrFail($cita->paciente_id);
        $medicos = User::role('Medico')->get();
        $especialidades = Especialidad::all();
        return view('citas.edit', ['cita' => $cita, 'especialidades' => $especialidades, 'paciente' => $paciente, 'medicos' => $medicos]);
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
        $v = Validator::make($request->all(), [
            'medico' => 'required',
            'fecha_cita' => 'required',
            'hora_cita' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        $medico = User::findOrFail($request->input('medico'));
        try {
            \DB::beginTransaction();
            $cita = Cita::findOrFail($id);
            $cita->update([
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $medico->especialidad->id,
                'medico_id' => $medico->id,
                'fecha_cita' => $request->input('fecha_cita'),
                'hora_cita' => $request->input('hora_cita'),
                'status' => ($request->input('status') != '') ? $request->input('status') : 'solicitada',
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/citas')->with('mensaje', 'No se pudo procesar su solicitud.');
        } finally {
            \DB::commit();
        }
        return redirect(Auth::user()->hasRole('Medico')?'/medicos/vermiscitas': '/citas')->with('mensaje', 'Cita editada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('EliminarCita'))
            abort(403, 'Permiso Denegado.');

        User::destroy($id);
        return redirect('/citas')->with('mensaje', 'Cita eliminada satisfactoriamente');
    }

    public function cambiarstatuscita($id)
    {
        if (!Auth::user()->can('CambiarStatusCita'))
           abort(403);

        $cita = Cita::findOrFail($id);
        $paciente = User::findOrFail($cita->paciente_id);
        $medico = User::findOrFail($cita->medico_id);
        $especialidad = Especialidad::all();
        return view('citas.cambiarstatuscita', ['cita' => $cita, 'paciente' => $paciente, 'medico' => $medico, 'especialidad' => $especialidad]);
    }

    public function vermiscitas()
    {
        if(!Auth::user()->can('VerMisCitas'))
            abort(403);

        $citas=Cita::orderBy('status')->get();
        return view('pacientes.vermiscitas', ['citas'=>$citas]);
    }

    public function vermiscitasmedico()
    {
        if(!Auth::user()->can('VerMisCitas'))
            abort(403);

        $citas=Cita::where('medico_id','=', Auth::user()->id )->where('status','=', 'solicitada')
            ->orderBy('fecha_cita')->get();
        return view('medicos.vermiscitas', ['citas'=>$citas]);
    }
}
