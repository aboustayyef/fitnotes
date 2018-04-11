
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
    	fnData: {},
    },
    methods:{
        clearStorage(){
            console.log('local storage is being cleared');
            window.localStorage.clear();
        }
    },
    mounted(){
        // check if offline data exists
        let offlineData = window.localStorage.getItem('fnData');
        
        // if offline data does exist, use it as base for app
        if (! offlineData === null ) {
            this.fnData = offlineData;
        } else {
            // if no offline data exists, check to see if data has just been imported
            axios.get('/fnData')
                .then(data => {
                this.fnData = data.data;
                // if data was imported, add to local storage
            	window.localStorage.setItem('fnData', JSON.stringify(this.fnData));
            });   
        }
        
    	// this.fnData = window.localStorage.getItem('fnData');
    }
});
