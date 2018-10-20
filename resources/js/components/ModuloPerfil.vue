<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignador de Módulos de Perfil</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">MódulosdePerfil</li>
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
                <h3 class="card-title text-center">Seleccion de Perfil</h3>
                <select class="form-control" v-model="form.idPerfil" v-on:change="changesel">
                  <option disabled value="">Seleccione un Perfil</option>
                  <option v-for="perfil in perfiles" :key="perfil.idPerfil"  v-bind:value="perfil.idPerfil">{{perfil.nombre}}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Módulos sin el Perfil</h3>
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
                      <tr v-for="modulosinperfil in modulossinperfil" :key="modulosinperfil.idModulo">
                        <td>{{modulosinperfil.idModulo}}</td>
                        <td>{{modulosinperfil.nombre}}</td>
                        <td role="text-center">
                           <input type="hidden" v-model="form.idModulo"> 
                            <button v-if="!form.idPerfil == ''" type="submit" style="width:100%" class="btn btn-link" @click="asignar(modulosinperfil)">
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
                <h3 class="card-title">Listado de Módulos con el Perfil</h3>
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
                      <tr v-for="modulodeperfil in modulosdeperfil" :key="modulodeperfil.idModulo">
                        <td role="text-center">
                            <input type="hidden" v-model="form.idModulo"> 
                            <button type="submit" style="width:100%" class="btn btn-link" @click="desasignar(modulodeperfil)">
                              <i class="fas fa-arrow-left"></i>
                            </button>
                        </td>
                        <td>{{modulodeperfil.idModulo}}</td>
                        <td>{{modulodeperfil.nombre}}</td>
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
      perfiles: {},
      modulossinperfil: {},
      modulosdeperfil: {},
      form: new Form({
        idPerfilModulo: "",
        idPerfil: "",
        idModulo: ""
      })
    };
  },
  methods: {
    asignar(modulosinperfil) {
      this.form.idModulo = modulosinperfil.idModulo;
      if (this.form.idPerfil == "") {
        toast({
          type: "warning",
          title: "¡Debe Selecionar el Perfil!"
        });
      } else {
        this.$Progress.start();
        this.form
          .post("api/moduloperfil")
          .then(() => {
            Fire.$emit("RefrescarListadoSinCon");
            toast({
              type: "success",
              title: "¡El Módulo fue Asignado al Perfil con Exito!"
            });
            this.$Progress.finish();
          })
          .catch(() => {
            toast({
              type: "warning",
              title: "¡El Módulo no pudo ser Asignado al Perfil con Exito!"
            });
            this.$Progress.fail();
          });
      }
    },
    desasignar(modulodeperfil) {
      this.form.idModulo = modulodeperfil.idModulo;
      this.$Progress.start();
      this.form
        .put("api/moduloperfil/" + modulodeperfil.idModulo)
        .then(() => {
          Fire.$emit("RefrescarListadoSinCon");
          toast({
            type: "success",
            title: "¡El Módulo fue Desasignado del Perfil con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Módulo no pudo ser Desasignado del Perfil con Exito!"
          });
          this.$Progress.fail();
        });
    },
    changesel() {
      Fire.$emit("RefrescarListadoSinCon");
    },
    loadModulos() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/moduloperfil")
        .then(
          ({ data }) => (
            (this.perfiles = data.Perfiles),
            (this.modulossinperfil = data.ModulosSinPerfil),
            (this.modulosdeperfil = data.ModulosDePerfil)
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
    loadModulos2() {
      axios
        .get("api/moduloperfil/" + this.form.idPerfil)
        .then(
          ({ data }) => (
            (this.perfiles = data.Perfiles),
            (this.modulossinperfil = data.ModulosSinPerfil),
            (this.modulosdeperfil = data.ModulosDePerfil)
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
    this.loadModulos();
    Fire.$on("RefrescarListadoSinCon", () => {
      tableSin.destroy();
      tableCon.destroy();
      this.loadModulos2();
    });
    this.$Progress.finish();
  }
};
</script>