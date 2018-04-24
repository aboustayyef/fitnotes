<template>
    <div>
        <div v-if="selected_date_workouts">
            <h3 class="mt-3 mb-3">Workout(s) For Selected day:</h3>
            <div v-for="workoutName in Object.keys(selected_date_workouts)">
                <button type="button" class="btn btn-primary">{{workoutName}}</button>
                <div v-for="exerciseName in Object.keys(selected_date_workouts[workoutName])">
                    <h4  class="mt-3 mb-2 font-weight-light">{{exerciseName}}</h4>
                    <set-table :sets="selected_date_workouts[workoutName][exerciseName]">       </set-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['selected_date_workouts'],
    }
</script>
