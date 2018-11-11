<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esAutor()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Noticias</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Noticias</li>
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
                <h3 class="card-title">Listado de Noticias</h3>
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
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Imagen de Portada</th>
                        <th>Fecha Creada</th>
                        <th>Fecha Actualizada</th>
                        <th>Tipo de Noticia</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="noticia in noticias" :key="noticia.idNoticia">
                        <td>{{noticia.idNoticia}}</td>
                        <td>{{noticia.titulo}}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{noticia.contenido}}</td>
                        <td>{{noticia.imagenPortada}}</td>
                        <td>{{noticia.fechaCreada | myDate}}</td>
                        <td>{{noticia.fechaActualizada | myDate}}</td>
                        <td>{{noticia.TipoNoticia}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(noticia)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarNoticia(noticia.idNoticia)">
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
    <div class="modal fade" id="noticiaModal" tabindex="-1" role="dialog" aria-labelledby="noticiaModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="noticiaModalTitulo">Actualizar Noticia</h5>
            <h5 class="modal-title" v-show="!esEditar" id="noticiaModalTitulo">Crear Noticia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarNoticia() : crearNoticia()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input v-model="form.titulo" type="text" name="titulo" class="form-control" :class="{ 'is-invalid': form.errors.has('titulo') }" placeholder="Titulo de Noticia">
                <has-error :form="form" field="titulo"></has-error>
              </div>
              <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea v-model="form.contenido" type="text" name="contenido" class="form-control" :class="{ 'is-invalid': form.errors.has('contenido') }" placeholder="Contenido de Noticia"></textarea>
                <has-error :form="form" field="contenido"></has-error>
              </div>
              <div class="form-group">
                <label for="imagenPortada">Imagen de Portada</label>
                <input type="file" accept="image/jpg,image/png,image/jpeg,image/gif" @change="updateProfile" name="imagenPortada" class="form-control-file" :class="{ 'is-invalid': form.errors.has('imagenPortada') }" placeholder="Imagen de Portada de Noticia">
                <has-error :form="form" field="imagenPortada"></has-error>
              </div>              
              <div class="form-group">
                <label for="idTipoNoticia">Tipo de Noticia</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idTipoNoticia') }" v-model="form.idTipoNoticia"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione un Tipo de Noticia</option>
                    <option v-for="tiponoticia in desctiponoticias" :key="tiponoticia.idTipoNoticia"  v-bind:value="tiponoticia.idTipoNoticia">{{tiponoticia.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idTipoNoticia"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/tiponoticia#tipoNoticiaModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadNoticias()">
                            <i class="fas fa-redo"></i>
                          </button>
                  </div>
                </div>
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
      options: {
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'far fa-times-circle'
          },
          format: 'YYYY-MM-DD HH:mm:ss',
          useCurrent: false,
          locale: 'es',
        },
      esEditar: false,
      noticias: {},
      tiponoticias: {},
      form: new Form({
        idNoticia: "",
        titulo: "",
        contenido: "",
        imagenPortada: "",
        idTipoNoticia: "",
        fechaCreada: "",
        fechaActualizada: "",
        palabraClave: ""
      })
    };
  },
  computed: {
  desctiponoticias: function () {
    return _.orderBy(this.tiponoticias, 'idTipoNoticia', 'desc')
  }
},
  methods: {
    updateProfile(e){
        // console.log('uploading');
        let file = e.target.files[0];
        //console.log(file);
        let reader = new FileReader();
        // let vm = this;
        if(file['size'] < 2111775){
          reader.onloadend = (file) => {
            // console.log('RESULT', reader.result)
            this.form.imagenPortada = reader.result;
          }
          reader.readAsDataURL(file);
        }else{
          swal({
          type: 'error',
          title: 'Oops...',
          text: 'You are uploading a large file',
        })
      }
    },
    actualizarNoticia() {
      this.$Progress.start();
      this.form
        .put("api/noticia/" + this.form.idNoticia)
        .then(() => {
          Fire.$emit("RefrescarListadoNoticia");
          $("#noticiaModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Noticia fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Noticia no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#noticiaModal").modal("show");
    },
    editarModal(noticia) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#noticiaModal").modal("show");
      this.form.fill(noticia);
    },
    eliminarNoticia(idNoticia) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Noticia de ID: " +
          idNoticia +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Noticia!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/noticia/" + idNoticia)
            .then(() => {
              Fire.$emit("RefrescarListadoNoticia");
              toast({
                type: "success",
                title: "¡El Noticia fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Noticia no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarNoticia() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/noticia").then(({ data }) => (this.noticias = data));
      } else {
        axios
          .get("api/noticia/" + palabraClave)
          .then(({ data }) => (this.noticias = data));
      }
    },
    reloadNoticias() {
      Fire.$emit("RefrescarListadoNoticia");
    },
    loadNoticias() {
      if(this.$gate.esAdmin() || this.$gate.esAutor()){
      axios
        .get("api/noticia")
        .then(
          ({ data }) => (
            (this.noticias = data.Noticias),
            (this.tiponoticias = data.TipoNoticias)
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
                    title: "Listado de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Noticias",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Noticias",
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
                  targets: 7
                }
              ]
            });
          });
        });
      }
    },
    crearNoticia() {
      this.$Progress.start();
      this.form
        .post("api/noticia")
        .then(() => {
          Fire.$emit("RefrescarListadoNoticia");
          $("#noticiaModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Noticia fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Noticia no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadNoticias();
    Fire.$on("RefrescarListadoNoticia", () => {
      table.destroy();
      this.loadNoticias();
    });
    this.$Progress.finish();
  }
};
</script>