@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comprar </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('producto.creardata')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example" name="cod_producto">
                                                <option selected>Productos</option>
                                                @foreach ($data as $item)
                                                <option value="{{$item->cod_producto}}">{{$item->des_producto}} ( Precio $ {{$item->precio_producto}} ) </option>
                                                @endforeach
                                                    
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="cant_producto">
                        </div>
                        <div class="form-group my-2">
                            <input type="submit" class="btn btn-primary form-control" value="Enviar">
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection