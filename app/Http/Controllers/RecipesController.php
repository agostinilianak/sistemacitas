<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\HistoriaMedica;
use App\Medicina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;



class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes=Recipe::paginate(10);
        return view('recipes.index', ['recipes' =>$recipes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create($id=null)
    {
        if (!Auth::user()->can('CrearRecipe'))
            abort(403, 'Acceso Prohibido');

        $hmedica = HistoriaMedica::findOrFail($id);
        $medicinas = Medicina::all();
        return view('recipes.create', ['hmedica'=>$hmedica, 'medicinas'=>$medicinas]);
    }

    public function store(Request $request)
    {
        $v=Validator::make($request->all(),[
            'historiamedica_id' => 'required',
            'observaciones' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        try {
            \DB::beginTransaction();

            $recipe= Recipe::create([
                'historiamedica_id'=>$request->input('historiamedica_id'),
                'observaciones'=> $request->input('observaciones'),
                'status'=> ($request->input('status') != '') ? $request->input('status') : 'activo',
            ]);

            $recipe->medicina()->sync($request->input('medicina'));
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/medicos/vermiscitas')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un error inesperado');
        } finally {
            \DB::commit();
        }
        return redirect('/medicos/vermiscitas')->with('mensaje', 'Recipe creado Exitosamente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
//        if (!Auth::user()->can('EditarRecipe'))
  //          abort(403, 'Acceso Prohibido');

        $medicinas = Medicina::findOrFail($id);
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', ['medicinas'=>$medicinas, 'recipe'=>$recipe]);
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
        $v=Validator::make($request->all(),[
            'observaciones' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        try {
            \DB::beginTransaction();
            $recipe= Recipe::findOrFail($id);
            $recipe->update([
                'status'=> ($request->input('status') != '') ? $request->input('status') : 'activo',
                'observaciones'=> $request->input('observaciones'),
            ]);

            $recipe->medicina()->sync($request->input('medicina'));

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/recipes')->with('mensaje', 'No se pudo procesar su solicitud.');
        } finally {
            \DB::commit();
        }
        return redirect('/recipes')->with('mensaje', 'Recipe editado Exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('EliminarRecipe'))
            abort(403, 'Permiso Denegado.');

        try{
            \DB::beginTransaction();
            Recipe::destroy($id);
        }catch (\Exception $e){
            \DB::rollback();
            return redirect('/recipe')->with('mensaje', 'No se pudo procesar su solicitud');
        }finally{
            \DB::commit();
            return redirect('/recipe')->with('mensaje', 'Recipe eliminado satisfactoriamente');
        }
    }
    public function verrecipes($id)
    {
        $medicinas = Medicina::all();
        $recipe = Recipe::findOrFail($id);
        return view('recipes.verrecipes', ['recipe' => $recipe, 'medicinas'=>$medicinas]);
    }
    public function cambiarstatusrecipe($id)
    {
        if (!Auth::user()->can('CambiarStatusRecipe'))
            abort(403);
        $medicinas = Medicina::all();
        $recipe = Recipe::findOrFail($id);
        return view('recipes.cambiarstatusrecipe', ['recipe' => $recipe, 'medicinas'=>$medicinas]);
    }


}
