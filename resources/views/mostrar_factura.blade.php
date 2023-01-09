@extends('layouts.app')

@section('content')
<div class="container">
   
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
     
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <table class="table table-dark table-condensed">
                <a href=" {{route('home')}} ">Volver</a>
                <p><b>Factura:</b>  0000{{$factura[0] -> cod_factura}} </p>
                <p><b>Cliente:</b>  {{$factura [0] -> des_usuario}} </p>
                <thead>
                    <th>Producto</th>
                    <th>Codigo</th>
                    <th> Cantidad</th>
                    <th> Precio</th>
                    <th> Impuesto</th>
                    <th> Total</th>
                </thead>
                <tbody>
                    @foreach ($data_ as $item)
                    <tr>
                        <td>{{$item-> des_producto}}</td>
                        <td>{{$item-> cod_producto}}</td>
                        <td>{{$item-> cant_producto}}</td>
                        <td>{{$item-> precio_producto}}</td>
                        <td>$ {{$item-> monto_iva}}</td>
                        <td>$ {{$item-> total_compra}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> Total iva: $ {{$factura[0] -> monto_iva}} </td>
                        <td> Total: $ {{$factura[0] -> total_compra}} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection