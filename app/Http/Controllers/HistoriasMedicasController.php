<?php

namespace App\Http\Controllers;

Use Validator;
use App\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SoftDeletes;
use App\User;
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

    public function index($id=null)
    {
        $hmedicas = null;
        $buscar = \Request::get('buscar');
        if($buscar!='')
            $hmedicas= HistoriaMedica::nombre($buscar)
                ->apellido($buscar)
                ->cedula($buscar)
                ->paginate();
        else
            $hmedicas = HistoriaMedica::paginate(10);
        return view('historiasmedicas.index', ['hmedicas' =>$hmedicas, 'buscar'=>$buscar]);
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
        $hmedica = HistoriaMedica::all();
        return view('historiasmedicas.create', ['user'=>$user, 'cita'=>$cita, 'especialidad'=>$especialidad,
                                                'medico'=>$medico, 'hmedica'=>$hmedica]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v=Validator::make($request->all(),[
            'cita_id' => 'required',
            'motivoconsulta' => 'required',
            'examenfisico' => 'required',
            'indicacionesHM' => 'required',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        try {
            \DB::beginTransaction();
            $hmedica= HistoriaMedica::create([
                'cita_id'=>$request->input('cita_id'),
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $request->input('especialidad_id'),
                'medico_id' => $request->input('medico_id'),
                'motivoconsulta' => $request->input('motivoconsulta'),
                'examenfisico' => $request->input('examenfisico'),
                'indicacionesHM' => $request->input('indicacionesHM'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/medicos/vermiscitas')->with('mensaje', 'No se pudo procesar su solicitud. Este paciente ya tiene una Historia Medica creada para esta cita');
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
        $hmedica = HistoriaMedica::findOrFail($id);
        return view('historiasmedicas.edit', ['hmedica' => $hmedica]);
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
        $v = Validator::make($request->all(), [
            'cita_id' => 'required',
            'motivoconsulta' => 'required',
            'examenfisico' => 'required',
            'indicacionesHM' => 'required',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        try {
            \DB::beginTransaction();
            $hmedica = HistoriaMedica::findOrFail($id);
            $hmedica->update([
                'cita_id'=>$request->input('cita_id'),
                'paciente_id' => $request->input('paciente_id'),
                'especialidad_id' => $request->input('especialidad_id'),
                'medico_id' => $request->input('medico_id'),
                'motivoconsulta' => $request->input('motivoconsulta'),
                'examenfisico' => $request->input('examenfisico'),
                'indicacionesHM' => $request->input('indicacionesHM'),
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/historiasmedicas')->with('mensaje', 'No se pudo procesar su solicitud.');
        } finally {
            \DB::commit();
        }
        return redirect('/historiasmedicas')->with('mensaje', 'Historia Medica editada Exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('EliminarHistoriaMedica'))
            abort(403, 'Permiso Denegado.');

        HistoriaMedica::destroy($id);
        return redirect('/historiasmedicas')->with('mensaje', 'Historia Medica eliminada satisfactoriamente');
    }
    public function verhistoriamedica($id)
    {
        $hmedica = HistoriaMedica::findOrFail($id);
        return view('historiasmedicas.verhistoriamedica', ['hmedica' => $hmedica]);
    }
}
