<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\productoinventarios;

class productoinventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->productosinventario|crear->productosinventario|editar->productosinventario|borrar->productosinventario',['only'=>['index']]);
        $this->middleware('permission:crear->productosinventario',['only'=>['create','store']]);
        $this->middleware('permission:editar->productosinventario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->productosinventario',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/productos_inventarios');
        return view('M_productos.productosinventario.index')->with('productosinventario', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/productos');
        return view('M_productos.productosinventario.create')->with('productos', json_decode($response,true));
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
            'Producto'=>'required',
            'calendario1'=>'required',
            'calendario2'=>'required',
            'cantidad'=>'required',
            'precio'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/productos_inventarios/insertar', [
            'nombre_producto' => $request->Producto,
            'fech_creacion_lote' => $request->calendario1,
            'fech_caducidad_lote' => $request->calendario2,
            'cant_lote' => $request->cantidad,
            'prec_vent_lote' => $request->precio
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Productos en inventario',
        ]);

        return redirect()->route('productosinventario.index');
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
    public function edit($cod_lote)
    {
        $response2 = Http::get('http://localhost:3000/productos');

        $response=Http::get('http://localhost:3000/productos_inventarios/'.$cod_lote);
        $productoinvent=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['productoinvent']=$productoinvent;

        return view ('M_productos.productosinventario.edit',['productoinvent'=>$productoinvent])
        ->with('productos', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_lote)
    {
        $request->validate([
            'Producto'=>'required',
            'calendario1'=>'required',
            'calendario2'=>'required',
            'cantidad'=>'required',
            'precio'=>'required'
        ]);

        $actualizarproductint = Http::put('http://localhost:3000/productos_inventarios/actualizar/' . $cod_lote, [
            'nombre_producto' => $request->Producto,
            'fech_creacion_lote' => $request->calendario1,
            'fech_caducidad_lote' => $request->calendario2,
            'cant_lote' => $request->cantidad,
            'prec_vent_lote' => $request->precio
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Productos en inventario',
        ]);

        return redirect()->route('productosinventario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_lote)
    {
        $eliminar = Http::delete('http://localhost:3000/productos_inventarios/eliminar/'.$cod_lote);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Productos en inventario',
        ]);
        return redirect()->route('productosinventario.index');
    }
}
