@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Productos </div>
                
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div  class=" py-2 px-2">
                                        <form action="{{ route('producto.prod') }}" method="POST">
                                            @csrf
                                            <div class="form-group my-2">
                                                <label for="">Producto</label>
                                                <input type="text" class="form-control" name="des_producto" required>
                                            </div>
                                            <div class="form-group my-2">
                                                <label for="">Cantidad</label>
                                                <input type="text" class="form-control" name="cant_producto" required>
                                            </div>
                                            <div class="form-group my-2">
                                                <label for="">Precio</label>
                                                <input type="text" class="form-control" name="precio_producto" required>
                                            </div>
                                            <div class="form-group my-2">
                                                <label for="">Impuesto %</label>
                                                <input type="text" class="form-control" name="iva_producto" required>
                                            </div>
                                            <div class="form-group my-2">
                                                <button type="submit" class="btn btn-primary form-control">Enviar</button>
                                            </div>
                                            <a href=" {{route('home')}} ">Volver</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
    </div>
</div>
@endsection