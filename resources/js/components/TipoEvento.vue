<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esOrganizador()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tipo de Eventos</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">TipoEventos</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Tipos de Eventos</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary center-block" @click="crearModal"><i class="fas fa-plus"></i> Crear</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="listado" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="tipoEvento in tipoEventos" :key="tipoEvento.idTipoEvento">
                        <td>{{tipoEvento.idTipoEvento}}</td>
                        <td>{{tipoEvento.nombre}}</td>
                        <td>{{tipoEvento.descripcion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(tipoEvento)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarTipoEvento(tipoEvento.idTipoEvento)">
                            <i class="fas fa-trash"></i>
                          </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="tipoEventoModal" tabindex="-1" role="dialog" aria-labelledby="tipoEventoModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="tipoEventoModalTitulo">Actualizar Tipo de Evento</h5>
            <h5 class="modal-title" v-show="!esEditar" id="tipoEventoModalTitulo">Crear Tipo de Evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarTipoEvento() : crearTipoEvento()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de TipoEvento">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de TipoEvento"></textarea>
                <has-error :form="form" field="descripcion"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" v-show="!esEditar" class="btn btn-primary">Ingresar</button>
              <button type="submit" v-show="esEditar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <unauthorized v-if="(!$gate.esAdmin() && !$gate.esOrganizador()) || (!$gate.esOrganizador() && $gate.esAdmin()) && ($gate.esOrganizador() && !$gate.esAdmin())"></unauthorized>
</div>
</template>

<script>
var table;
$(document).ready(function() {
  if(window.location.href.indexOf('#tipoEventoModal') != -1) {
    $('#tipoEventoModal').modal('show');
  }
});
export default {
  data() {
    return {
      esEditar: false,
      tipoEventos: {},
      form: new Form({
        idTipoEvento: "",
        nombre: "",
        descripcion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarTipoEvento() {
      this.$Progress.start();
      this.form
        .put("api/tipoevento/" + this.form.idTipoEvento)
        .then(() => {
          Fire.$emit("RefrescarListadoTipoEvento");
          $("#tipoEventoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Tipo de Evento fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Tipo de Evento no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#tipoEventoModal").modal("show");
    },
    editarModal(tipoEvento) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#tipoEventoModal").modal("show");
      this.form.fill(tipoEvento);
    },
    eliminarTipoEvento(idTipoEvento) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Tipo de Evento de ID: " + idTipoEvento + "?",
        text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Tipo de Evento!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/tipoevento/" + idTipoEvento)
            .then(() => {
              Fire.$emit("RefrescarListadoTipoEvento");
              toast({
                type: "success",
                title: "¡El Tipo de Evento fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Tipo de Evento no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarTipoEvento() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/tipoevento").then(({ data }) => (this.tipoEventos = data));
      } else {
        axios
          .get("api/tipoevento/" + palabraClave)
          .then(({ data }) => (this.tipoEventos = data));
      }
    },
    loadTipoEventos() {
      if(this.$gate.esAdmin() || this.$gate.esOrganizador()){
      axios
        .get("api/tipoevento")
        .then(({ data }) => (this.tipoEventos = data))
        .then(() => {
          $(document).ready(function() {
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
                    title: "Listado de Tipos de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Tipos de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Tipos de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Tipos de Eventos",
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
                  targets: 3
                }
              ]
            });
          });
        });
      }
    },
    crearTipoEvento() {
      this.$Progress.start();
      this.form
        .post("api/tipoevento")
        .then(() => {
          Fire.$emit("RefrescarListadoTipoEvento");
          $("#tipoEventoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Tipo de Evento fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Tipo de Evento no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadTipoEventos();
    Fire.$on("RefrescarListadoTipoEvento", () => {
      table.destroy();
      this.loadTipoEventos();
    });
    this.$Progress.finish();
  }
};
</script>