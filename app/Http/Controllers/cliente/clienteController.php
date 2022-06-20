<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\cliente;

class clienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->cliente|crear->cliente|editar->cliente|borrar->cliente',['only'=>['index']]);
        $this->middleware('permission:crear->cliente',['only'=>['create','store']]);
        $this->middleware('permission:editar->cliente',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->cliente',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/cliente');
        return view('M_cliente.cliente.index')->with('clientes', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('M_cliente.cliente.create');
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
            'Apellido'=>'required',
            'DNI'=>'required',
            'Compania'=>'required',
            'RTN'=>'required',
            'calendario'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/cliente/insertar', [
            'cliente_nombre' => $request->Nombre,
            'cliente_apellido' => $request->Apellido,
            'cliente_dni' => $request->DNI,
            'compañia_nombre' => $request->Compania,
            'compania_rtn' => $request->RTN,
            'cliente_fecha' => $request->calendario
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Cliente',
        ]);

        return redirect()->route('cliente.index');
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
    public function edit($cod_cliente)
    {
        $response=Http::get('http://localhost:3000/cliente/'.$cod_cliente);
        $clienteactu=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['clienteactu']=$clienteactu;

        return view('M_cliente.cliente.edit',['clienteactu'=>$clienteactu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_cliente)
    {
        $request->validate([
            'Nombre'=>'required',
            'Apellido'=>'required',
            'DNI'=>'required',
            'Compania'=>'required',
            'RTN'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/cliente/actualizar/' . $cod_cliente, [
            'cliente_nombre' => $request->Nombre,
            'cliente_apellido' => $request->Apellido,
            'cliente_dni' => $request->DNI,
            'compañia_nombre' => $request->Compania,
            'compania_rtn' => $request->RTN,
            'cliente_fecha' => $request->calendario
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Cliente',
        ]);

        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_cliente)
    {
        $eliminar = Http::delete('http://localhost:3000/cliente/eliminar/'.$cod_cliente);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar', 
            'Tabla' =>'Cliente',
        ]);
        return redirect()->route('cliente.index');
    }
}
