<template>
    <div>
        <div v-if="fnData">
            Pick Date: <datepicker 
                :highlighted="dateList" 
                :inline="true"
                v-on:input="dateChange">
                  
                </datepicker>
        </div>
        <hr>
        <div v-if="selected_date_workouts">
            <div v-for="workoutName in Object.keys(selected_date_workouts)">
                <h2>{{workoutName}}</h2>
                <div v-for="exerciseName in Object.keys(selected_date_workouts[workoutName])">
                    <h4>{{exerciseName}}</h4>
                    <set-table :sets="selected_date_workouts[workoutName][exerciseName]">       </set-table>
                </div>
            </div>
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
            },
            filterByDay(day)
            {
                //logic               
            },
            test()
            {
                
            },
        },
        mounted(){
        },
    }
</script>
