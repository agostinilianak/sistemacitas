<?php

namespace App\Http\Controllers;

use App\HistoriaMedica;
use App\Medicina;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecipesController extends Controller
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
        if(!Auth::user()->can('VerRecipe'))
            abort(403);

        $recipes = Recipe::where('status', '=', 'activo')->paginate();
        return view('recipes.index', ['recipes'=>$recipes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        if (!Auth::user()->can('CrearRecipe'))
            abort(403, 'Acceso Prohibido');

        $medicinas = Medicina::all();
        $hmedica = HistoriaMedica::findOrFail($id);
        return view('recipes.create', ['medicinas'=>$medicinas, 'hmedica'=>$hmedica]);
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
            'historiamedica_id' => 'required',
            'observaciones' => 'required',
            'status' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();
            $hmedica=HistoriaMedica::findOrFail($id);
            $recipe= Recipe::create([
                'historiamedica_id'=>$hmedica->id,
                'status'=> ($request->input('status') != '') ? $request->input('status') : 'activo',
                'observaciones'=> $request->input('observaciones'),
            ]);

            $recipe->medicina()->sync($request->input('medicina_id'));

        } catch (\Exception $e) {
            \DB::rollback();

        } finally {
            \DB::commit();
        }
        return redirect('/medicos/vermiscitas')->with('mensaje', 'Recipe creado Exitosamente');
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
        if (!Auth::user()->can('ModificarRecipe'))
            abort(403, 'Acceso Prohibido');

        $medicinas = Medicina::findOrFail($id);
        $hmedica = HistoriaMedica::findOrFail($id);
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', ['medicinas'=>$medicinas, 'hmedica'=>$hmedica, 'recipe'=>$recipe]);
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
            'historiamedica_id' => 'required',
            'observaciones' => 'required',
            'status' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();
            $hmedica=HistoriaMedica::findOrFail($id);
            $recipe= Recipe::create([
                'historiamedica_id'=>$hmedica->id,
                'status'=> ($request->input('status') != '') ? $request->input('status') : 'activo',
                'observaciones'=> $request->input('observaciones'),
            ]);

            $recipe->medicina()->sync($request->input('medicina_id'));

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

        User::destroy($id);
        return redirect('/recipe')->with('mensaje', 'Recipe eliminado satisfactoriamente');

    }
}
