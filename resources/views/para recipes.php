<div class="row">
    <form action="{{ url('/medicinasarray') ]]" method="post">
        {!! csrf_field !!}
        {!! method_field('POST') !!}
        <select name="medicina_id[]" id="medicina_id">
            <option value="">Seleccione:</option>
            @foreach($medicinas as $medicina)
            <option value="{{ $medicina_id }}"> {{ $medicina->nombre }}</option>
            @endforeach
        </select>
        <select name="medicina_id[]" id="medicina_id">
            <option value="">Seleccione:</option>
            @foreach($medicinas as $medicina)
            <option value="{{ $medicina_id }}"> {{ $medicina->nombre }}</option>
            @endforeach
        </select>
        <select name="medicina_id[]" id="medicina_id">
            <option value="">Seleccione:</option>
            @foreach($medicinas as $medicina)
            <option value="{{ $medicina_id }}"> {{ $medicina->nombre }}</option>
            @endforeach
        </select>
        <input type="submit" value="Guardar">
    </form>
</div>

definir rutas!! y despues esto:

public function medicinasarray(Request $request){

    for($i=0);$i<$request->input('medicina_id')->count();$id++{
    if($request->input(medicina_id)[$i]='')
    $recipe->medicina()->attach($request->input('medicina_id')//[$i]) sin esto//;
}
