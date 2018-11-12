<template>
  <!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
      <div class="container-fluid" v-if="$gate.esAdmin() || $gate.esOrganizador()">
        <h4 class="mb-2">Seccion de Eventos</h4>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{eventos}}</h3>

                <p>Eventos</p>
              </div>
              <div class="icon">
                <i class="far fa-calendar-check"></i>
              </div>
              <router-link to="/evento" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{tipoeventos}}</h3>

                <p>Tipo de Eventos</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar"></i>
              </div>
              <router-link to="/tipoevento" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{areas}}</h3>

                <p>Areas</p>
              </div>
              <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <router-link to="/area" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{sedes}}</h3>

                <p>Sedes</p>
              </div>
              <div class="icon">
                <i class="fas fa-building"></i>
              </div>
              <router-link to="/sede" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
          <!-- ./col -->
        </div>
        <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{expositores}}</h3>

                <p>Expositores</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <router-link to="/expositor" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <div class="container-fluid" v-if="$gate.esAdmin() || $gate.esAutor()">
        <h4 class="mb-2">Seccion de Noticias</h4>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{noticias}}</h3>

                <p>Noticias</p>
              </div>
              <div class="icon">
                <i class="far fa-newspaper"></i>
              </div>
              <router-link to="/noticia" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{tiponoticias}}</h3>

                <p>Tipo de Noticias</p>
              </div>
              <div class="icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <router-link to="/tiponoticia" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
        <div class="container-fluid" v-if="$gate.esAdmin() || $gate.esDocumentalista()">
        <h4 class="mb-2">Seccion de Documentos</h4>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{documentos}}</h3>

                <p>Documentos</p>
              </div>
              <div class="icon">
                <i class="far fa-file-alt"></i>
              </div>
              <router-link to="/documento" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{tipodocumentos}}</h3>

                <p>Tipo de Documentos</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <router-link to="/tipodocumento" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
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
  data() {
    return {
      eventos: 0,
      tipoeventos: 0,
      sedes: 0,
      areas: 0,
      expositores: 0,
      noticias: 0,
      tiponoticias: 0,
      documentos: 0,
      tipodocumentos: 0
    };
  },
  methods: {
    loadEventos() {
      if(this.$gate.esAdmin() || this.$gate.esOrganizador()){
      axios
        .get("api/dashboard")
        .then(
          ({ data }) => (
            (this.eventos = data.Eventos),
            (this.tipoeventos = data.TipoEventos),
            (this.sedes = data.Sedes),
            (this.areas = data.Areas),
            (this.expositores = data.Expositores),
            (this.noticias = data.Noticias),
            (this.tiponoticias = data.TipoNoticias),
            (this.documentos = data.Documentos),
            (this.tipodocumentos = data.TipoDocumentos)
          )
        )
      }
    },
  },
  created() {
    this.$Progress.start();
    this.loadEventos();
    this.$Progress.finish();
  }
};
</script>