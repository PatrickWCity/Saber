<template>
<div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" v-if="$gate.esAdmin()">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignador de Perfiles de Usuario</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">PerfilesdeUsuario</li>
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
                <select class="form-control" v-model="form.idPerfil" v-on:change="changesel"> <!-- @change="asignar2()"> v-model="form.idPerfil" v-on:change="form.idPerfil" -->
                  <option disabled value="">Seleccione un Perfil</option>
                  <option v-for="perfil in perfiles" :key="perfil.idPerfil"  v-bind:value="perfil.idPerfil">{{perfil.nombre}}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Usuarios sin el Perfil</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="listadoSin" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="usuariosinperfil in usuariossinperfil" :key="usuariosinperfil.idUsuario">
                        <td>{{usuariosinperfil.idUsuario}}</td>
                        <td>{{usuariosinperfil.nombre}}</td>
                        <td>{{usuariosinperfil.appat}}</td>
                        <td>{{usuariosinperfil.apmat}}</td>
                        <td role="text-center">
                           <input type="hidden" v-model="form.idUsuario"> 
                            <button v-if="!form.idPerfil == ''" type="submit" style="width:100%" class="btn btn-link" @click="asignar(usuariosinperfil)">
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
                <h3 class="card-title">Listado de Usuarios con el Perfil</h3>
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
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="usuariodeperfil in usuariosdeperfil" :key="usuariodeperfil.idUsuario">
                        <td role="text-center">
                            <input type="hidden" v-model="form.idUsuario"> 
                            <button type="submit" style="width:100%" class="btn btn-link" @click="desasignar(usuariodeperfil)">
                              <i class="fas fa-arrow-left"></i>
                            </button>
                        </td>
                        <td>{{usuariodeperfil.idUsuario}}</td>
                        <td>{{usuariodeperfil.nombre}}</td>
                        <td>{{usuariodeperfil.appat}}</td>
                        <td>{{usuariodeperfil.apmat}}</td>
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
      usuariossinperfil: {},
      usuariosdeperfil: {},
      form: new Form({
        idPerfilUsuario: "",
        idPerfil: "",
        idUsuario: ""
      })
    };
  },
  methods: {
    asignar(usuariosinperfil) {
      this.form.idUsuario = usuariosinperfil.idUsuario;
      if (this.form.idPerfil == "") {
        toast({
          type: "warning",
          title: "¡Debe Selecionar el Perfil!"
        });
      } else {
        this.$Progress.start();
        this.form
          .post("api/perfilusuario")
          .then(() => {
            Fire.$emit("RefrescarListadoSinCon");
            toast({
              type: "success",
              title: "¡El Usuario fue Asignado al Perfil con Exito!"
            });
            this.$Progress.finish();
          })
          .catch(() => {
            toast({
              type: "warning",
              title: "¡El Usuario no pudo ser Asignado al Perfil con Exito!"
            });
            this.$Progress.fail();
          });
      }
    },
    desasignar(usuariodeperfil) {
      this.form.idUsuario = usuariodeperfil.idUsuario;
      this.$Progress.start();
      this.form
        .put("api/perfilusuario/" + usuariodeperfil.idUsuario)
        .then(() => {
          Fire.$emit("RefrescarListadoSinCon");
          toast({
            type: "success",
            title: "¡El Usuario fue Desasignado del Perfil con Exito!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "¡El Usuario no pudo ser Desasignado del Perfil con Exito!"
          });
          this.$Progress.fail();
        });
    },
    changesel() {
      Fire.$emit("RefrescarListadoSinCon");
    },
    loadUsuarios() {
      if(this.$gate.esAdmin()){
      axios
        .get("api/perfilusuario")
        .then(
          ({ data }) => (
            (this.perfiles = data.Perfiles),
            (this.usuariossinperfil = data.UsuariosSinPerfil),
            (this.usuariosdeperfil = data.UsuariosDePerfil)
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
                  targets: 4
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
    loadUsuarios2() {
      axios
        .get("api/perfilusuario/" + this.form.idPerfil)
        .then(
          ({ data }) => (
            (this.perfiles = data.Perfiles),
            (this.usuariossinperfil = data.UsuariosSinPerfil),
            (this.usuariosdeperfil = data.UsuariosDePerfil)
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
                  targets: 4
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
    this.loadUsuarios();
    Fire.$on("RefrescarListadoSinCon", () => {
      tableSin.destroy();
      tableCon.destroy();
      this.loadUsuarios2();
    });
    this.$Progress.finish();
  }
};
</script>