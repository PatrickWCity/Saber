<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mantenedor de Submódulos</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Submódulos</li>
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
                <h3 class="card-title">Listado de Submódulos</h3>
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
                        <th>Ubicación</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="submodulo in submodulos" :key="submodulo.idSubmodulo">
                        <td>{{submodulo.idSubmodulo}}</td>
                        <td>{{submodulo.nombre}}</td>
                        <td>{{submodulo.descripcion}}</td>
                        <td>{{submodulo.ubicacion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(submodulo)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarSubmodulo(submodulo.idSubmodulo)">
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
    <div class="modal fade" id="submoduloModal" tabindex="-1" role="dialog" aria-labelledby="submoduloModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="submoduloModalTitulo">Actualizar Submódulo</h5>
            <h5 class="modal-title" v-show="!esEditar" id="submoduloModalTitulo">Crear Submódulo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarSubmodulo() : crearSubmodulo()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Submodulo">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Submodulo"></textarea>
                <has-error :form="form" field="descripcion"></has-error>
              </div>
              <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input v-model="form.ubicacion" type="text" name="ubicacion" class="form-control" :class="{ 'is-invalid': form.errors.has('ubicacion') }" placeholder="Ubicación de Submodulo">
                <has-error :form="form" field="ubicacion"></has-error>
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
export default {
  data() {
    return {
      esEditar: false,
      submodulos: {},
      form: new Form({
        idSubmodulo: "",
        nombre: "",
        descripcion: "",
        ubicacion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarSubmodulo() {
      this.$Progress.start();
      this.form
        .put("api/submodulo/" + this.form.idSubmodulo)
        .then(() => {
          Fire.$emit("RefrescarListadoSubmodulo");
          $("#submoduloModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Submódulo fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Submódulo no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#submoduloModal").modal("show");
    },
    editarModal(submodulo) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#submoduloModal").modal("show");
      this.form.fill(submodulo);
    },
    eliminarSubmodulo(idSubmodulo) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Submódulo de ID: " +
          idSubmodulo +
          "?",
        text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Submódulo!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/submodulo/" + idSubmodulo)
            .then(() => {
              Fire.$emit("RefrescarListadoSubmodulo");
              toast({
                type: "success",
                title: "¡El Submódulo fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Submódulo no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarSubmodulo() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/submodulo").then(({ data }) => (this.submodulos = data));
      } else {
        axios
          .get("api/submodulo/" + palabraClave)
          .then(({ data }) => (this.submodulos = data));
      }
    },
    loadSubmodulos() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/submodulo")
        .then(({ data }) => (this.submodulos = data))
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
                    title: "Listado de Submódulos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Submódulos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Submódulos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Submódulos",
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
    crearSubmodulo() {
      this.$Progress.start();
      this.form
        .post("api/submodulo")
        .then(() => {
          Fire.$emit("RefrescarListadoSubmodulo");
          $("#submoduloModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Submódulo fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Submódulo no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadSubmodulos();
    Fire.$on("RefrescarListadoSubmodulo", () => {
      table.destroy();
      this.loadSubmodulos();
    });
    this.$Progress.finish();
  }
};
</script>