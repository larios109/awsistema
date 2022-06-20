<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\direccioncliente;


class direccionclienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->direccioncliente|crear->direccioncliente|editar->direccioncliente|borrar->direccioncliente',['only'=>['index']]);
        $this->middleware('permission:crear->direccioncliente',['only'=>['create','store']]);
        $this->middleware('permission:editar->direccioncliente',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->direccioncliente',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/direccion_cliente');
        return view('M_cliente.direccioncliente.index')->with('direccioncliente', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/cliente');
        $response2 = Http::get('http://localhost:3000/departamento');
        $response3 = Http::get('http://localhost:3000/municipio');
        return view('M_cliente.direccioncliente.create')
        ->with('clientes', json_decode($response,true))
        ->with('departamento', json_decode($response2,true))
        ->with('municipio', json_decode($response3,true));;
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
            'Cliente'=>'required',
            'direccion'=>'required',
            'Ciudad'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/direccion_cliente/insertar', [
            'cliente_nombre' => $request->Cliente,
            'direccion' => $request->direccion,
            'ciudad' => $request->Ciudad,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Direccion',
        ]);

        return redirect()->route('direccioncliente.index');
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
    public function edit($cod_direccion)
    {
        $response4 = Http::get('http://localhost:3000/cliente');
        $response3 = Http::get('http://localhost:3000/departamento');
        $response2 = Http::get('http://localhost:3000/municipio');

        $response=Http::get('http://localhost:3000/direccion_cliente/'.$cod_direccion);
        $direccionclient=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['direccionclient']=$direccionclient;

        return view('M_cliente.direccioncliente.edit',['direccionclient'=>$direccionclient])
        ->with('clientes', json_decode($response4,true))
        ->with('departamento', json_decode($response3,true))
        ->with('municipio', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_direccion)
    {
        $request->validate([
            'Cliente'=>'required',
            'direccion'=>'required',
            'Ciudad'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/direccion_cliente/actualizar/' . $cod_direccion, [
            'cliente_nombre' => $request->Cliente,
            'direccion' => $request->direccion,
            'ciudad' => $request->Ciudad,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Direccion',
        ]);

        return redirect()->route('direccioncliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_direccion)
    {
        $eliminar = Http::delete('http://localhost:3000/direccion_cliente/eliminar/'.$cod_direccion);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Direccion',
        ]);

        return redirect()->route('direccioncliente.index');
    }
}
