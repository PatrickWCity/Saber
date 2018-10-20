<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignador de Submódulos de Módulo</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">SubmódulosdeMódulo</li>
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
              <div class="card-body bg-light">
                <h3 class="card-title text-center">Seleccion de Módulo</h3>
                <select class="form-control" v-model="form.idModulo" v-on:change="changesel">
                  <option disabled value="">Seleccione un Módulo</option>
                  <option v-for="modulo in modulos" :key="modulo.idModulo"  v-bind:value="modulo.idModulo">{{modulo.nombre}}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Submódulos sin el Módulo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="listadoSin" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="submodulosinmodulo in submodulossinmodulo" :key="submodulosinmodulo.idSubmodulo">
                        <td>{{submodulosinmodulo.idSubmodulo}}</td>
                        <td>{{submodulosinmodulo.nombre}}</td>
                        <td role="text-center">
                           <input type="hidden" v-model="form.idSubmodulo"> 
                            <button v-if="!form.idModulo == ''" type="submit" style="width:100%" class="btn btn-link" @click="asignar(submodulosinmodulo)">
                              <i class="fas fa-arrow-right"></i>
                            </button>
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
  
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Submódulos con el Módulo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="listadoCon" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Acciones</th>
                        <th>ID</th>
                        <th>Nombre</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="submodulodemodulo in submodulosdemodulo" :key="submodulodemodulo.idSubmodulo">
                        <td role="text-center">
                            <input type="hidden" v-model="form.idSubmodulo"> 
                            <button type="submit" style="width:100%" class="btn btn-link" @click="desasignar(submodulodemodulo)">
                              <i class="fas fa-arrow-left"></i>
                            </button>
                        </td>
                        <td>{{submodulodemodulo.idSubmodulo}}</td>
                        <td>{{submodulodemodulo.nombre}}</td>
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
var tableSin;
var tableCon;
export default {
  data() {
    return {
      modulos: {},
      submodulossinmodulo: {},
      submodulosdemodulo: {},
      form: new Form({
        idSubmoduloModulo: "",
        idModulo: "",
        idSubmodulo: ""
      })
    };
  },
  methods: {
    asignar(submodulosinmodulo) {
      this.form.idSubmodulo = submodulosinmodulo.idSubmodulo;
      if (this.form.idModulo == "") {
        toast({
          type: "warning",
          title: "¡Debe Selecionar el Módulo!"
        });
      } else {
        this.$Progress.start();
        this.form
          .post("api/submodulomodulo")
          .then(() => {
            Fire.$emit("RefrescarListadoSinCon");
            toast({
              type: "success",
              title: "¡El Submódulo fue Asignado al Módulo con Exito!"
            });
            this.$Progress.finish();
          })
          .catch(() => {
            toast({
              type: "warning",
              title: "¡El Submódulo no pudo ser Asignado al Módulo con Exito!"
            });
            this.$Progress.fail();
          });
      }
    },
    desasignar(submodulodemodulo) {
      this.form.idSubmodulo = submodulodemodulo.idSubmodulo;
      this.$Progress.start();
      this.form
        .put("api/submodulomodulo/" + submodulodemodulo.idSubmodulo)
        .then(() => {
          Fire.$emit("RefrescarListadoSinCon");
          toast({
            type: "success",
            title: "¡El Submódulo fue Desasignado del Módulo con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Submódulo no pudo ser Desasignado del Módulo con Exito!"
          });
          this.$Progress.fail();
        });
    },
    changesel() {
      Fire.$emit("RefrescarListadoSinCon");
    },
    loadSubmodulos() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/submodulomodulo")
        .then(
          ({ data }) => (
            (this.modulos = data.Modulos),
            (this.submodulossinmodulo = data.SubmodulosSinModulo),
            (this.submodulosdemodulo = data.SubmodulosDeModulo)
          )
        )
        .then(() => {
          $(document).ready(function() {
            tableSin = $("#listadoSin").DataTable({
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
            tableCon = $("#listadoCon").DataTable({
              destroy: true,
              language: esp,
              columnDefs: [
                {
                  searchable: false,
                  orderable: false,
                  targets: 0
                }
              ]
            });
          });
        });
      }
    },
    loadSubmodulos2() {
      axios
        .get("api/submodulomodulo/" + this.form.idModulo)
        .then(
          ({ data }) => (
            (this.modulos = data.Modulos),
            (this.submodulossinmodulo = data.SubmodulosSinModulo),
            (this.submodulosdemodulo = data.SubmodulosDeModulo)
          )
        )
        .then(() => {
          $(document).ready(function() {
            tableSin = $("#listadoSin").DataTable({
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
            tableCon = $("#listadoCon").DataTable({
              destroy: true,
              language: esp,
              columnDefs: [
                {
                  searchable: false,
                  orderable: false,
                  targets: 0
                }
              ]
            });
          });
        });
    }
  },
  created() {
    this.$Progress.start();
    this.loadSubmodulos();
    Fire.$on("RefrescarListadoSinCon", () => {
      tableSin.destroy();
      tableCon.destroy();
      this.loadSubmodulos2();
    });
    this.$Progress.finish();
  }
};
</script>