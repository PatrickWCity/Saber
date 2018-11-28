@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Ingresar Voluntario</h1>
    {!! Form::open(['action' => 'VoluntarioController@store','method' => 'post']) !!}
        <div class="form-group">
            {{Form::label('run', 'RUN')}}
            {{Form::text('run','', ['class'=> 'form-control', 'placeholder'=>'RUN de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre','', ['class'=> 'form-control', 'placeholder'=>'Nombre de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('appat', 'Apellido Paterno')}}
            {{Form::text('appat','', ['class'=> 'form-control', 'placeholder'=>'Apellido Paterno de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('apmat', 'Apellido Materno')}}
            {{Form::text('apmat','', ['class'=> 'form-control', 'placeholder'=>'Apellido Materno de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('direccion', 'Direccion')}}
            {{Form::text('direccion','', ['class'=> 'form-control', 'placeholder'=>'Direccion de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('telefono', 'Telefono')}}
            {{Form::text('telefono','', ['class'=> 'form-control', 'placeholder'=>'Telefono de Voluntario'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email','', ['class'=> 'form-control', 'placeholder'=>'Email de Voluntario'])}}
        </div>
        <div class="form-group">
                {{Form::label('idTipoVoluntario', 'Tipo de Voluntario')}}
                {{Form::select('idTipoVoluntario', $tipoVoluntarios, null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
                {{Form::label('idProfesion', 'Profesion')}}
                {{Form::select('idProfesion', $profesiones, null, ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Ingresar', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection