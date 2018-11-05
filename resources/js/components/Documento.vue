<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esAutor()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Documentos</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Documentos</li>
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
                <h3 class="card-title">Listado de Documentos</h3>
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
                        <th>Tipo de Documento</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="documento in documentos" :key="documento.idDocumento">
                        <td>{{documento.idDocumento}}</td>
                        <td>{{documento.nombre}}</td>
                        <td>{{documento.descripcion}}</td>
                        <td>{{documento.ubicacion}}</td>
                        <td>{{documento.TipoDocumento}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(documento)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarDocumento(documento.idDocumento)">
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
    <div class="modal fade" id="documentoModal" tabindex="-1" role="dialog" aria-labelledby="documentoModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="documentoModalTitulo">Actualizar Documento</h5>
            <h5 class="modal-title" v-show="!esEditar" id="documentoModalTitulo">Crear Documento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarDocumento() : crearDocumento()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Documento">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Documento"></textarea>
                <has-error :form="form" field="descripcion"></has-error>
              </div>
              <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input v-model="form.ubicacion" type="text" name="ubicacion" class="form-control" :class="{ 'is-invalid': form.errors.has('ubicacion') }" placeholder="Ubicación de Documento">
                <has-error :form="form" field="ubicacion"></has-error>
              </div>

              
              <div class="form-group">
                <label for="idTipoDocumento">Tipo de Documento</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idTipoDocumento') }" v-model="form.idTipoDocumento"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione un Tipo de Documento</option>
                    <option v-for="tipodocumento in desctipodocumentos" :key="tipodocumento.idTipoDocumento"  v-bind:value="tipodocumento.idTipoDocumento">{{tipodocumento.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idTipoDocumento"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/tipodocumento#tipoDocumentoModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadDocumentos()">
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
      documentos: {},
      tipodocumentos: {},
      form: new Form({
        idDocumento: "",
        nombre: "",
        descripcion: "",
        ubicacion: "",
        idTipoDocumento: "",
        palabraClave: ""
      })
    };
  },
  computed: {
  desctipodocumentos: function () {
    return _.orderBy(this.tipodocumentos, 'idTipoDocumento', 'desc')
  }
},
  methods: {
    actualizarDocumento() {
      this.$Progress.start();
      this.form
        .put("api/documento/" + this.form.idDocumento)
        .then(() => {
          Fire.$emit("RefrescarListadoDocumento");
          $("#documentoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Documento fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Documento no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#documentoModal").modal("show");
    },
    editarModal(documento) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#documentoModal").modal("show");
      this.form.fill(documento);
    },
    eliminarDocumento(idDocumento) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Documento de ID: " +
          idDocumento +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Documento!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/documento/" + idDocumento)
            .then(() => {
              Fire.$emit("RefrescarListadoDocumento");
              toast({
                type: "success",
                title: "¡El Documento fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Documento no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarDocumento() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/documento").then(({ data }) => (this.documentos = data));
      } else {
        axios
          .get("api/documento/" + palabraClave)
          .then(({ data }) => (this.documentos = data));
      }
    },
    reloadDocumentos() {
      Fire.$emit("RefrescarListadoDocumento");
    },
    loadDocumentos() {
      if(this.$gate.esAdmin() || this.$gate.esAutor()){
      axios
        .get("api/documento")
        .then(
          ({ data }) => (
            (this.documentos = data.Documentos),
            (this.tipodocumentos = data.TipoDocumentos)
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
                    title: "Listado de Documentos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Documentos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Documentos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Documentos",
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
                  targets: 5
                }
              ]
            });
          });
        });
      }
    },
    crearDocumento() {
      this.$Progress.start();
      this.form
        .post("api/documento")
        .then(() => {
          Fire.$emit("RefrescarListadoDocumento");
          $("#documentoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Documento fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Documento no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadDocumentos();
    Fire.$on("RefrescarListadoDocumento", () => {
      table.destroy();
      this.loadDocumentos();
    });
    this.$Progress.finish();
  }
};
</script>