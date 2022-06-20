<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;

class seederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos=[
            //tabla roles
            'ver->rol',
            'crear->rol',
            'editar->rol',
            'borrar->rol',

            //tabla bitacora
            'ver->bitacora',
            'crear->bitacora',
            'editar->bitacora',
            'borrar->bitacora',

            //tabla tipo operacion
            'ver->tipoperacion',
            'crear->tipoperacion',
            'editar->tipoperacion',
            'borrar->tipoperacion',

            //tabla ventas
            'ver->venta',
            'crear->venta',
            'editar->venta',
            'borrar->venta',

            //tabla detalle ventas
            'ver->detalleventa',
            'crear->detalleventa',
            'editar->detalleventa',
            'borrar->detalleventa',

            //tabla materia prima
            'ver->materiaprima',
            'crear->materiaprima',
            'editar->materiaprima',
            'borrar->materiaprima',

            //tabla materia prima
            'ver->inventariomateriaprima',
            'crear->inventariomateriaprima',
            'editar->inventariomateriaprima',
            'borrar->inventariomateriaprima',

            //tabla materia prima
            'ver->productomateriaprima',
            'crear->productomateriaprima',
            'editar->productomateriaprima',
            'borrar->productomateriaprima',

            //tabla productos
            'ver->productos',
            'crear->productos',
            'editar->productos',
            'borrar->productos',

            //tabla productos en inventario
            'ver->productosinventario',
            'crear->productosinventario',
            'editar->productosinventario',
            'borrar->productosinventario',

            //tabla clientes
            'ver->cliente',
            'crear->cliente',
            'editar->cliente',
            'borrar->cliente',

            //tabla direccion cliente
            'ver->direccioncliente',
            'crear->direccioncliente',
            'editar->direccioncliente',
            'borrar->direccioncliente',

            //tabla correos
            'ver->correo',
            'crear->correo',
            'editar->correo',
            'borrar->correo',
            
            //tabla telefonos
            'ver->telefonos',
            'crear->telefonos',
            'editar->telefonos',
            'borrar->telefonos',

            //tabla compania
            'ver->compania',
            'crear->compania',
            'editar->compania',
            'borrar->compania',

            //tabla oficina
            'ver->oficina',
            'crear->oficina',
            'editar->oficina',
            'borrar->oficina',

            //tabla usuarios
            'ver->usuarios',
            'crear->usuarios',
            'editar->usuarios',
            'borrar->usuarios',

            //tabla pago salario
            'ver->pagosalario',
            'crear->pagosalario',
            'editar->pagosalario',
            'borrar->pagosalario'
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
