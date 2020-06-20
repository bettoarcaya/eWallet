/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

import Vue from 'vue';
import Axios from 'axios';
import App from './views/App.vue';
import Client from './views/Client.vue';
import ClientForm from './components/ClientForm.vue';

Vue.prototype.$http = Axios;
new Vue({
    el: '#app',
    components: {App, Client, ClientForm}
})
