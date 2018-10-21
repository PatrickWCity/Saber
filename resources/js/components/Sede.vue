<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esOrganizador()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sedes</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Sedes</li>
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
                <h3 class="card-title">Listado de Sedes</h3>
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
                        <th>Ubicación</th>
                        <th>Descripción</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="sede in sedes" :key="sede.idSede">
                        <td>{{sede.idSede}}</td>
                        <td>{{sede.nombre}}</td>
                        <td>{{sede.ubicacion}}</td>
                        <td>{{sede.descripcion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(sede)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarSede(sede.idSede)">
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
    <div class="modal fade" id="sedeModal" tabindex="-1" role="dialog" aria-labelledby="sedeModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="sedeModalTitulo">Actualizar Sede</h5>
            <h5 class="modal-title" v-show="!esEditar" id="sedeModalTitulo">Crear Sede</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarSede() : crearSede()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Sede">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input v-model="form.ubicacion" type="text" name="ubicacion" class="form-control" :class="{ 'is-invalid': form.errors.has('ubicacion') }" placeholder="Ubicación de Sede">
                <has-error :form="form" field="ubicacion"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Sede"></textarea>
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
  if(window.location.href.indexOf('#sedeModal') != -1) {
    $('#sedeModal').modal('show');
  }
});
export default {
  data() {
    return {
      esEditar: false,
      sedes: {},
      form: new Form({
        idSede: "",
        nombre: "",
        ubicacion: "",
        descripcion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarSede() {
      this.$Progress.start();
      this.form
        .put("api/sede/" + this.form.idSede)
        .then(() => {
          Fire.$emit("RefrescarListadoSede");
          $("#sedeModal").modal("hide");
          toast({
            type: "success",
            title: "¡La Sede fue Actualizada con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡La Sede no pudo ser Actualizada con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#sedeModal").modal("show");
    },
    editarModal(sede) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#sedeModal").modal("show");
      this.form.fill(sede);
    },
    eliminarSede(idSede) {
      swal({
        title:
          "¿Está seguro que desea eliminar la Sede de ID: " +
          idSede +
          "?",
        text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Sede!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/sede/" + idSede)
            .then(() => {
              Fire.$emit("RefrescarListadoSede");
              toast({
                type: "success",
                title: "¡La Sede fue Eliminada con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡La Sede no pudo ser Eliminada con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarSede() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/sede").then(({ data }) => (this.sedes = data));
      } else {
        axios
          .get("api/sede/" + palabraClave)
          .then(({ data }) => (this.sedes = data));
      }
    },
    loadSedes() {
      if(this.$gate.esAdmin() || this.$gate.esOrganizador()){
      axios
        .get("api/sede")
        .then(({ data }) => (this.sedes = data))
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
                    title: "Listado de Sedes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Sedes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Sedes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Sedes",
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
                  targets: 4
                }
              ]
            });
          });
        });
      }
    },
    crearSede() {
      this.$Progress.start();
      this.form
        .post("api/sede")
        .then(() => {
          Fire.$emit("RefrescarListadoSede");
          $("#sedeModal").modal("hide");
          toast({
            type: "success",
            title: "¡La Sede fue Creada con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡La Sede no pudo ser Ingresada con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadSedes();
    Fire.$on("RefrescarListadoSede", () => {
      table.destroy();
      this.loadSedes();
    });
    this.$Progress.finish();
  }
};
</script>