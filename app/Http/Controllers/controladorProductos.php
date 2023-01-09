<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use App\Models\compras;
use App\Models\relacion_factura_compra;
use App\Models\depositos;
use App\Models\facturas;
use App\Models\usuario;
use Illuminate\Support\Facades\Auth;
use DB;

class controladorProductos extends Controller
{
   public function creardata(){
        
            $data = $_POST;
            $user = Auth()-> user()['email'];
            $xobjeto =json_decode($data['cod_producto']);
           
            $objeto_validar = compras::where('estatus','PID')->get();
            $val_ = [  
                'cod_compra' => '0000',
                'des_producto' => $xobjeto->des_producto,
                'cod_producto' => $xobjeto->cod_producto,
                'iva_producto' => $xobjeto->iva_producto,
                'cant_producto' => $data['cant_producto'],
                'precio_producto' => $xobjeto->precio_producto,
                'estatus' => 'PID',
                'cod_usuario' => $user
            ];
            DB::table('compras')->insert([ $val_ ]);

            $objeto_validar = compras::where('estatus','PID')->get();
            DB::table('compras')->where('estatus','PID')->update(array('cod_compra' => $objeto_validar[0] ['id_compra'],'estatus'=>'P'));
                $message = 'Su compra fue procesada con exito';
               
                return view('compra_completa', compact('message'));
           
        
   }
   public function crear_producto(){
        
    $data = $_POST;
    $objeto_validar = depositos::where('estatus','A')->get();
    $val_ = [  
        'cod_producto' => 'PID',
        'des_producto' => $data['des_producto'],
        'iva_producto' => $data['iva_producto'],
        'cant_producto' => $data['cant_producto'],
        'precio_producto' => $data['precio_producto'],
        'estatus' => 'PID',
        'cod_deposito' => $objeto_validar[0]['cod_deposito']
    ];
    DB::table('productos')->insert([ $val_ ]);

    $objeto_validar = productos::where('estatus','PID')->get();
    DB::table('productos')->where('estatus','PID')->update(array('cod_producto' => $objeto_validar[0] ['id'],'estatus'=>'A'));
        $message = 'Producto creado con exito';
       
        return view('compra_completa', compact('message'));
   

}
   public function facturar_(){
        try {
             /*  return print_r($xobjeto); */
    $objeto_validar = compras::where('estatus','P')->get();
    $objeto_usuarios =  usuario::all();
    if (count($objeto_validar) < 0) {
        $message = 'No hay compras pendientes por facturar';
        return view('compra_completa', compact('message'));
    }else{
            $factura_total = 0;
            $factura_total_iva = 0;
            foreach($objeto_usuarios[0] as $i) { 
                $iva_monto = 0;
                $total_compra = 0;
                $total_compra_iva = 0;
                $total_factura = 0;
            foreach($objeto_validar[0] as $r)
        {
            if ($r->cod_usuario === $i->cod_usuario) {
                $total_compra = floatval($r -> cant_producto)  *  floatval($r -> precio_producto);
                $iva_monto = $total_compra * floatval($r -> iva_producto)  / 100;
                $total_compra_iva = $total_compra + $iva_monto;
    
                $val_ = [ 
                    'cod_compra' => $r->cod_compra,
                    'cod_factura' => 'PID',
                    'cod_producto' => $r->cod_producto,
                    'cant_producto' => $r->des_producto,
                    'monto_iva' => $iva_monto ,
                    'total_compra' => $total_compra_iva,
                    'total_monto' => $total_compra_iva ,
                ];
                DB::table('relacion_factura_compra')->insert([ $val_ ]);
            }
        }
   
        $val_ = [ 
            'cod_usuario' => $i->cod_usuario,
            'cod_factura' => '',
            'monto_iva' => '',
            'total_compra' => '',
            'estatus' => 'PID'
        ];
        DB::table('facturas')->insert([ $val_ ]);
    
        $objeto_validar_factura = facturas::where('estatus','PID')->get();

        DB::table('facturas')->where('estatus','PID')->update(array('cod_factura' => $objeto_validar_factura[0] ['id_factura'],'estatus'=>'P'));
        DB::table('relacion_factura_compra')->where('cod_factura','PID')
        ->update(array('cod_factura' => $objeto_validar_factura[0] ['id_factura'],'estatus'=> 'C'));

        $objeto_validar_relacion = relacion_factura_compra::where('cod_factura',$objeto_validar_factura[0] ['id_factura'])->get();
        foreach($objeto_validar_relacion as $Y)
        {
            $factura_total = $factura_total + floatval($r -> total_monto) ;
            $factura_total_iva =  $factura_total_iva + floatval($r -> monto_iva) ;
    
        }
        DB::table('facturas')->where('cod_factura',$objeto_validar_factura[0] ['id_factura'])
        ->update(array('monto_iva' => $factura_total_iva,'total_monto'=>$factura_total_iva, 'estatus'=> 'C' ));
        }
        
        $message = 'Facturacion realizada de forma exitosa';
        return view('compra_completa', compact('message'));
    }
        } catch (\Throwable $th) {
            return print_r($th);
        }
}
public function facturar()
{
    try {
         /*  return print_r($xobjeto); */
$objeto_validar = compras::where('estatus','P')->get();
$objeto_usuarios =  usuario::all();
if (count($objeto_validar) <= 0) {
    $message = 'No hay compras pendientes por facturar';
    return view('compra_completa', compact('message'));
}else{
    $factura_total = 0;
    $factura_total_iva = 0;
    $total_factura = 0;
    $monto_iva = 0;
    $total_compra = 0;
    $total_monto = 0;
    foreach ($objeto_usuarios as $k => $val) {
        foreach ($objeto_validar as $i => $value) {
           if ($val -> email === $value -> cod_usuario) {
            $total_compra =  floatval($value -> precio_producto) * floatval($value -> cant_producto);
            $monto_iva =  $total_compra * floatval($value -> iva_producto) / 100;
            $total_monto =  $total_compra + $monto_iva;
            $val_ = [  
                'cod_usuario' => $value -> cod_usuario,
                'cod_compra' => $value -> cod_compra,
                'cod_factura' => 'PID',
                'cod_producto' => $value -> cod_producto,
                'cant_producto' => $value -> cant_producto,
                'des_producto' => $value -> des_producto,
                'precio_producto' => $value -> precio_producto,
                'monto_iva' => $monto_iva,
                'total_compra' => $total_compra,
                'estatus' => 'P',
                'total_monto' => $total_monto
            ];
            DB::table('relacion_factura_compra')
            ->insert([ $val_ ]);
            DB::table('compras')->where('cod_compra',$value -> cod_compra)
            ->update(array('estatus'=> 'C'));
           } 
        }
        $objeto_validar_factura = relacion_factura_compra::where('estatus','P')->where('cod_usuario',$val->email)->get();
        if (count($objeto_validar_factura) > 0) {
            $val_ = [ 
                'cod_usuario' => $val->email,
                'des_usuario' => $val->name,
                'cod_factura' => 'PID',
                'monto_iva' => 'PID',
                'total_compra' => 'PID',
                'estatus' => 'PID'
            ];
            DB::table('facturas')->insert([ $val_ ]);
        
            $objeto_validar_factura = facturas::where('estatus','PID')->get();
    
            DB::table('facturas')->where('estatus','PID')->update(array('cod_factura' => $objeto_validar_factura[0] ['id_factura'],'estatus'=>'P'));
            DB::table('relacion_factura_compra')->where('cod_factura','PID')
            ->update(array('cod_factura' => $objeto_validar_factura[0] ['id_factura'],'estatus'=> 'C'));
            $objeto_validar_relacion = relacion_factura_compra::where('cod_factura',$objeto_validar_factura[0] ['id_factura'])->get();
            foreach($objeto_validar_relacion as $h => $xval)
            {
                $factura_total = $factura_total + floatval($xval -> total_monto) ;
                $factura_total_iva =  $factura_total_iva + floatval($xval-> monto_iva) ;
        
            }
            
            DB::table('facturas')->where('cod_factura',$objeto_validar_factura[0] ['id_factura'])
            ->update(array('total_compra' => $factura_total,'monto_iva'=>$factura_total_iva, 'estatus'=> 'C' ));
        }
    }
    $message = 'Facturacion realizada con exito';
    return view('compra_completa', compact('message'));
}
    } catch (\Throwable $th) {
        return print_r($th);
    }
}
   public function editdata(){
    return 'actualizar';
   }
   public function mostrarFactura($id){
    $data = '';
    $objeto_validar_factura = relacion_factura_compra::where('cod_factura',$id)->get();
    $objeto__factura = facturas::where('cod_factura',$id)->get();
    $data_ = $objeto_validar_factura;
    $factura = $objeto__factura;
    return view('mostrar_factura', compact('data_','factura'));
   }
   public function getproducto()
    {
        return view('producto');
    }
}
