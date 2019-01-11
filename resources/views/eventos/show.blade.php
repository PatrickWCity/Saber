@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Detalles de Evento</h1>
    <hr />
    @if($evento)
    <dl class="row">
        <dt class="col-4">Nombre:</dt>
        <dd class="col-8">{{$evento->nombre}}</dd>
        <dt class="col-4">Descripcion:</dt>
        @if (empty($evento->descripcion))
        <dd class="col-8">Este evento no tiene Descripcion</dd>
        @else
        <dd class="col-8">{{$evento->descripcion}}</dd>
        @endif
        <dt class="col-4">Fecha de Inicio:</dt>
        <dd class="col-8">{{Date::parse($evento->fechaInicio)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        <dt class="col-4">Fecha de Inicio:</dt>
        <dd class="col-8">{{Date::parse($evento->fechaInicio)->ago()}}</dd>
        <dt class="col-4">Fecha de Termino:</dt>
        <dd class="col-8">{{Date::parse($evento->fechaTermino)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        <dt class="col-4">Fecha de Termino:</dt>
        <dd class="col-8">{{Date::parse($evento->fechaTermino)->ago()}}</dd>
        <dt class="col-4">Duracion:</dt>
        <dd class="col-8">{{Date::parse($evento->fechaInicio)->timespan($evento->fechaTermino)}}</dd>
        <dt class="col-4">Tipo de Evento:</dt>
        <dd class="col-8">{{$evento->tipoevento->nombre}}</dd>
        <dt class="col-4">Sede:</dt>
        <dd class="col-8">{{$evento->sede->nombre}}</dd>
        <dt class="col-4">Area:</dt>
        <dd class="col-8">{{$evento->area->nombre}}</dd>
        <dt class="col-4">Expositor:</dt>
        <dd class="col-8">{{$evento->expositor->nombre}} {{$evento->expositor->appat}} {{$evento->expositor->apmat }}</dd>
    </dl>
    <a href="/eventos" class="btn btn-dark" title="Volver">Volver</a>
    @else
        <p>Evento no encontrado.</p>
    @endif
</div>
@endsection