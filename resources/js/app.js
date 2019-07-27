/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

let baseUrl = 'http://localhost:8000/api/';
window.baseUrl = baseUrl;

// +++++++++++++++++++++++++++++++++++++++
// import vue-progressbar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '4px'
})
// +++++++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++++++++++++++
// import vue-router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
// +++++++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++++++++++++++
// import SweetAlert
import Swal from 'sweetalert2'
window.Swal = Swal;
// make a toaster notification available app-wide
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.Toast = Toast;
// +++++++++++++++++++++++++++++++++++++++

// +++++++++++
// import vform for error handling in forms
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
// +++++++++++

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
let routes = [
  { path: '/beerstyles', name:'BeerStyles', component: require('./components/BeerStylesComponent.vue').default },
  { path: '/beerstyle', name:'AddBeerStyle', component: require('./components/BeerStyleComponent.vue').default },
  { path: '/beerstyle/:id', name:'UpdateBeerStyle', component: require('./components/BeerStyleComponent.vue').default },
  { path: '/beers', name:'Beers', component: require('./components/BeersComponent.vue').default },
  { path: '/beer', name:'AddBeer', component: require('./components/BeerComponent.vue').default },
  { path: '/beer/:id', name:'UpdateBeer', component: require('./components/BeerComponent.vue').default },
  { path: '/breweries', name:'Breweries', component: require('./components/BreweriesComponent.vue').default },
  { path: '/brewery', name:'AddBrewery', component: require('./components/BreweryComponent.vue').default },
  { path: '/brewery/:id', name:'UpdateBrewery', component: require('./components/BreweryComponent.vue').default },
  { path: '/events', name:'Events', component: require('./components/EventsComponent.vue').default },
  { path: '/event', name:'AddEvent', component: require('./components/EventComponent.vue').default },
  { path: '/event/:id', name:'UpdateEvent', component: require('./components/EventComponent.vue').default },
  { path: '/glossaries', name:'Glossaries', component: require('./components/GlossariesComponent.vue').default },
  { path: '/glossary', name:'AddGlossaryItem', component: require('./components/GlossaryComponent.vue').default },
  { path: '/glossary/:id', name:'UpdateGlossaryItem', component: require('./components/GlossaryComponent.vue').default },
  { path: '/spirits', name:'Spirits', component: require('./components/SpiritsComponent.vue').default },
  { path: '/spirit', name:'AddSpirit', component: require('./components/SpiritComponent.vue').default },
  { path: '/spirit/:id', name:'EditSpirit', component: require('./components/SpiritComponent.vue').default }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
  router
}).$mount('#app')
