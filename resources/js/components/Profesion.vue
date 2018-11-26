<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profesiónes</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Profesiónes</li>
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
                <h3 class="card-title">Listado de Profesiónes</h3>
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
                      <tr v-for="profesion in profesiones" :key="profesion.idProfesion">
                        <td>{{profesion.idProfesion}}</td>
                        <td>{{profesion.nombre}}</td>
                        <td>{{profesion.descripcion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(profesion)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarProfesion(profesion.idProfesion, profesion.nombre)">
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
    <div class="modal fade" id="profesionModal" tabindex="-1" role="dialog" aria-labelledby="profesionModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="profesionModalTitulo">Actualizar Profesion</h5>
            <h5 class="modal-title" v-show="!esEditar" id="profesionModalTitulo">Crear Profesion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarProfesion() : crearProfesion()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Profesion">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Profesion"></textarea>
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
  <unauthorized v-if="!$gate.esAdmin()"></unauthorized>
</div>
</template>

<script>
var table;
$(document).ready(function() {
  if(window.location.href.indexOf('#profesionModal') != -1) {
    $('#profesionModal').modal('show');
  }
});
export default {
  data() {
    return {
      esEditar: false,
      profesiones: {},
      form: new Form({
        idProfesion: "",
        nombre: "",
        descripcion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarProfesion() {
      this.$Progress.start();
      this.form
        .put("api/profesion/" + this.form.idProfesion)
        .then(() => {
          Fire.$emit("RefrescarListadoProfesion");
          $("#profesionModal").modal("hide");
          toast({
            type: "success",
            title: "¡La Profesión fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡La Profesión no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#profesionModal").modal("show");
    },
    editarModal(profesion) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#profesionModal").modal("show");
      this.form.fill(profesion);
    },
    eliminarProfesion(idProfesion, nombre) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Profesion " +
          nombre +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Profesion!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/profesion/" + idProfesion)
            .then(() => {
              Fire.$emit("RefrescarListadoProfesion");
              toast({
                type: "success",
                title: "¡La Profesión fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡La Profesión no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarProfesion() {
      if (palabraClave == null || palabraClave == "") {
        axios
          .get("api/profesion")
          .then(({ data }) => (this.profesiones = data));
      } else {
        axios
          .get("api/profesion/" + palabraClave)
          .then(({ data }) => (this.profesiones = data));
      }
    },
    loadProfesiones() {
      if (this.$gate.esAdmin()) {
        axios
          .get("api/profesion")
          .then(({ data }) => (this.profesiones = data))
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
                    title: "Listado de Profesiónes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Profesiónes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Profesiónes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Profesiónes",
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
                    targets: 3
                  }
                ]
              });
            });
          });
      }
    },
    crearProfesion() {
      this.$Progress.start();
      this.form
        .post("api/profesion")
        .then(() => {
          Fire.$emit("RefrescarListadoProfesion");
          $("#profesionModal").modal("hide");
          toast({
            type: "success",
            title: "¡La Profesión fue Creada con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡La Profesión no pudo ser Ingresada con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadProfesiones();
    Fire.$on("RefrescarListadoProfesion", () => {
      table.destroy();
      this.loadProfesiones();
    });
    this.$Progress.finish();
  }
};
</script>