@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Detalles de Evento</h1>
    <hr />
    @if(count($eventos) > 0)
    <dl class="row">
        @foreach($eventos as $evento)
        <dt class="col-4">Nombre:</dt>
        <dd class="col-8">{{$evento->nombre}}</dd>
        <dt class="col-4">Descripcion:</dt>
        @if (empty($evento->descripcion))
        <dd class="col-8">Este evento no tiene Descripcion</dd>
        @else
        <dd class="col-8">{{$evento->descripcion}}</dd>
        @endif
        <dt class="col-4">Fecha de Inicio:</dt>
        <dd class="col-8">{{$evento->fechaInicio}}</dd>
        <dt class="col-4">Fecha de Termino:</dt>
        <dd class="col-8">{{$evento->fechaTermino}}</dd>
        <dt class="col-4">Tipo de Evento:</dt>
        <dd class="col-8">{{$evento->TipoEvento}}</dd>
        <dt class="col-4">Sede:</dt>
        <dd class="col-8">{{$evento->Sede}}</dd>
        <dt class="col-4">Area:</dt>
        <dd class="col-8">{{$evento->Area}}</dd>
        <dt class="col-4">Expositor:</dt>
        <dd class="col-8">{{$evento->Expositor}}</dd>
    </dl>
    <a href="/eventos" class="btn btn-dark" title="Volver">Volver</a>
    @endforeach
    @else
        <p>Evento no encontrado.</p>
    @endif
</div>
@endsection