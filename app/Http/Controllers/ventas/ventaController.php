<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\venta;

class ventaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->venta|crear->venta|editar->venta|borrar->venta',['only'=>['index']]);
        $this->middleware('permission:crear->venta',['only'=>['create','store']]);
        $this->middleware('permission:editar->venta',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->venta',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/ventas');
        return view('M_ventas.ventas.index')->with('ventas', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        $response2 = Http::get('http://localhost:3000/cliente');
        return view('M_ventas.ventas.create')->with('users', json_decode($response,true))
        ->with('clientes', json_decode($response2,true));;
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
            'codusuario'=>'required',
            'codcliente'=>'required',
            'calendario'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/ventas/insertar', [
            'name' => $request->codusuario,
            'cliente_nombre' => $request->codcliente,
            'fecha_creacion' => $request->calendario
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Ventas',
        ]);
        
        return redirect()->route('ventas.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_venta)
    {
        $response2 = Http::get('http://localhost:3000/users');
        $response3 = Http::get('http://localhost:3000/cliente');

        $response=Http::get('http://localhost:3000/ventas/'.$cod_venta);
        $actualizarventas=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarventas']=$actualizarventas;

        return view ('M_ventas.ventas.edit',['actualizarventas'=>$actualizarventas])
        ->with('users', json_decode($response2,true))
        ->with('clientes', json_decode($response3,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_venta)
    {
        $request->validate([
            'codusuario'=>'required',
            'codcliente'=>'required',
            'calendario'=>'required'
        ]);

        $detalleventa = Http::put('http://localhost:3000/ventas/actualizar/' . $cod_venta, [
            'name' => $request->codusuario,
            'cliente_nombre' => $request->codcliente,
            'fecha_creacion' => $request->calendario
        ]);

        $user=auth()->user()->name;
        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Ventas',
        ]);

        return redirect()->route('ventas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_venta)
    {
        $eliminar = Http::delete('http://localhost:3000/ventas/eliminar/'.$cod_venta);
        $user=auth()->user()->name;
        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Ventas',
        ]);
        return redirect()->route('ventas.index');
    }
}
