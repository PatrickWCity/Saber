const esp = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	},
    "buttons": {
        "copy": 'Copiar',
        "csv": 'CSV',
        "excel": 'Excel',
        "pdf": 'PDF',
        "print": 'Imprimir',
        copyTitle: 'Copiado al portapapeles',
        copyKeys: 'Presione <i>ctrl</i> o <i>\u2318</i> + <i>C</i> para copiar los datos de la tabla<br>a su sistema de portapapeles.<br><br>Para cancelar, haga clic en este mensaje o presione escape.',
        copySuccess: {
            _: '%d líneas copiadas',
            1: '1 línea copiada'
        }
    }
}
window.esp = esp;

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';

import { Form, HasError, AlertError } from 'vform'

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// ES6 Modules or TypeScript
import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
window.toast = toast;

window.Form = Form;

import datePicker from 'vue-bootstrap-datetimepicker';
Vue.use(datePicker);

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.filter('myDate', function(created){
    moment.locale('es');
    return moment(created).format('LLLL');
})

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    thickness: '4px'
  })

let routes = [
    { path: '/home', component: require('./components/Dashboard.vue') },
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/cuenta', component: require('./components/Cuenta.vue') },
    { path: '/desarrollador', component: require('./components/Desarrollador.vue') },
    { path: '/usuario', component: require('./components/Usuario.vue') },
    { path: '/perfil', component: require('./components/Perfil.vue') },
    { path: '/submodulo', component: require('./components/Submodulo.vue') },
    { path: '/modulo', component: require('./components/Modulo.vue') },
    { path: '/perfilusuario', component: require('./components/PerfilUsuario.vue') },
    { path: '/moduloperfil', component: require('./components/ModuloPerfil.vue') },
    { path: '/submodulomodulo', component: require('./components/SubmoduloModulo.vue') },
    { path: '/documento', component: require('./components/Documento.vue') },
    { path: '/tipodocumento', component: require('./components/TipoDocumento.vue') },
    { path: '/noticia', component: require('./components/Noticia.vue') },
    { path: '/tiponoticia', component: require('./components/TipoNoticia.vue') },
    { path: '/evento', component: require('./components/Evento.vue') },
    { path: '/tipoevento', component: require('./components/TipoEvento.vue') },
    { path: '/habilitarusuario', component: require('./components/HabilitarUsuario.vue') },
    { path: '/deshabilitarusuario', component: require('./components/DeshabilitarUsuario.vue') },
    { path: '/usuariopendiente', component: require('./components/UsuarioPendiente.vue') },
    { path: '/voluntario', component: require('./components/Voluntario.vue') },
    { path: '/sede', component: require('./components/Sede.vue') },
    { path: '/area', component: require('./components/Area.vue') },
    { path: '/expositor', component: require('./components/Expositor.vue') },
    { path: '/tipovoluntario', component: require('./components/TipoVoluntario.vue') },
    { path: '/403', component: require('./components/Unauthorized.vue') },
    { path: '/404', component: require('./components/NotFound.vue') },
    { path: '/500', component: require('./components/Error.vue') },
    { path: '/503', component: require('./components/Maintenance.vue') }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

window.Fire = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'unauthorized',
    require('./components/Unauthorized.vue')
);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    // define methods under the `methods` object
    methods: {
        subIsActive(input) {
            const paths = Array.isArray(input) ? input : [input]
            return paths.some(path => {
                return this.$route.path.localeCompare(path) === 0// Compares two strings in the current locale
            })
        }
      }
});
