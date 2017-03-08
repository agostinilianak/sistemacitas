<?php

namespace App\Http\Controllers;

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
        $users = User::paginate();
        return view('users.index', ['users' =>$users]);
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

        $roles = Role::all();
        $especialidades = Especialidad::all();
        return view('users.create', ['roles' => $roles, 'especialidades'=>$especialidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input());
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
            'role' => 'required',
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

            $user->assignRole($request->input('role'));


        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
            return redirect('/home')->with('mensaje', 'Proceso satisfactorio');
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
        //if(!Auth::user()->can('EditarUsuario'))
        //    abort(403,'Acceso Prohibido');

        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
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
        $pacientes = User::role('Paciente')->paginate();
        return view('pacientes.index', ['users' => $pacientes]);
    }

    public function medicos()
    {
        $medicos = User::role('Medico')->paginate();
        return view('medicos.index', ['users' => $medicos]);
    }


    public function farmaceutas()
    {
        $farmaceutas= User::role('Farmaceuta')->paginate();
        return view('users.index', ['users' => $farmaceutas]);
    }

    public function secretarias()
    {
        $secretarias= User::role('Secretaria')->paginate();
        return view('users.index', ['users' => $secretarias]);
    }

    public function administradores()
    {
        $administradores= User::role('Administrador')->paginate();
        return view('users.index', ['users' => $administradores]);
    }


}

