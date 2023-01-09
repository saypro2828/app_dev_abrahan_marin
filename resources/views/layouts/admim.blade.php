@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Facturacion </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('producto.facturar')}}" method="POST">
                        @csrf
                        <div class="form-group my-2">
                            <input type="submit" class="btn btn-primary form-control" value="Generar Facturacion">
                        </div>
                </form>
                </div>


            </div>
        </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <table class="table table-dark table-bordered table-condensed">
                <thead>
                    <th>Compra</th>
                    <th>Usuario</th>
                    <th>Factura</th>
                    <th> Producto</th>
                    <th> Cantidad</th>
                    <th> Precio</th>
                    <th>Iva</th>
                    <th> Monto iva</th>
                    <th> Total</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->cod_usuario}}</td>
                        <td>{{$item->cod_compra}}</td>
                        <td>{{$item->cod_factura}}</td>
                        <td>{{$item->cod_producto}}</td>
                        <td>{{$item->des_producto}}</td>
                        <td>{{$item->precio_producto}}</td>
                        <td>{{$item->iva_producto}}</td>
                        <td>{{$item->monto_iva}}</td>
                        <td>{{$item->total_compra}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection