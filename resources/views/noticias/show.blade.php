@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Detalles de Noticia</h1>
    <hr />
    @if(count($noticias) > 0)
    <dl class="row">
        @foreach($noticias as $noticia)
        <dt class="col-4">Titulo:</dt>
        <dd class="col-8">{{$noticia->titulo}}</dd>
        <dt class="col-4">Contenido:</dt>
        @if (empty($noticia->contenido))
        <dd class="col-8">Este noticia no tiene Descripcion</dd>
        @else
        <dd class="col-8">{!!$noticia->contenido!!}</dd>
        @endif
        <dt class="col-4">Imagen de Portada:</dt>
        <dd class="col-8">{{$noticia->imagenPortada}}</dd>
        <dt class="col-4">Fecha de Creacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaCreada)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        <dt class="col-4">Fecha de Creacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaCreada)->ago()}}</dd>
        <dt class="col-4">Fecha de Actualizacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaActualizada)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        <dt class="col-4">Fecha de Actualizacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaActualizada)->ago()}}</dd>
        <dt class="col-4">Duracion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaCreada)->timespan($noticia->fechaActualizada)}}</dd>
        <dt class="col-4">Tipo de Noticia:</dt>
        <dd class="col-8">{{$noticia->TipoNoticia}}</dd>
    </dl>
    <a href="/noticias" class="btn btn-dark" title="Volver">Volver</a>
    @endforeach
    @else
        <p>Noticia no encontrada.</p>
    @endif
</div>
@endsection