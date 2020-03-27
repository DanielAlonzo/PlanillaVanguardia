/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';


window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import swal from 'sweetalert2'
window.swal =swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast =toast;

// //---------------------DATETIME PICKER------------------------------------
// import Datepicker from 'vuejs-datepicker';
 
// export default {
//     components: {
//         Datepicker
//     }
//     // ...
// }


import VueRouter from 'vue-router'

Vue.use(VueRouter)
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(3, 184, 27)',
  failedColor: 'red',
  height: '10px'
})
//Rutas de los componentes Vue (vistas)
let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/usuarios', component: require('./components/Usuarios.vue').default },
    { path: '/perfil', component: require('./components/Perfil.vue').default },
    { path: '/departamentos', component: require('./components/Departamentos.vue').default },
    { path: '/horarios', component: require('./components/Horarios.vue').default },
    { path: '/planilla', component: require('./components/Planilla.vue').default },
    { path: '/deducciones', component: require('./components/Deducciones.vue').default },
    { path: '/puestos', component: require('./components/Puestos.vue').default },
    { path: '/empleados', component: require('./components/Empleados.vue').default },
    { path: '/pagar', component: require('./components/Pagar.vue').default },
     { path: '/birthdaypicker', component: require('./components/datepicker.vue').default }
  ]


  const router = new VueRouter({
      mode: 'history',
    routes // short for `routes: routes`
  })


   window.Fire = new Vue(); 

   Vue.filter('myDate', function(created){
      return moment(created).format('L');
   });

 
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('birthdaypicker', require('./components/datepicker.vue'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
