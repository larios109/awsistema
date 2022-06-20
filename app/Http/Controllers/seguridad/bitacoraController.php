<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\bitacora;

class bitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->bitacora|crear->bitacora|editar->bitacora|borrar->bitacora',['only'=>['index']]);
        $this->middleware('permission:crear->bitacora',['only'=>['create','store']]);
        $this->middleware('permission:editar->bitacora',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->bitacora',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/registro_operacion');
        return view('M_seguridad.bitacora.index')->with('registrooperacion', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        $response2 = Http::get('http://localhost:3000/tipo_operacion');
        return view('M_seguridad.bitacora.create')
        ->with('users', json_decode($response,true))
        ->with('tipoperacion', json_decode($response2,true));
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
            'Empleado'=>'required',
            'calendario'=>'required',
            'Operacion'=>'required',
            'Referencia'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/registro_operacion/insertar', [
            'name' => $request->Empleado,
            'fecha_operacion' => $request->calendario,
            'cod_tipo_operacion' => $request->Operacion,
            'referencia_operacion' => $request->Referencia
        ]);

        return redirect()->route('bitacora.index');
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
    public function edit($cod_operacion)
    {
        $response2 = Http::get('http://localhost:3000/users');
        $response3 = Http::get('http://localhost:3000/tipo_operacion');

        $response=Http::get('http://localhost:3000/registro_operacion/'.$cod_operacion);
        $actualizarbitacora=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarbitacora']=$actualizarbitacora;


        return view('M_seguridad.bitacora.edit',['actualizarbitacora'=>$actualizarbitacora])
        ->with('users', json_decode($response2,true))
        ->with('tipoperacion', json_decode($response3,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_operacion)
    {
        $request->validate([
            'Empleado'=>'required',
            'calendario'=>'required',
            'Operacion'=>'required',
            'Referencia'=>'required'
        ]);

        $detalleventa = Http::put('http://localhost:3000/registro_operacion/actualizar/' . $cod_operacion, [
            'name' => $request->Empleado,
            'fecha_operacion' => $request->calendario,
            'cod_tipo_operacion' => $request->Operacion,
            'referencia_operacion' => $request->Referencia
        ]);

        return redirect()->route('bitacora.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_operacion)
    {
        $eliminar = Http::delete('http://localhost:3000/registro_operacion/eliminar/'.$cod_operacion);
        return redirect()->route('bitacora.index');
    }
}
