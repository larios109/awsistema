<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\correo;

class correosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->correo|crear->correo|editar->correo|borrar->correo',['only'=>['index']]);
        $this->middleware('permission:crear->correo',['only'=>['create','store']]);
        $this->middleware('permission:editar->correo',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->correo',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/correo');
        return view('M_cliente.correos.index')->with('correos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        return view('M_cliente.correos.create')->with('users', json_decode($response,true));
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
            'Correo'=>'required',
            'codusuario'=>'required',
            'calendario'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/correo/insertar', [
            'correo' => $request->Correo,
            'name' => $request->codusuario,
            'fec_registro' => $request->calendario
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Correo',
        ]);


        return redirect()->route('correos.index');
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
    public function edit($cod_correo)
    {
        $response2 = Http::get('http://localhost:3000/users');

        $response=Http::get('http://localhost:3000/correo/'.$cod_correo);
        $actualizarcorreo=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarcorreo']=$actualizarcorreo;

        return view ('M_cliente.correos.edit',['actualizarcorreo'=>$actualizarcorreo])
        ->with('users', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_correo)
    {
        $request->validate([
            'Correo'=>'required',
            'codusuario'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/correo/actualizar/'. $cod_correo, [
            'correo' => $request->Correo,
            'name' => $request->codusuario,
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Correo',
        ]);

        return redirect()->route('correos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_correo)
    {
        $eliminar = Http::delete('http://localhost:3000/correo/eliminar/'.$cod_correo);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Correo',
        ]);
        return redirect()->route('correos.index');
    }
}
