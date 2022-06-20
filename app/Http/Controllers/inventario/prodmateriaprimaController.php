<?php

namespace App\Http\Controllers\inventario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\productomateriaprima;

class prodmateriaprimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->productomateriaprima|crear->productomateriaprima|editar->productomateriaprima|borrar->productomateriaprima',['only'=>['index']]);
        $this->middleware('permission:crear->productomateriaprima',['only'=>['create','store']]);
        $this->middleware('permission:editar->productomateriaprima',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->productomateriaprima',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/productos_materia_prima');
        return view('Minventario.productomateriaprima.index')->with('productomateriaprima', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/productos');
        $response2 = Http::get('http://localhost:3000/materia_prima');
        return view('Minventario.productomateriaprima.create')
        ->with('productos', json_decode($response,true))
        ->with('materiaprima', json_decode($response2,true));
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
            'Materia'=>'required',
            'Cantidad'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/productos_materia_prima/insertar', [
            'nombre_producto' => $request->Producto,
            'nom_materia' => $request->Materia,
            'can_materia_requerida' => $request->Cantidad
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Productos Materia Prima',
        ]);

        return redirect()->route('productomateriaprima.index');  
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
    public function edit($cod_prod_mat_prima)
    {
        $response3 = Http::get('http://localhost:3000/productos');
        $response2 = Http::get('http://localhost:3000/materia_prima');

        $response=Http::get('http://localhost:3000/productos_materia_prima/'.$cod_prod_mat_prima);
        $prodmateriaprima=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['prodmateriaprima']=$prodmateriaprima;

        return view('Minventario.productomateriaprima.edit',['prodmateriaprima'=>$prodmateriaprima])
        ->with('productos', json_decode($response3,true))
        ->with('materiaprima', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_prod_mat_prima)
    {
        $request->validate([
            'Producto'=>'required',
            'Materia'=>'required',
            'Cantidad'=>'required'
        ]);

        $detalleventa = Http::put('http://localhost:3000/productos_materia_prima/actualizar/' . $cod_prod_mat_prima, [
            'nombre_producto' => $request->Producto,
            'nom_materia' => $request->Materia,
            'can_materia_requerida' => $request->Cantidad
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Productos Materia Prima',
        ]);

        return redirect()->route('productomateriaprima.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_prod_mat_prima)
    {
        $eliminar = Http::delete('http://localhost:3000/productos_materia_prima/eliminar/'.$cod_prod_mat_prima);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Productos Materia Prima',
        ]);
        return redirect()->route('productomateriaprima.index'); 
    }
}
