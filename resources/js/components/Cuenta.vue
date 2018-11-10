<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 230px !important;
}
.widget-user .card-footer{
    padding: 0;
}
.widget-user .widget-user-image{
    top: 70px;
}
</style>

<template>
  <!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mi Cuenta</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Mi Cuenta</li>
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
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-color: #343a40;">
                <h3 class="widget-user-username">{{this.form.username}}</h3>
                <h5 class="widget-user-desc">{{this.usuario.nombre+" "+this.usuario.appat+" "+ (this.usuario.apmat? this.usuario.apmat : "") }}<br>{{this.usuario.run}} </h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="description-block">
                      <h5 class="description-header">Cuenta de Usuario</h5>
                      <span class="description-text">{{this.usuario.nombre+" "+this.usuario.appat+" "+ (this.usuario.apmat? this.usuario.apmat : "") }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <!--
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <! /.description-block -->
                  <!--</div>
                  -->
                  <!-- /.col -->
                  <!--
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <! /.description-block -->
                  <!--</div>
                  -->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Configuracion</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.username" class="form-control" id="inputUsername" placeholder="Username" :class="{ 'is-invalid': form.errors.has('username') }">
                                     <has-error :form="form" field="username"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                     <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="col-sm-2 control-label">Foto de Usuario</label>
                                    <div class="col-sm-12">
                                        <input type="file" accept="image/jpg,image/png,image/jpeg,image/gif" @change="updateProfile" name="foto" class="form-input">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label">Clave Nueva</label>

                                    <div class="col-sm-12">
                                    <input type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Clave Nueva"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                </form>
                    
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
          </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
  </div>
</template>

<script>
    export default {
        data(){
            return {
              usuario: {
                run: '',
                nombre: '',
                appat: '',
                apmat: ''
              },
              user: {},
                 form: new Form({
                    idUsuario: '',
                    idAcceso: '',
                    username: '',
                    email: '',
                    email_verified_at: '',
                    fechaCaducidad: '',
                    estadoInicial: '',
                    estadoAcceso: '',
                    diasClave: '',
                    password: '',
                    foto: ''
                })
            }
        },
        methods:{
            getProfilePhoto(){
              if(this.form.foto.length){
              let foto = (this.form.foto.length > 200) ? this.form.foto : "img/usuarios/"+ this.form.foto ;
              return foto;
              }
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/cuenta')
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                // console.log('uploading');
                    let file = e.target.files[0];
                  //  console.log(file);
                    let reader = new FileReader();
                    // let vm = this;
                    if(file['size'] < 2111775){
                        reader.onloadend = (file) => {
                            // console.log('RESULT', reader.result)
                            this.form.foto = reader.result;
                        }
                        reader.readAsDataURL(file);
                    }else{
                         swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'You are uploading a large file',
                        })
                    }
            }
        },
        created() {
            axios.get("api/cuenta")
            .then(({ data }) => (
              (this.form.fill(data.user)),
              (this.user = data.user),
              (this.usuario = data.usuario)));
        }
    }
</script>