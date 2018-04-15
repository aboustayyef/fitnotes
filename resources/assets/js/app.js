
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Datepicker from 'vuejs-datepicker';
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.css';
window.moment = require('moment');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('fitnotes-viewer', require('./components/FitnotesViewer.vue'));
Vue.component('datepicker', Datepicker);
Vue.component('vue2-dropzone', vue2Dropzone);

const app = new Vue({
    el: '#app',
    data: {
        status: 'Finding Out Status...',
    	fnData: null,
        dropzoneOptions: {
          url: '/upload',
          paramName:'csv',
          headers: { "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content }
      }
    },
    mounted(){
         this.checkForNewData();
    },
    methods:{
        clearStorage(){
            console.log('local storage is being cleared');
            window.localStorage.clear();
        },
        checkForNewData(){
            // check if offline data exists
            let offlineData = window.localStorage.getItem('fnData');

            // if offline data does exist, use it as base for app
            if (offlineData) {
                this.fnData = JSON.parse(offlineData);
                this.status = 'Found data from local storage';
            } else {
            // if no offline data exists, check to see if data has just been imported
            axios.get('/fnData')
                .then(data => {
                this.fnData = data.data;
                if (this.fnData === "") {
                    this.status = 'Tried getting data from Ajax call, but got an empty string';
                    return;
                }
                // if data was imported, add to local storage
                window.localStorage.setItem('fnData', JSON.stringify(this.fnData));
                this.status = 'Got data from Ajax call to /fnData and saved to localstorage';
                });   
            }
        },
        refreshData(){
            this.clearStorage();
            this.checkForNewData();
        }
        
    	// this.fnData = window.localStorage.getItem('fnData');
    }
});
