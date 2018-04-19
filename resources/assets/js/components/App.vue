<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="uploadButton" class="btn btn-primary btn-large">
                        Click to Import CSV
                    </div>
                    <vue2-dropzone 
                        ref="myVueDropzone" id="dropzone" 
                        :options="dropzoneOptions"
                        v-on:vdropzone-complete="refreshData()"
                    >
                    </vue2-dropzone>
                </div>
                <div v-if="this.dataLoaded === true" class="col-md-6">
                    <day-chooser v-on:dayselected="updateSelectedData" :fn-data="fnData"></day-chooser>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <fitnotes-viewer :selected_date_workouts="this.selected_date_workouts"></fitnotes-viewer>
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
              clickable: '#uploadButton',
              thumbnailWidth:50,
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