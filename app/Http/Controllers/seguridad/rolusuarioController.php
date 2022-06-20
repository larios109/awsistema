<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class rolusuarioController extends Controller
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
        $response = Http::get('http://localhost:3000/rol_usuario');
        return view('M_seguridad.rolusuario.index')->with('rolusuario', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('M_seguridad.rolusuario.create');
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
            'Rol'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/rol_usuario/insertar', [
            'tipo_rol' => $request->Rol
        ]);

        $response2 = Http::get('http://localhost:3000/rol_usuario');
        return view('M_seguridad.rolusuario.index')->with('rolusuario', json_decode($response2,true));
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
    public function edit($cod_rol)
    {
        $response=Http::get('http://localhost:3000/rol_usuario/'.$cod_rol);
        $actualizarrol=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarrol']=$actualizarrol;

        return view('M_seguridad.rolusuario.edit',['actualizarrol'=>$actualizarrol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_rol)
    {
        $request->validate([
            'Rol'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/rol_usuario/actualizar/' . $cod_rol, [
            'tipo_rol' => $request->Rol
        ]);

        $response2 = Http::get('http://localhost:3000/rol_usuario');
        return view('M_seguridad.rolusuario.index')->with('rolusuario', json_decode($response2,true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_rol)
    {
        $eliminar = Http::delete('http://localhost:3000/rol_usuario/eliminar/'.$cod_rol);
        $response2 = Http::get('http://localhost:3000/rol_usuario');
        return view('M_seguridad.rolusuario.index')->with('rolusuario', json_decode($response2,true));
    }
}
