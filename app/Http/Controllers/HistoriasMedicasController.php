<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SoftDeletes;
use App\User;
use App\Especialidad;
use App\Cita;
use App\HistoriaMedica;

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
    public function create($id=null)
    {
        if (!Auth::user()->can('CrearHistoriaMedica'))
            abort(403, 'Acceso Prohibido');

        $cita = Cita::findOrFail($id);
        $user = $cita->paciente;
        $medico = $cita->medico;
        $especialidad = $cita->especialidad;
        return view('historiasmedicas.create', ['user'=>$user, 'cita'=>$cita, 'especialidad'=>$especialidad, 'medico'=>$medico]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

            HistoriaMedica::create([
                'cita_id'=>$request->input('cita_id'),
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $request->input('especialidad_id'),
                'medico_id' => $request->input('medico_id'),
                'motivoconsulta' => $request->input('motivoconsulta'),
                'a_familiares' => $request->input('a_familiares'),
                'a_personales' => $request->input('a_personales'),
                'examenfisico' => $request->input('examenfisico'),
                'indicacionesHM' => $request->input('indicacionesHM'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            var_dump($e);
        } finally {
            \DB::commit();
        }
        return redirect('/medicos/vermiscitas')->with('mensaje', 'Historia Medica creada Exitosamente');
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

        $hmedica=HistoriaMedica::all();
        $citas=Cita::where('medico_id','=', Auth::user()->id )->paginate();
        return view('medicos.vermiscitas', ['hmedica'=>$hmedica, 'citas'=>$citas]);
    }
}
