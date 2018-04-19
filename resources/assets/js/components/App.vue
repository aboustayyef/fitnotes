<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <vue2-dropzone 
                                ref="myVueDropzone" id="dropzone" 
                                :options="dropzoneOptions"
                                v-on:vdropzone-complete="refreshData()"
                            >
                            </vue2-dropzone>
                        </div>
                        <div class="col-md-12">
                            <div v-if="this.dataLoaded === true">
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