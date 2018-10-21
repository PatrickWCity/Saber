<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esAutor()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tipo de Noticias</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">TipoNoticias</li>
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
                <h3 class="card-title">Listado de Tipos de Noticias</h3>
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
                      <tr v-for="tipoNoticia in tipoNoticias" :key="tipoNoticia.idTipoNoticia">
                        <td>{{tipoNoticia.idTipoNoticia}}</td>
                        <td>{{tipoNoticia.nombre}}</td>
                        <td>{{tipoNoticia.descripcion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(tipoNoticia)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarTipoNoticia(tipoNoticia.idTipoNoticia)">
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
    <div class="modal fade" id="tipoNoticiaModal" tabindex="-1" role="dialog" aria-labelledby="tipoNoticiaModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="tipoNoticiaModalTitulo">Actualizar Tipo de Noticia</h5>
            <h5 class="modal-title" v-show="!esEditar" id="tipoNoticiaModalTitulo">Crear Tipo de Noticia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarTipoNoticia() : crearTipoNoticia()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de TipoNoticia">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de TipoNoticia"></textarea>
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
  <unauthorized v-if="(!$gate.esAdmin() && !$gate.esAutor()) || (!$gate.esAutor() && $gate.esAdmin()) && ($gate.esAutor() && !$gate.esAdmin())"></unauthorized>
</div>
</template>

<script>
var table;
export default {
  data() {
    return {
      esEditar: false,
      tipoNoticias: {},
      form: new Form({
        idTipoNoticia: "",
        nombre: "",
        descripcion: "",
        palabraClave: ""
      })
    };
  },
  methods: {
    actualizarTipoNoticia() {
      this.$Progress.start();
      this.form
        .put("api/tiponoticia/" + this.form.idTipoNoticia)
        .then(() => {
          Fire.$emit("RefrescarListadoTipoNoticia");
          $("#tipoNoticiaModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Tipo de Noticia fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Tipo de Noticia no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#tipoNoticiaModal").modal("show");
    },
    editarModal(tipoNoticia) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#tipoNoticiaModal").modal("show");
      this.form.fill(tipoNoticia);
    },
    eliminarTipoNoticia(idTipoNoticia) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Tipo de Noticia de ID: " +
          idTipoNoticia +
          "?",
        text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Tipo de Noticia!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/tiponoticia/" + idTipoNoticia)
            .then(() => {
              Fire.$emit("RefrescarListadoTipoNoticia");
              toast({
                type: "success",
                title: "¡El Tipo de Noticia fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Tipo de Noticia no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarTipoNoticia() {
      if (palabraClave == null || palabraClave == "") {
        axios
          .get("api/tiponoticia")
          .then(({ data }) => (this.tipoNoticias = data));
      } else {
        axios
          .get("api/tiponoticia/" + palabraClave)
          .then(({ data }) => (this.tipoNoticias = data));
      }
    },
    loadTipoNoticias() {
      if (this.$gate.esAdmin() || this.$gate.esAutor()) {
        axios
          .get("api/tiponoticia")
          .then(({ data }) => (this.tipoNoticias = data))
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
                    title: "Listado de Tipos de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Tipos de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Tipos de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Tipos de Noticias",
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
    crearTipoNoticia() {
      this.$Progress.start();
      this.form
        .post("api/tiponoticia")
        .then(() => {
          Fire.$emit("RefrescarListadoTipoNoticia");
          $("#tipoNoticiaModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Tipo de Noticia fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Tipo de Noticia no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadTipoNoticias();
    Fire.$on("RefrescarListadoTipoNoticia", () => {
      table.destroy();
      this.loadTipoNoticias();
    });
    this.$Progress.finish();
  }
};
</script>