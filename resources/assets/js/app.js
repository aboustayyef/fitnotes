
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
Vue.component('set-table', require('./components/SetTable.vue'));
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
        checkForNewData(){
            // Check to see if data has just been imported
            axios.get('/fnData')
            .then(data => {
            this.fnData = data.data;
            if (this.fnData === "") {
                this.status = 'Need To Upload New File';
                return;
            }
            // if data was imported, add to local storage
            this.status = 'Data From Uploaded File';
            });   
        },
        refreshData(){
            this.checkForNewData();
        }
    }
});
