<template>
    <div>
        <table class="table table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Set:</th>
                    <th width="120px" v-for="key in Object.keys(this.sets_with_focus[0])">
                        {{key}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(set,key) in this.sets_with_focus">
                    <td>{{key+1}}</td>
                    <td v-for="reps in set">
                        {{reps}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div v-for="(set, key) in sets">
            Set # {{key}}
        </div> -->
    </div>
</template>

<script>
    export default {
        props: ['sets'],
        mounted(){
            //stuff that happen once component is mounted
        },
        data(){
            return {
                variable: "default value",
            }
        },
        computed: {
            sets_with_focus(){
                return this.sets.map(function(set){
                    var swf = {};
                    if (set['reps'] > 0){
                        swf['Reps'] = set['reps'];
                    }
                    if (set['distance'] > 0){
                        swf['Distance'] = set['distance'];
                    }
                    if (set['weight'] > 0){
                        swf['Weight'] = set['weight'];
                    }
                    if (set['time'] > 0){
                        swf['Time'] = (new Date(1000 * set['time'])).toISOString().substr(11, 8);
                    }
                    return swf;
                });
            }
        },
        methods: {
            method_name(params){
            },
        },
    }
</script>
<style scoped>
</style>