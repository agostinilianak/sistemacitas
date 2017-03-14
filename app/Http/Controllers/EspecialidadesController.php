<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Especialidad;
use Validator;
use Auth;

class EspecialidadesController extends Controller

    {
        use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidad::paginate();
        return view('especialidades.index', ['especialidades'=>$especialidades]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('CrearEspecialidad'))
            abort(403);
        return view('especialidades.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
        ]);
        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }
        try{
            \DB::beginTransaction();
            Especialidad::create([
                'nombre'=>$request->input('nombre'),
            ]);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/especialidades')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/especialidades')->with('mensaje', 'Especialidad creada con éxito');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidad= Especialidad::findOrFail($id);
        return view('especialidades.show', ['especialidad'=>$especialidad]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('EditarEspecialidad'))
            abort(403);
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.edit', ['especialidad'=>$especialidad]);
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
            'nombre' => 'required|max:50',
        ]);
        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }
        try{
            \DB::beginTransaction();
            $especialidad = Especialidad::findOrFail($id);
            $especialidad->update([
                'nombre'=>$request->input('nombre'),
            ]);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/especialidades')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/especialidades')->with('mensaje', 'Especialidad editada con exito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('EliminarEspecialidad'))
            abort(403);
        try{
            \DB::beginTransaction();
            Especialidad::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/especialidades')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/especialidades')->with('mensaje', 'Especialidad eliminada exitosamente');
    }
}