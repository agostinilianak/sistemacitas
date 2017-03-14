<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Medicina;
use Validator;
use Auth;
class MedicinasController extends Controller
{
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
        $medicinas = Medicina::paginate();
        return view('medicinas.index', ['medicinas'=>$medicinas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('CrearMedicina'))
            abort(403);
        return view('medicinas.create');
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
            Medicina::create([
                'nombre'=>$request->input('nombre'),
            ]);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/medicinas')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/medicinas')->with('mensaje', 'Medicina creada con éxito');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicina = Medicina::findOrFail($id);
        return view('medicinas.show', ['medicina'=>$medicina]);
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
        if(!Auth::user()->hasPermissionTo('EliminarMedicina'))
            abort(403);
        try{
            \DB::beginTransaction();
            Medicina::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/medicinas')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/medicinas')->with('mensaje', 'Medicina eliminada exitosamente');
    }
}