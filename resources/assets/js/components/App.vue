<template>
    <div>
        <div class="container">
            <h1 class="mt-5 mb-3">FN Viewer</h1>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="mt-3 mb-3">Import CSV File:</h3>
                            <vue2-dropzone 
                                ref="myVueDropzone" id="dropzone" 
                                :options="dropzoneOptions"
                                v-on:vdropzone-complete="refreshData()"
                            >
                            </vue2-dropzone>
                            <p class="mt-2">We don't store your data. This is just a utility to visualise your backup file in a browser</p>
                        </div>
                        <div class="col-md-12">
                            <div v-if="this.dataLoaded === true">
                                <h3 class="mt-3 mb-3">Pick a Date:</h3>
                                <day-chooser 
                                    v-on:dayselected="updateSelectedData" 
                                    :fn-data="fnData">
                                </day-chooser>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <fitnotes-viewer :selected_date_workouts="this.selected_date_workouts">
                    </fitnotes-viewer>
                </div>
            </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() { 
            return {
            status: 'Finding Out Status...',
            fnData: null,
            dataLoaded: false,
            selected_date_workouts:null,
            dropzoneOptions: {
              url: '/upload',
              paramName:'csv',
              addRemoveLinks: true,
              dictDefaultMessage: "Drag your CSV file here or tap to upload",
              headers: { "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content }
          }
      }
    },
    mounted(){
         this.checkForNewData();
    },
    methods:{
        fileChanged(){
            console.log('file changed');
        },
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
            this.dataLoaded = true;
            });   
        },
        updateSelectedData(s){
            this.selected_date_workouts = s;
        },
        refreshData(){
            this.checkForNewData();
        }
    }
}
</script>
<style scoped>
</style>