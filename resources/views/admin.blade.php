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
                    <form action="{{ route('producto.facturar') }}" method="POST">
                        @csrf
                        <div class="form-group my-2">
                            <input type="submit" class="btn btn-primary form-control" value="Generar Facturacion">
                        </div>
                </form>
                <div class="form-group my-2">
                    <a class="btn btn-success form-control" href="{{route('producto.producto')}} ">Crear Productos</a>
                </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <table class="table table-dark table-bordered table-condensed">
                <thead>
                    <th>Usuario</th>
                    <th>Factura</th>
                    <th> Impuesto</th>
                    <th> Total</th>
                    <th> Ver</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->cod_usuario}}</td>
                        <td>0000{{$item->cod_factura}}</td>
                        <td>$ {{$item->monto_iva}}</td>
                        <td>$ {{$item->total_compra}}</td>
                        <td class="justify-content-center"><a class="btn btn-primary" href="{{route('producto.facturar_mostrar',$item->cod_factura)}} ">Factura</a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection