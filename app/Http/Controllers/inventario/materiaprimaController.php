<?php

namespace App\Http\Controllers\inventario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\materiaprima;

class materiaprimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->materiaprima|crear->materiaprima|editar->materiaprima|borrar->materiaprima',['only'=>['index']]);
        $this->middleware('permission:crear->materiaprima',['only'=>['create','store']]);
        $this->middleware('permission:editar->materiaprima',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->materiaprima',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/materia_prima');
        return view('Minventario.materiaprima.index')->with('materiaprima', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Minventario.materiaprima.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre'=>'required',
            'Descripcion'=>'required',
            'Precio'=>'required',
            'Medida'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/materia_prima/insertar', [
            'nom_materia' => $request->Nombre,
            'descripcion' => $request->Descripcion,
            'pre_Compra_materia' => $request->Precio,
            'tip_medida' => $request->Medida
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Materia Prima',
        ]);

        return redirect()->route('materiaprima.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cod_detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_materia)
    {
        $response=Http::get('http://localhost:3000/materia_prima/'.$cod_materia);
        $materiaprima=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['materiaprima']=$materiaprima;

        return view ('Minventario.materiaprima.edit',['materiaprima'=>$materiaprima]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_materia)
    {
        $request->validate([
            'Nombre'=>'required',
            'Descripcion'=>'required',
            'Precio'=>'required',
            'Medida'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/materia_prima/actualizar/' . $cod_materia, [
            'nom_materia' => $request->Nombre,
            'descripcion' => $request->Descripcion,
            'pre_Compra_materia' => $request->Precio,
            'tip_medida' => $request->Medida
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Materia Prima',
        ]);

        return redirect()->route('materiaprima.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_materia)
    {
        $eliminar = Http::delete('http://localhost:3000/materia_prima/eliminar/'.$cod_materia);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Materia Prima',
        ]);
        return redirect()->route('materiaprima.index');
    }
}
