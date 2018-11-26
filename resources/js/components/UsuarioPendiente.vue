<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios Pendientes</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">UsuariosPendientes</li>
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
                <h3 class="card-title">Listado de Usuarios Pendientes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="listado" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Correo Elecrtonico</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="pendiente in pendientes" :key="pendiente.idUsuario">
                        <td>{{pendiente.idUsuario}}</td>
                        <td>{{pendiente.username}}</td>
                        <td>{{pendiente.email}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                           <input type="hidden" v-model="form.idUsuario"> 
                            <button type="submit" style="width:50%" class="btn btn-link" @click="habilitar(pendiente)">
                              <i class="fas fa-user-check"></i>
                            </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarUsuario(pendiente.idUsuario, pendiente.username)">
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
      pendientes: {},
      form: new Form({
        idUsuario: ""
      })
    };
  },
  methods: {
    habilitar(pendiente) {
      this.form.idUsuario = pendiente.idUsuario;
      this.$Progress.start();
      this.form
        .put("api/usuariopendiente/" + pendiente.idUsuario)
        .then(() => {
          Fire.$emit("RefrescarListado");
          toast({
            type: "success",
            title: "¡El Usuario fue Habilitado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Usuario no pudo ser Habilitado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    eliminarUsuario(idUsuario, username) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Usuario " +
          username +
          "?",
        //text: "¡No podrás revertir esta acción!",
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
              Fire.$emit("RefrescarListado");
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
    loadUsuariosPendiente() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/usuariopendiente")
        .then(
          ({ data }) => (
            (this.pendientes = data)
          )
        )
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
                    title: "Listado de Usuarios Pendientes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Usuarios Pendientes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Usuarios Pendientes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Usuarios Pendientes",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  }
                ],
              destroy: true,
              language: esp,
              columnDefs: [
                {
                  searchable: false,
                  orderable: false,
                  targets: 2
                }
              ]
            });
          });
        });
      }
    },
  },
  created() {
    this.$Progress.start();
    this.loadUsuariosPendiente();
    Fire.$on("RefrescarListado", () => {
      table.destroy();
      this.loadUsuariosPendiente();
    });
    this.$Progress.finish();
  }
};
</script>