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
                <!-- Modal -->
                <div class="modal fade" id="EliminarModal{{$evento->idEvento}}" tabindex="-1" role="dialog" aria-labelledby="EliminarModal{{$evento->idEvento}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal{{$evento->idEvento}}LongTitle">Eliminar Evento {{$evento->idEvento}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Esta Seguro que quere Eliminar el Evento {{$evento->idEvento}} ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Eventos no encontrado.</p>
    @endif
</div>
@endsection