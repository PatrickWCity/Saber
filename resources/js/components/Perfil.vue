<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mantenedor de Perfiles</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Perfiles</li>
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
                <h3 class="card-title">Listado de Perfiles</h3>
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
                      <tr v-for="perfil in perfiles" :key="perfil.idPerfil">
                        <td>{{perfil.idPerfil}}</td>
                        <td>{{perfil.nombre}}</td>
                        <td>{{perfil.descripcion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(perfil)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarPerfil(perfil.idPerfil)">
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
    <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="perfilModalTitulo">Actualizar Perfil</h5>
            <h5 class="modal-title" v-show="!esEditar" id="perfilModalTitulo">Crear Perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarPerfil() : crearPerfil()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Perfil">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Perfil"></textarea>
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
export default {
  data() {
    return {
      esEditar: false,
      perfiles: {},
      form: new Form({
        idPerfil: "",
        nombre: "",
        descripcion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarPerfil() {
      this.$Progress.start();
      this.form
        .put("api/perfil/" + this.form.idPerfil)
        .then(() => {
          Fire.$emit("RefrescarListadoPerfil");
          $("#perfilModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Perfil fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Perfil no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#perfilModal").modal("show");
    },
    editarModal(perfil) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#perfilModal").modal("show");
      this.form.fill(perfil);
    },
    eliminarPerfil(idPerfil) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Perfil de ID: " + idPerfil + "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Perfil!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/perfil/" + idPerfil)
            .then(() => {
              Fire.$emit("RefrescarListadoPerfil");
              toast({
                type: "success",
                title: "¡El Perfil fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Perfil no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarPerfil() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/perfil").then(({ data }) => (this.perfiles = data));
      } else {
        axios
          .get("api/perfil/" + palabraClave)
          .then(({ data }) => (this.perfiles = data));
      }
    },
    loadPerfiles() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/perfil")
        .then(({ data }) => (this.perfiles = data))
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
                    title: "Listado de Perfiles",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Perfiles",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Perfiles",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Perfiles",
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
    crearPerfil() {
      this.$Progress.start();
      this.form
        .post("api/perfil")
        .then(() => {
          Fire.$emit("RefrescarListadoPerfil");
          $("#perfilModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Perfil fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Perfil no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadPerfiles();
    Fire.$on("RefrescarListadoPerfil", () => {
      table.destroy();
      this.loadPerfiles();
    });
    this.$Progress.finish();
  }
};
</script>