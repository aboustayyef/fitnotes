
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Datepicker from 'vuejs-datepicker';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('fitnotes-viewer', require('./components/FitnotesViewer.vue'));
Vue.component('datepicker', Datepicker);

const app = new Vue({
    el: '#app',
    data: {
    	fnData: {}
    },
    mounted(){
    	axios.get('/fnData')
    	.then(data => {
    		this.fnData = data.data;
    	});
    	// window.localStorage.setItem('fnData', JSON.stringify({"success":true}));
    	// this.fnData = window.localStorage.getItem('fnData');
    }
});
