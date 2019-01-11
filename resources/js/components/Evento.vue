<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin() || $gate.esOrganizador()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Eventos</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Eventos</li>
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
                <h3 class="card-title">Listado de Eventos</h3>
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
                        <th>Fecha Inicio</th>
                        <th>Fecha Termino</th>
                        <th>Tipo de Evento</th>
                        <th>Sede</th>
                        <th>Area</th>
                        <th>Expositor</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="evento in eventos" :key="evento.idEvento">
                        <td>{{evento.idEvento}}</td>
                        <td>{{evento.nombre}}</td>
                        <td>{{evento.descripcion}}</td>
                        <td>{{evento.fechaInicio | myDate}}</td>
                        <td>{{evento.fechaTermino | myDate}}</td>
                        <td>{{evento.tipoevento.nombre}}</td>
                        <td>{{evento.sede.nombre}}</td>
                        <td>{{evento.area.nombre}}</td>
                        <td>{{evento.expositor.nombre}} {{evento.expositor.appat}} {{evento.expositor.apmat}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(evento)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarEvento(evento.idEvento, evento.nombre)">
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
    <div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="eventoModalTitulo">Actualizar Evento</h5>
            <h5 class="modal-title" v-show="!esEditar" id="eventoModalTitulo">Crear Evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarEvento() : crearEvento()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Evento">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="form.descripcion" type="text" name="descripcion" class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }" placeholder="Descripción de Evento"></textarea>
                <has-error :form="form" field="descripcion"></has-error>
              </div>
              <div class="form-group">
                <label for="fechaInicio">Fecha de Inicio</label>
                <date-picker id='dtpInicio' v-model="form.fechaInicio" type="text" :config="options" name="fechaInicio" class="form-control" :class="{ 'is-invalid': form.errors.has('fechaInicio') }" placeholder="Fecha de Inicio de Evento"></date-picker>
                <has-error :form="form" field="fechaInicio"></has-error>
              </div>
              <div class="form-group">
                <label for="fechaTermino">Fecha de Termino</label>
              <date-picker id='dtpTermino' v-model="form.fechaTermino" :config="options" :class="{ 'is-invalid': form.errors.has('fechaTermino') }" placeholder="Fecha de Termino de Evento"></date-picker>
                <has-error :form="form" field="fechaTermino"></has-error>
              </div>
              
              <div class="form-group">
                <label for="idTipoEvento">Tipo de Evento</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idTipoEvento') }" v-model="form.idTipoEvento"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione un Tipo de Evento</option>
                    <option v-for="tipoevento in desctipoeventos" :key="tipoevento.idTipoEvento"  v-bind:value="tipoevento.idTipoEvento">{{tipoevento.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idTipoEvento"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/tipoevento#tipoEventoModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadEventos()">
                            <i class="fas fa-redo"></i>
                          </button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="idSede">Sede</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idSede') }" v-model="form.idSede"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione una Sede</option>
                    <option v-for="sede in descsedes" :key="sede.idSede"  v-bind:value="sede.idSede">{{sede.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idSede"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/sede#sedeModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadEventos()">
                            <i class="fas fa-redo"></i>
                          </button>
                          </div>
              </div>
              
              </div>
              <div class="form-group">
                <label for="idArea">Area</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idArea') }" v-model="form.idArea"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione una Area</option>
                    <option v-for="area in descareas" :key="area.idArea"  v-bind:value="area.idArea">{{area.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idArea"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/area#areaModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadEventos()">
                            <i class="fas fa-redo"></i>
                          </button>
                          </div>
              </div>
              </div>
              <div class="form-group">
                <label for="idExpositor">Expositor</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idExpositor') }" v-model="form.idExpositor"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione un Expositor</option>
                    <option v-for="expositor in descexpositores" :key="expositor.idExpositor"  v-bind:value="expositor.idExpositor">{{expositor.nombre+" "+expositor.appat+" "+ (expositor.apmat? expositor.apmat : "") }}</option>
                  </select>
                  <has-error :form="form" field="idExpositor"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/expositor#expositorModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadEventos()">
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
  <unauthorized v-if="(!$gate.esAdmin() && !$gate.esOrganizador()) || (!$gate.esOrganizador() && $gate.esAdmin()) && ($gate.esOrganizador() && !$gate.esAdmin())"></unauthorized>
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
      eventos: {},
      tipoeventos: {},
      sedes: {},
      areas: {},
      expositores: {},
      form: new Form({
        idEvento: "",
        nombre: "",
        descripcion: "",
        fechaInicio: "",
        fechaTermino: "",
        idTipoEvento: "",
        idSede: "",
        idArea: "",
        idExpositor: "",
        palabraClave: ""
      })
    };
  },
  computed: {
  desctipoeventos: function () {
    return _.orderBy(this.tipoeventos, 'idTipoEvento', 'desc')
  },
  descsedes: function () {
    return _.orderBy(this.sedes, 'idSede', 'desc')
  },
  descareas: function () {
    return _.orderBy(this.areas, 'idArea', 'desc')
  },
  descexpositores: function () {
    return _.orderBy(this.expositores, 'idExpositor', 'desc')
  }
},
  methods: {
    actualizarEvento() {
      this.$Progress.start();
      this.form
        .put("api/evento/" + this.form.idEvento)
        .then(() => {
          Fire.$emit("RefrescarListadoEvento");
          $("#eventoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Evento fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Evento no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#eventoModal").modal("show");
    },
    editarModal(evento) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#eventoModal").modal("show");
      this.form.fill(evento);
    },
    eliminarEvento(idEvento, nombre) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Evento " +
          nombre +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Evento!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/evento/" + idEvento)
            .then(() => {
              Fire.$emit("RefrescarListadoEvento");
              toast({
                type: "success",
                title: "¡El Evento fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Evento no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarEvento() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/evento").then(({ data }) => (this.eventos = data));
      } else {
        axios
          .get("api/evento/" + palabraClave)
          .then(({ data }) => (this.eventos = data));
      }
    },
    reloadEventos() {
      Fire.$emit("RefrescarListadoEvento");
    },
    loadEventos() {
      if(this.$gate.esAdmin() || this.$gate.esOrganizador()){
      axios
        .get("api/evento")
        .then(
          ({ data }) => (
            (this.eventos = data.Eventos),
            (this.tipoeventos = data.TipoEventos),
            (this.sedes = data.Sedes),
            (this.areas = data.Areas),
            (this.expositores = data.Expositores)
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
                    title: "Listado de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Eventos",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Eventos",
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
                  targets: 9
                }
              ]
            });
          });
        });
      }
    },
    crearEvento() {
      this.$Progress.start();
      this.form
        .post("api/evento")
        .then(() => {
          Fire.$emit("RefrescarListadoEvento");
          $("#eventoModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Evento fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Evento no pudo ser Ingresado con Exito!"
          });
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.$Progress.start();
    $(function () {
        $('#dtpInicio').datetimepicker();
        $('#dtpTermino').datetimepicker();
        $("#dtpInicio").on("dp.change", function (e) {
            $('#dtpTermino').data("DateTimePicker").minDate(e.date);
        });
        $("#dtpTermino").on("dp.change", function (e) {
            $('#dtpInicio').data("DateTimePicker").maxDate(e.date);
        });
    });
    this.loadEventos();
    Fire.$on("RefrescarListadoEvento", () => {
      table.destroy();
      this.loadEventos();
    });
    this.$Progress.finish();
  }
};
</script>