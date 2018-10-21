@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
    <h2>Eventos</h2>
    <p>Listado de Eventos</p>
    @if(count($eventos) > 0)    
    <table class="table table-bordered table-striped table-responsive-sm">
        <thead>
            <tr class="text-center">
                <th class="align-middle">Nombre</th>
                <th class="align-middle">Descripcion</th>
                <th class="align-middle">Fecha de Inicio</th>
                <th class="align-middle">Fecha de Termino</th>
                <th class="align-middle">Tipo de Evento</th>
                <th class="align-middle">Sede</th>
                <th class="align-middle">Area</th>
                <th class="align-middle">Expositor</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td class="align-middle">{{$evento->nombre}}</td>
                <td class="align-middle">{{$evento->descripcion}}</td>
                <td class="align-middle">{{$evento->fechaInicio}}</td>
                <td class="align-middle">{{$evento->fechaTermino}}</td>
                <td class="align-middle">{{$evento->TipoEvento}}</td>
                <td class="align-middle">{{$evento->Sede}}</td>
                <td class="align-middle">{{$evento->Area}}</td>
                <td class="align-middle">{{$evento->Expositor}}</td>
                <td class="align-middle">
                <div class="btn-group btn-block" role="group">
                    <a class="btn btn-primary btn-block" href="/eventos/{{$evento->idEvento}}" role="button" title="Ver Evento {{$evento->idEvento}}">Ver</a>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Eventos no encontrado.</p>
    @endif
</div>
@endsection