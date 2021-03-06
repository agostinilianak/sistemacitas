<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Especialidad;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;


class UsersController extends Controller
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
        $users = null;
        $buscar = \Request::get('buscar');
        if($buscar!='')
            $users= User::nombre($buscar)
                ->apellido($buscar)
                ->cedula($buscar)
                ->paginate();
        else
            $users = User::paginate();
        return view('users.index', ['users' =>$users, 'buscar'=>$buscar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('RegistrarUsuario'))
            abort(403, 'Acceso Prohibido');

        $user= User::all();
        $roles = Role::all();
        $especialidades = Especialidad::all();
        return view('users.create', ['user'=>$user, 'roles' => $roles, 'especialidades'=>$especialidades]);
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
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'cedula' => 'required|max:8|unique:users',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'telefono' => 'max:255',
            'celular' => 'max:255',
            'direccion' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => Auth::user()->hasRole('Secretaria')? '':'required',
            'especialidad'=> 'required_if:role,Medico',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $user = User::create([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'cedula' => $request->input('cedula'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'sexo' => $request->input('sexo'),
                'telefono' => $request->input('telefono'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'especialidad_id' => ($request->input('especialidad')!='')?$request->input('especialidad'):NULL,
            ]);

            $user->assignRole(Auth::user()->hasRole('Secretaria')? 'Paciente':$request->input('role'));


        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }

        if(Auth::user()->hasRole('Secretaria'))
        {
            return redirect('/pacientes')->with('mensaje', 'Paciente creado satisfactoriamente');
        }
        elseif(Auth::user()->hasRole('Administrador'))
        {
            return redirect('/usuarios')->with('mensaje', 'Usuario creado satisfactoriamente');
        }

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
        if(!Auth::user()->can('EditarUsuario'))
            abort(403,'Acceso Prohibido');

        $roles = Role::all();
        $especialidades = Especialidad::all();
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'especialidades'=>$especialidades]);
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
                'role' => $request->input('role'),
                'especialidad_id' => ($request->input('especialidad')!='')?$request->input('especialidad'):NULL,
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
        if(Auth::user()->hasRole('Secretaria'))
        {
            return redirect('/pacientes')->with('mensaje', 'Paciente editado satisfactoriamente');
        }
        elseif(Auth::user()->hasRole('Administrador'))
        {
            return redirect('/usuarios')->with('mensaje', 'Usuario editado satisfactoriamente');
        }
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

    public function permisos($id)
    {
        if (!Auth::user()->can('AsignarPermiso'))
            abort(403, 'Permiso Denegado.');

        $user = User::findOrFail($id);
        $permisos = Permission::all();
        return view('users.permisos', ['user' => $user, 'permisos' => $permisos]);
    }

    public function asignarPermisos(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->revokePermissionTo(Permission::all());
        if ($request->input('permisos'))
            $user->givePermissionTo($request->input('permisos'));
        return redirect('/usuarios')->with('mensaje', 'Permisos Asignados Satisfactoriamente');
    }

    public function pacientes()
    {
        $pacientes = null;
        $buscar = \Request::get('buscar');
        if($buscar!='')
            $pacientes = User::role('Paciente')
                ->nombre($buscar)
                ->apellido($buscar)
                ->cedula($buscar)
                ->paginate();
        else
            $pacientes = User::role('Paciente')->paginate();

        return view('pacientes.index', ['users' => $pacientes, 'buscar'=>$buscar]);
    }

    public function medicos()
    {
        $medicos = null;
        $buscar = \Request::get('buscar');
        if($buscar!='')
            $medicos = User::role('Medico')
                ->nombre($buscar)
                ->apellido($buscar)
                ->cedula($buscar)
                ->paginate();
        else
            $medicos = User::role('Medico')->paginate();

        return view('medicos.index', ['users' => $medicos, 'buscar'=>$buscar]);
    }
    public function solicitarcita($id)
    {
        if(!Auth::user()->can('SolicitarCita'))
            abort(403);

        $paciente = User::findOrFail($id);
        $medicos = User::role('Medico')->get();
        $especialidades = Especialidad::all();
        return view('citas.create', ['paciente'=> $paciente, 'medicos' => $medicos, 'especialidades' =>$especialidades]);
    }
    public function editarcita($id)
    {
        $citas = Cita::all();
        $paciente = User::findOrFail($id);
        $medicos = User::role('Medico')->get();
        $especialidades = Especialidad::all();
        return view('citas.edit', ['citas'=>$citas, 'paciente'=> $paciente, 'medicos' => $medicos, 'especialidades' =>$especialidades]);
    }
}