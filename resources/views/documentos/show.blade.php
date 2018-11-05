@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Detalles de Documento</h1>
    <hr />
    @if(count($documentos) > 0)
    <dl class="row">
        @foreach($documentos as $documento)
        <dt class="col-4">Nombre:</dt>
        <dd class="col-8">{{$documento->nombre}}</dd>
        <dt class="col-4">Descripcion:</dt>
        @if (empty($documento->descripcion))
        <dd class="col-8">Este documento no tiene Descripcion</dd>
        @else
        <dd class="col-8">{{$documento->descripcion}}</dd>
        @endif
        <dt class="col-4">Ubicacion:</dt>
        <dd class="col-8">{{$documento->ubicacion}}</dd>
        <dt class="col-4">Tipo de Documento:</dt>
        <dd class="col-8">{{$documento->TipoDocumento}}</dd>
    </dl>
    <a href="/documentos" class="btn btn-dark" title="Volver">Volver</a>
    @endforeach
    @else
        <p>Documento no encontrado.</p>
    @endif
</div>
@endsection