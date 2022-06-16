
@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <h2>Crear un nuevo provedor</h2>
    <hr>
        <form action="{{route('provedor.update')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
            {!! csrf_field() !!}  <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
 @endif
            
 <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre')}}"
 />
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <textarea class="form-control" id="direccion" name="direccion">{{old('direccion')}}</textarea>
            </div>
            <br>
          
           
            <button type="submit" class="btn btn-success">Editar provedor</button>
        </form>
    </div>
 </div>
 
@endsection 
