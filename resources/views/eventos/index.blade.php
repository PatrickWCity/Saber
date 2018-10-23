@extends('layouts.app')

@section('content')
<div class="container mt-1 pt-1">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css"/>
    <h2>Eventos</h2>
    <p>Listado de Eventos</p>
    @if(count($eventos) > 0)    
    <table id="listado" class="table table-bordered table-striped table-responsive-sm">
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
                <td class="align-middle">{{Carbon\Carbon::parse($evento->fechaInicio)->toDayDateTimeString()}}</td>
                <td class="align-middle">{{Carbon\Carbon::parse($evento->fechaTermino)->toDayDateTimeString()}}</td>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>
<script>$(document).ready(function() {
        table = $("#listado").DataTable({
          dom: "lBfrtip",
            buttons: [
              {
                extend: "copy",
                title: null,
                exportOptions: {
                  columns: "th:not(:last-child)"
                }
              },
              {
                extend: "csv",
                title: "Listado de Eventos",
                exportOptions: {
                  columns: "th:not(:last-child)"
                }
              },
              {
                extend: "excel",
                title: "Listado de Eventos",
                exportOptions: {
                  columns: "th:not(:last-child)"
                }
              },
              {
                extend: "pdf",
                title: "Listado de Eventos",
                exportOptions: {
                  columns: "th:not(:last-child)"
                }
              },
              {
                extend: "print",
                title: "Listado de Eventos",
                exportOptions: {
                  columns: "th:not(:last-child)"
                }
              }
            ],
          destroy: true,
          language: esp,
          order: [[ 0, "desc" ]],
          columnDefs: [
            {
              searchable: false,
              orderable: false,
              targets: 8
            }
          ]
        });
      });
      </script>
    @else
        <p>Eventos no encontrado.</p>
    @endif
</div>
@endsection