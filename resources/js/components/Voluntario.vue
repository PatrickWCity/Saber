<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Voluntarios</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Voluntarios</li>
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
                <h3 class="card-title">Listado de Voluntarios</h3>
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
                        <th>Dirrecion</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Tipo de Voluntario</th>
                        <th>Profesion</th>
                        <th class="text-center">Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="voluntario in voluntarios" :key="voluntario.idVoluntario">
                        <td>{{voluntario.idVoluntario}}</td>
                        <td>{{voluntario.run}}</td>
                        <td>{{voluntario.nombre}}</td>
                        <td>{{voluntario.appat}}</td>
                        <td>{{voluntario.apmat}}</td>
                        <td>{{voluntario.direccion}}</td>
                        <td>{{voluntario.telefono}}</td>
                        <td>{{voluntario.email}}</td>
                        <td>{{voluntario.TipoVoluntario}}</td>
                        <td>{{voluntario.Profesion}}</td>
                        <td role="text-center">
                          <div class="btn-group" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" @click="editarModal(voluntario)">
                            <i class="fas fa-edit"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="eliminarVoluntario(voluntario.idVoluntario, voluntario.nombre+' '+voluntario.appat+' '+voluntario.apmat)">
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
    <div class="modal fade" id="voluntarioModal" tabindex="-1" role="dialog" aria-labelledby="voluntarioModalTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="esEditar" id="voluntarioModalTitulo">Actualizar Voluntario</h5>
            <h5 class="modal-title" v-show="!esEditar" id="voluntarioModalTitulo">Crear Voluntario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="esEditar ? actualizarVoluntario() : crearVoluntario()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label for="run">RUN</label>
                <input v-model="form.run" type="text" name="run" class="form-control" :class="{ 'is-invalid': form.errors.has('run') }" placeholder="RUN de Voluntario">
                <has-error :form="form" field="run"></has-error>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" type="text" name="nombre" class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }" placeholder="Nombre de Voluntario">
                <has-error :form="form" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label for="appat">Apellido Paterno</label>
                <input v-model="form.appat" type="text" name="appat" class="form-control" :class="{ 'is-invalid': form.errors.has('appat') }" placeholder="Apellido Paterno de Voluntario">
                <has-error :form="form" field="appat"></has-error>
              </div>
              <div class="form-group">
                <label for="apmat">Apellido Materno</label>
                <input v-model="form.apmat" type="text" name="apmat" class="form-control" :class="{ 'is-invalid': form.errors.has('apmat') }" placeholder="Apellido Materno de Voluntario">
                <has-error :form="form" field="apmat"></has-error>
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input v-model="form.direccion" type="text" name="direccion" class="form-control" :class="{ 'is-invalid': form.errors.has('direccion') }" placeholder="Dirección de Voluntario">
                <has-error :form="form" field="direccion"></has-error>
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input v-model="form.telefono" type="text" name="telefono" class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }" placeholder="Teléfono de Voluntario">
                <has-error :form="form" field="telefono"></has-error>
              </div>
              <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input v-model="form.email" type="email" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Correo Electrónico de Voluntario">
                <has-error :form="form" field="email"></has-error>
              </div>
              
              <div class="form-group">
                <label for="idTipoVoluntario">Tipo de Voluntario</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idTipoVoluntario') }" v-model="form.idTipoVoluntario"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione un Tipo de Voluntario</option>
                    <option v-for="tipovoluntario in desctipovoluntarios" :key="tipovoluntario.idTipoVoluntario"  v-bind:value="tipovoluntario.idTipoVoluntario">{{tipovoluntario.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idTipoVoluntario"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/tipovoluntario#tipoVoluntarioModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadVoluntarios()">
                            <i class="fas fa-redo"></i>
                          </button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="idProfesion">Profesion</label>
                <div class="form-row">
                <select class="form-control col-lg-11" :class="{ 'is-invalid': form.errors.has('idProfesion') }" v-model="form.idProfesion"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                    <option disabled value="">Seleccione una Profesion</option>
                    <option v-for="profesion in descprofesions" :key="profesion.idProfesion"  v-bind:value="profesion.idProfesion">{{profesion.nombre}}</option>
                  </select>
                  <has-error :form="form" field="idProfesion"></has-error>
                  <div class="btn-group col-lg-1" style="width:100%">
                            <button type="button" style="width:50%" class="btn btn-link" onclick="window.open('/profesion#profesionModal')">
                            <i class="fas fa-plus"></i>
                          </button>
                            <button type="button" style="width:50%" class="btn btn-link" @click="reloadVoluntarios()">
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
  <unauthorized v-if="(!$gate.esAdmin())"></unauthorized>
</div>
</template>

<script>
var table;
export default {
  data() {
    return {
      esEditar: false,
      voluntarios: {},
      tipovoluntarios: {},
      profesions: {},
      form: new Form({
        idVoluntario: "",
        run: "",
        nombre: "",
        appat: "",
        apmat: "",
        direccion: "",
        telefono: "",
        email: "",
        idTipoVoluntario: "",
        idProfesion: "",
        palabraClave: ""
      })
    };
  },
  computed: {
  desctipovoluntarios: function () {
    return _.orderBy(this.tipovoluntarios, 'idTipoVoluntario', 'desc')
  },
  descprofesions: function () {
    return _.orderBy(this.profesions, 'idProfesion', 'desc')
  }
},
  methods: {
    actualizarVoluntario() {
      this.$Progress.start();
      this.form
        .put("api/voluntario/" + this.form.idVoluntario)
        .then(() => {
          Fire.$emit("RefrescarListadoVoluntario");
          $("#voluntarioModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Voluntario fue Actualizado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Voluntario no pudo ser Actualizado con Exito!"
          });
          this.$Progress.fail();
        });
    },
    crearModal() {
      this.esEditar = false;
      this.form.reset();
      this.form.clear();
      $("#voluntarioModal").modal("show");
    },
    editarModal(voluntario) {
      this.esEditar = true;
      this.form.reset();
      this.form.clear();
      $("#voluntarioModal").modal("show");
      this.form.fill(voluntario);
    },
    eliminarVoluntario(idVoluntario) {
      swal({
        title:
          "¿Está seguro que desea eliminar el Voluntario " +
          nombre +
          "?",
        //text: "¡No podrás revertir esta acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "¡No, Cancelar!",
        confirmButtonText: "¡Si, Eliminar Voluntario!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/voluntario/" + idVoluntario)
            .then(() => {
              Fire.$emit("RefrescarListadoVoluntario");
              toast({
                type: "success",
                title: "¡El Voluntario fue Eliminado con Exito!"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              toast({
                type: "warning",
                title: "¡El Voluntario no pudo ser Eliminado con Exito!"
              });
              this.$Progress.fail();
            });
        }
      });
    },
    buscarVoluntario() {
      if (palabraClave == null || palabraClave == "") {
        axios.get("api/voluntario").then(({ data }) => (this.voluntarios = data));
      } else {
        axios
          .get("api/voluntario/" + palabraClave)
          .then(({ data }) => (this.voluntarios = data));
      }
    },
    reloadVoluntarios() {
      Fire.$emit("RefrescarListadoVoluntario");
    },
    loadVoluntarios() {
      if(this.$gate.esAdmin() || this.$gate.esOrganizador()){
      axios
        .get("api/voluntario")
        .then(
          ({ data }) => (
            (this.voluntarios = data.Voluntarios),
            (this.tipovoluntarios = data.TipoVoluntarios),
            (this.profesions = data.Profesiones)
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
                    title: "Listado de Voluntarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "excel",
                    title: "Listado de Voluntarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "pdf",
                    title: "Listado de Voluntarios",
                    exportOptions: {
                      columns: "th:not(:last-child)"
                    }
                  },
                  {
                    extend: "print",
                    title: "Listado de Voluntarios",
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
                  targets: 10
                }
              ]
            });
          });
        });
      }
    },
    crearVoluntario() {
      this.$Progress.start();
      this.form
        .post("api/voluntario")
        .then(() => {
          Fire.$emit("RefrescarListadoVoluntario");
          $("#voluntarioModal").modal("hide");
          toast({
            type: "success",
            title: "¡El Voluntario fue Creado con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Voluntario no pudo ser Ingresado con Exito!"
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
    this.loadVoluntarios();
    Fire.$on("RefrescarListadoVoluntario", () => {
      table.destroy();
      this.loadVoluntarios();
    });
    this.$Progress.finish();
  }
};
</script>