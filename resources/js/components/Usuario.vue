<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mantenedor de Usuarios</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
                <h3 class="card-title">Listado de Usuarios</h3>
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
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="usuario in usuarios" :key="usuario.idUsuario">
                        <td>{{usuario.idUsuario}}</td>
                        <td>{{usuario.run}}</td>
                        <td>{{usuario.nombre}}</td>
                        <td>{{usuario.appat}}</td>
                        <td>{{usuario.apmat}}</td>
                        <td>{{usuario.direccion}}</td>
                        <td>{{usuario.telefono}}</td>
                        <td>{{usuario.email}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(usuario)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarUsuario(usuario.idUsuario)">
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
    <div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="usuarioModalTitulo">Actualizar Usuario</h5>
            <h5 class="modal-title" v-show="!esEditar" id="usuarioModalTitulo">Crear Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarUsuario() : crearUsuario()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="run">RUN</label>
                <input v-model="form.run" type="text" name="run" class="form-control" :class="{ 'is-invalid': form.errors.has('run') }" placeholder="RUN de Usuario">
                <has-error :form="form" field="run"></has-error>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Usuario">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="appat">Apellido Paterno</label>
                <input v-model="form.appat" type="text" name="appat" class="form-control" :class="{ 'is-invalid': form.errors.has('appat') }" placeholder="Apellido Paterno de Usuario">
                <has-error :form="form" field="appat"></has-error>
              </div>
              <div class="form-group">
                <label for="apmat">Apellido Materno</label>
                <input v-model="form.apmat" type="text" name="apmat" class="form-control" :class="{ 'is-invalid': form.errors.has('apmat') }" placeholder="Apellido Materno de Usuario">
                <has-error :form="form" field="apmat"></has-error>
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input v-model="form.direccion" type="text" name="direccion" class="form-control" :class="{ 'is-invalid': form.errors.has('direccion') }" placeholder="Dirección de Usuario">
                <has-error :form="form" field="direccion"></has-error>
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input v-model="form.telefono" type="text" name="telefono" class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }" placeholder="Teléfono de Usuario">
                <has-error :form="form" field="telefono"></has-error>
              </div>
              <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input v-model="form.email" type="email" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Correo Electrónico de Usuario">
                <has-error :form="form" field="email"></has-error>
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
      usuarios: {},
      form: new Form({
        idUsuario: "",
        run: "",
        nombre: "",
        appat: "",
        apmat: "",
        direccion: "",
        telefono: "",
        email: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarUsuario() {
      this.$Progress.start();
      this.form
        .put("api/usuario/" + this.form.idUsuario)
        .then(() => {
          Fire.$emit("RefrescarListadoUsuario");
          $("#usuarioModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Usuario fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Usuario no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#usuarioModal").modal("show");
    },
    editarModal(usuario) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#usuarioModal").modal("show");
      this.form.fill(usuario);
    },
    eliminarUsuario(idUsuario) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Usuario de ID: " +
          idUsuario +
          "?",
        text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Usuario!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/usuario/" + idUsuario)
            .then(() => {
              Fire.$emit("RefrescarListadoUsuario");
              toast({
                type: "success",
                title: "¡El Usuario fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Usuario no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarUsuario() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/usuario").then(({ data }) => (this.usuarios = data));
      } else {
        axios
          .get("api/usuario/" + palabraClave)
          .then(({ data }) => (this.usuarios = data));
      }
    },
    loadUsuarios() {
      if (this.$gate.esAdmin()) {
        axios
          .get("api/usuario")
          .then(({ data }) => (this.usuarios = data))
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
                    title: "Listado de Usuarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Usuarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Usuarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Usuarios",
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
                    targets: 8
                  }
                ]
              });
            });
          });
      }
    },
    crearUsuario() {
      this.$Progress.start();
      this.form
        .post("api/usuario")
        .then(() => {
          Fire.$emit("RefrescarListadoUsuario");
          $("#usuarioModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Usuario fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Usuario no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadUsuarios();
    Fire.$on("RefrescarListadoUsuario", () => {
      table.destroy();
      this.loadUsuarios();
    });
    this.$Progress.finish();
  }
};
</script>