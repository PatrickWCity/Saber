@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h1>Detalles de Noticia</h1>
    <hr />
    @if($noticia)
    <dl class="row">
        <dt class="col-4">Titulo:</dt>
        <dd class="col-8">{{$noticia->titulo}}</dd>
        <dt class="col-4">Contenido:</dt>
        @if (empty($noticia->contenido))
        <dd class="col-8">Este noticia no tiene Descripcion</dd>
        @else
        <dd class="col-8">{!!$noticia->contenido!!}</dd>
        @endif
        <dt class="col-4">Imagen de Portada:</dt>
        <dd class="col-8"><a href="/img/noticias/{{$noticia->imagenPortada}}">{{$noticia->imagenPortada}}</a>
        <img style="width:100%" src="/img/noticias/{{$noticia->imagenPortada}}"></dd>
        <dt class="col-4">Fecha de Creacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaCreada)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        <dt class="col-4">Fecha de Creacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaCreada)->ago()}}</dd>
        @if (empty($noticia->fechaActualizada))
        
        @else
        <dt class="col-4">Fecha de Actualizacion:</dt>
        <dd class="col-8">{{Date::parse($noticia->fechaActualizada)->format('l, j \d\e F \d\e Y G:i')}}</dd>
        @endif
        <dt class="col-4">Tipo de Noticia:</dt>
        <dd class="col-8">{{$noticia->tiponoticia->nombre}}</dd>
    </dl>
    <a href="/noticias" class="btn btn-dark" title="Volver">Volver a Noticias</a>
    <a href="/" class="btn btn-dark" title="Volver">Volver a Página Principal</a>
    @else
        <p>Noticia no encontrada.</p>
    @endif
</div>
@endsection