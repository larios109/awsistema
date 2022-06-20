<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\oficina;

class oficinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->oficina|crear->oficina|editar->oficina|borrar->oficina',['only'=>['index']]);
        $this->middleware('permission:crear->oficina',['only'=>['create','store']]);
        $this->middleware('permission:editar->oficina',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->oficina',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/compania_oficina');
        return view('M_cliente.oficina.index')->with('oficinas', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/compania');
        $response2 = Http::get('http://localhost:3000/municipio');
        $response3 = Http::get('http://localhost:3000/departamento');

        return view('M_cliente.oficina.create')
        ->with('companias', json_decode($response,true))
        ->with('municipio', json_decode($response2,true))
        ->with('departamento', json_decode($response3,true));
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
            'RTN'=>'required',
            'Nombre'=>'required',
            'Direccion'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
            'Telefono1'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/compania_oficina/insertar', [
            'compania_rtn' => $request->RTN,
            'oficina_nombre' => $request->Nombre,
            'oficina_direccion' => $request->Direccion,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
            'oficina_telefono_1' => $request->Telefono1,
            'oficina_telefono_2' => $request->Telefono2
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Oficina',
        ]);

        return redirect()->route('oficina.index');
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
    public function edit($cod_oficina)
    {
        $response1 = Http::get('http://localhost:3000/compania');
        $response2 = Http::get('http://localhost:3000/municipio');
        $response3 = Http::get('http://localhost:3000/departamento');

        $response=Http::get('http://localhost:3000/compania_oficina/'.$cod_oficina);
        $oficinactu=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['oficinactu']=$oficinactu;

        return view('M_cliente.oficina.edit',['oficinactu'=>$oficinactu])
        ->with('companias', json_decode($response1,true))
        ->with('municipio', json_decode($response2,true))
        ->with('departamento', json_decode($response3,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_oficina)
    {
        $request->validate([
            'RTN'=>'required',
            'Nombre'=>'required',
            'Direccion'=>'required',
            'Municipio'=>'required',
            'Departamento'=>'required',
            'Telefono1'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/compania_oficina/actualizar/' . $cod_oficina, [
            'compania_rtn' => $request->RTN,
            'oficina_nombre' => $request->Nombre,
            'oficina_direccion' => $request->Direccion,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
            'oficina_telefono_1' => $request->Telefono1,
            'oficina_telefono_2' => $request->Telefono2
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Oficina',
        ]);

        return redirect()->route('oficina.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_oficina)
    {
        $eliminar = Http::delete('http://localhost:3000/compania_oficina/eliminar/'.$cod_oficina);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Oficina',
        ]);
        return redirect()->route('oficina.index');
    }
}
