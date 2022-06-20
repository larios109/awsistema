<?php

namespace App\Http\Controllers\inventario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\inventariomateriaprima;

class inventmateriaprimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->inventariomateriaprima|crear->inventariomateriaprima|editar->inventariomateriaprima|borrar->inventariomateriaprima',['only'=>['index']]);
        $this->middleware('permission:crear->inventariomateriaprima',['only'=>['create','store']]);
        $this->middleware('permission:editar->inventariomateriaprima',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->inventariomateriaprima',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/inventario_materia_prima');
        return view('Minventario.inventariomateriaprima.index')->with('inventariomateriaprima', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/materia_prima');
        return view('Minventario.inventariomateriaprima.create')->with('materiaprima', json_decode($response,true));
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
            'Materia'=>'required',
            'calendario'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'calendario2'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/inventario_materia_prima/insertar', [
            'nom_materia' => $request->Materia,
            'fec_compra' => $request->calendario,
            'can_Compra' => $request->cantidad,
            'pre_compra' => $request->precio,
            'fec_caducidad' => $request->calendario2
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Insertar',
            'Tabla' =>'Inventario Materia Prima',
        ]);

        return redirect()->route('inventariomateriaprima.index');
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
    public function edit($cod_invent_materia_prima)
    {
        $response2 = Http::get('http://localhost:3000/materia_prima');

        $response=Http::get('http://localhost:3000/inventario_materia_prima/'.$cod_invent_materia_prima);
        $inventmateriap=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['inventmateriap']=$inventmateriap;

        return view('Minventario.inventariomateriaprima.edit',['inventmateriap'=>$inventmateriap])->with('materiaprima', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_invent_materia_prima)
    {
        $request->validate([
            'Materia'=>'required',
            'calendario'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'calendario2'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/inventario_materia_prima/actualizar/' . $cod_invent_materia_prima, [
            'nom_materia' => $request->Materia,
            'fec_compra' => $request->calendario,
            'can_Compra' => $request->cantidad,
            'pre_compra' => $request->precio,
            'fec_caducidad' => $request->calendario2
        ]);

        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Actualizar',
            'Tabla' =>'Inventario Materia Prima',
        ]);

        return redirect()->route('inventariomateriaprima.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_invent_materia_prima)
    {
        $eliminar = Http::delete('http://localhost:3000/inventario_materia_prima/eliminar/'.$cod_invent_materia_prima);
        $user=auth()->user()->name;

        $response2 = Http::post('http://localhost:3000/registroperacion/insertar', [
            'nom_user' => $user,
            'evento' => 'Eliminar',
            'Tabla' =>'Inventario Materia Prima',
        ]);
        return redirect()->route('inventariomateriaprima.index');
    }
}
