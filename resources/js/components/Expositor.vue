<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esOrganizador()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Expositores</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Expositores</li>
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
                <h3 class="card-title">Listado de Expositores</h3>
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
                        <th>RUN</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expositor in expositores" :key="expositor.idExpositor">
                        <td>{{expositor.idExpositor}}</td>
                        <td>{{expositor.run}}</td>
                        <td>{{expositor.nombre}}</td>
                        <td>{{expositor.appat}}</td>
                        <td>{{expositor.apmat}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(expositor)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarExpositor(expositor.idExpositor)">
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
    <div class="modal fade" id="expositorModal" tabindex="-1" role="dialog" aria-labelledby="expositorModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="expositorModalTitulo">Actualizar Expositor</h5>
            <h5 class="modal-title" v-show="!esEditar" id="expositorModalTitulo">Crear Expositor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarExpositor() : crearExpositor()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="run">RUN</label>
                <input v-model="form.run" type="text" name="run" class="form-control" :class="{ 'is-invalid': form.errors.has('run') }" placeholder="RUN de Expositor">
                <has-error :form="form" field="run"></has-error>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Expositor">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="appat">Apellido Paterno</label>
                <input v-model="form.appat" type="text" name="appat" class="form-control" :class="{ 'is-invalid': form.errors.has('appat') }" placeholder="Apellido Paterno de Expositor">
                <has-error :form="form" field="appat"></has-error>
              </div>
              <div class="form-group">
                <label for="apmat">Apellido Materno</label>
                <input v-model="form.apmat" type="text" name="apmat" class="form-control" :class="{ 'is-invalid': form.errors.has('apmat') }" placeholder="Apellido Materno de Expositor">
                <has-error :form="form" field="apmat"></has-error>
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
  if(window.location.href.indexOf('#expositorModal') != -1) {
    $('#expositorModal').modal('show');
  }
});
export default {
  data() {
    return {
      esEditar: false,
      expositores: {},
      form: new Form({
        idExpositor: "",
        run: "",
        nombre: "",
        appat: "",
        apmat: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarExpositor() {
      this.$Progress.start();
      this.form
        .put("api/expositor/" + this.form.idExpositor)
        .then(() => {
          Fire.$emit("RefrescarListadoExpositor");
          $("#expositorModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Expositor fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Expositor no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#expositorModal").modal("show");
    },
    editarModal(expositor) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#expositorModal").modal("show");
      this.form.fill(expositor);
    },
    eliminarExpositor(idExpositor) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Expositor de ID: " +
          idExpositor +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Expositor!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/expositor/" + idExpositor)
            .then(() => {
              Fire.$emit("RefrescarListadoExpositor");
              toast({
                type: "success",
                title: "¡El Expositor fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Expositor no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarExpositor() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/expositor").then(({ data }) => (this.expositores = data));
      } else {
        axios
          .get("api/expositor/" + palabraClave)
          .then(({ data }) => (this.expositores = data));
      }
    },
    loadExpositores() {
      if (this.$gate.esAdmin() || this.$gate.esOrganizador()) {
        axios
          .get("api/expositor")
          .then(({ data }) => (this.expositores = data))
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
                    title: "Listado de Expositores",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Expositores",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Expositores",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Expositores",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  }
                ],
                destroy: true,
                language: esp,
                order: [[0, "desc"]],
                columnDefs: [
                  {
                    searchable: false,
                    orderable: false,
                    targets: 5
                  }
                ]
              });
            });
          });
      }
    },
    crearExpositor() {
      this.$Progress.start();
      this.form
        .post("api/expositor")
        .then(() => {
          Fire.$emit("RefrescarListadoExpositor");
          $("#expositorModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Expositor fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Expositor no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadExpositores();
    Fire.$on("RefrescarListadoExpositor", () => {
      table.destroy();
      this.loadExpositores();
    });
    this.$Progress.finish();
  }
};
</script>