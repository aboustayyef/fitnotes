<template>
    <div>
        <div v-if="fnData">
            <datepicker 
                :highlighted="dateList" 
                :inline = true
                :bootstrap-styling = true
                v-on:input = "dateChange" >
            </datepicker>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['fnData'],
        data(){
            return {
                selected_date:null,
                selected_date_workouts:null, // workout A, workout B, cardio ...etc,
                selected_date_exercises_by_workout: null
            }
        },
        computed: {
            dateList(){
                if (this.fnData) {
                    var d = Object.keys(this.fnData).map((x) => new Date(x));
                    return {'dates': d};
                }
                return null;
            }
        },
        methods: {
            dateChange(the_date){
                this.selected_date = moment(the_date).format('YYYY-MM-DD') || null;
                this.selected_date_workouts = this.fnData[this.selected_date] || null;
                this.$emit('dayselected', this.selected_date_workouts);
            },
        },
    }
</script>