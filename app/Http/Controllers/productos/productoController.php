<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\producto;

class productoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->productos|crear->productos|editar->productos|borrar->productos',['only'=>['index']]);
        $this->middleware('permission:crear->productos',['only'=>['create','store']]);
        $this->middleware('permission:editar->productos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->productos',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/productos');
        return view('M_productos.productos.index')->with('productos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('M_productos.productos.create');
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
            'Precio'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/productos/insertar', [
            'nombre_producto' => $request->Nombre,
            'descrip_producto' => $request->Descripcion,
            'precio_producto' => $request->Precio
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Productos',
        ]);
        
        return redirect()->route('productos.index');
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
    public function edit($cod_producto)
    {
        $response=Http::get('http://localhost:3000/productos/'.$cod_producto);
        $producto=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['producto']=$producto;

        return view ('M_productos.productos.edit',['producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_producto)
    {
        $request->validate([
            'Nombre'=>'required',
            'Descripcion'=>'required',
            'Precio'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/productos/actualizar/' . $cod_producto, [
            'nombre_producto' => $request->Nombre,
            'descrip_producto' => $request->Descripcion,
            'precio_producto' => $request->Precio
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Productos',
        ]);

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_producto)
    {
        $eliminar = Http::delete('http://localhost:3000/productos/eliminar/'.$cod_producto);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Productos',
        ]);
        return redirect()->route('productos.index');
    }
}
