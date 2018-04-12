<template>
    <div v-if="fnData">
        Pick Date: <datepicker :highlighted="dateList" v-on:input="dateChange"></datepicker>
    </div>
</template>

<script>
    export default {
        props: ['fnData'],
        data(){
            return {
                selected_date:'',
            }
        },
        computed: {
            dateList(){
                if (typeof(this.fnData) == "object" && this.fnData.length > 0) {
                    return {dates: this.fnData.map(x => new Date(x.start) )};
                }
            },
            selectedDateExercises(){
                if (typeof(this.fnData) == "object" && this.fnData.length > 0) {
                    return this.fnData.filter((dt) => {
                         let a = new Date(dt.start);
                         let b = new Date(this.selected_date);
                         return (a.getFullYear() === b.getFullYear()) &&
                               (a.getMonth() === b.getMonth()) &&
                               (a.getDate() == b.getDate());
                    })
                }
            }
        },
        methods: {
            dateChange(the_date){
                this.selected_date = the_date;
            },
            filterByDay(day)
            {
                //logic               
            },
        },
        mounted(){
        },
    }
</script>
