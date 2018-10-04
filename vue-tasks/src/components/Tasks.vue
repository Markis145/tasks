<template>
    <div>
        <input type="text"
               v-model="newTask" @keyup.enter="add">
        <button @click="add">Afegir</button>
        <!--{{ newTask}} = echo -->
        <!--<input :value="newTask" @input="newTask = $event.target.value">-->

        <ul>
            <!--<li v-for="task in tasks"-->
                <!--v-if="task.completed"><strike>{{task.name}}</strike></li>-->
            <!--<li v-else>{{task.name}}</li>-->

            <li v-for="task in tasks" :class="{strike: task.completed}">{{task.name}}</li>
        </ul>
    </div>
</template>

<script>
    //document.getEkebementById
    export default {
        data(){
            return {
                newTask:'',
                tasks: [
                    {
                        name:'Comprar pa ',
                        completed:false
                    },
                    {
                        name:'Comprar llet ',
                        completed:true
                    },
                    {
                        name:'Estudiar php ',
                        completed:false
                    },
                ]
            }
        },
        methods:{
            add(){
                console.log('TODO ADD')
            }
        }
    }
    // {
    //     marca:'Renault',
    //     consum:'5l/100',
    //     start: function (){
    //         console.log('arraca');
    // }
    //
    // }
</script>

<style>
    .strike{
        text-decoration: line-through;
    }

</style>