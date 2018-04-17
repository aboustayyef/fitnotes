<template>
    <div>
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
        props: ['selected_date_workouts'],
    }
</script>
