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
        return view('citas.index', ['citas' =>$citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = User::role('Paciente')->get();
        $medicos = User::role('Medico')->get();
        $especialidades =Especialidad::all();
        return view('citas.create', ['especialidades'=>$especialidades, 'pacientes'=>$pacientes, 'medicos'=>$medicos]);
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
            'paciente' => 'required',
            'especialidad'=> 'required',
            'medico' => 'required',
            'fecha_cita' => 'required',
            'status' => 'required',
            'observaciones' => 'max:100',

        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $cita = Cita::create([
                'paciente_id' => $request->input('paciente'),
                'especialidad_id' => $request->input('especialidad'),
                'medico_id' => $request->input('medico'),
                'fecha_cita' => $request->input('fecha_cita'),
                'observaciones' => $request->input('observaciones'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
        return redirect('/pacientes')->with('mensaje', 'Cita creada Exitosamente');
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
        if(!Auth::user()->can('EditarCita'))
            abort(403,'Acceso Prohibido');

        $pacientes = User::role('Paciente')->get();
        $medicos = User::role('Medico')->get();
        $especialidades =Especialidad::all();
        return view('citas.create', ['especialidades'=>$especialidades, 'pacientes'=>$pacientes, 'medicos'=>$medicos]);
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
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'cedula' => 'required|max:8|unique:users,cedula,' . $id . ',id',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'telefono' => 'max:255',
            'celular' => 'max:255',
            'direccion' => 'max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',id',
            'role' => 'required',
            'especialidad'=> 'required_if:role,Medico',

        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->update([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'cedula' => $request->input('cedula'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'sexo' => $request->input('sexo'),
                'telefono' => $request->input('telefono'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion'),
                'email' => $request->input('email'),
                'especialidad_id' => $request->input('especialidad'),
            ]);

            if ($request->input('password')) {
                $v = Validator::make($request->all(),
                    [
                        'password' => 'required|min:6|confirmed',
                    ]);

                if ($v->fails()) {
                    return redirect()->back()->withErrors($v)->withInput();
                }
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
            }
            $user->syncRoles($request->input('role'));

        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
        return redirect('/home')->with('mensaje', 'Actualización satisfactoria');
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
        return redirect('/home')->with('mensaje', 'Usuario eliminado satisfactoriamente');
    }

    public function permisos($id){
        $role = Role::findOrFail($id);
        $permisos = Permission::all();
        return view('roles.permisos', ['role'=>$role, 'permisos'=>$permisos]);
    }

}
