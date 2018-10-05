<!--<template>-->
        <!--<div class="container flex justify-center flex-row" >-->
            <!--<div class="flex flex-col">-->
                <!--<h1 class="text-center text-red-light">Tasques</h1>-->
                <!--<input type="text" placeholder="Nova Tasca"-->
                       <!--v-model="newTask" @keyup.enter="add"-->
                       <!--class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">-->
                <!--<button @click="add">Afegir</button>-->
                <!--<ul>-->
                    <!--<li v-for="task in filteredTasks" :key="task.id" >-->
                        <!--<span :class="{ strike: task.completed }">{{task.name}}</span>-->
                        <!--&nbsp;-->
                        <!--<span @click="remove(task)">&#215;</span>-->
                    <!--</li>-->
                <!--</ul>-->

                <!--<h3>Filtros</h3>-->
                <!--Activa filter: {{ filter }}-->
                <!--<ul>-->
                    <!--<li><button @click="setFilter('All')">Totes</button></li>-->
                    <!--<li><button @click="setFilter('Completed')">Completades</button></li>-->
                    <!--<li><button @click="setFilter('Active')">Pendents</button></li>-->
                <!--</ul>-->
            <!--</div>-->
        <!--</div>-->
<!--</template>-->

<!--<script>-->

    <!--var filters = {-->
        <!--all: function(tasks){-->
            <!--return tasks-->
        <!--} ,-->
        <!--completed: function(tasks){-->
            <!--return tasks.filter(function (task) {-->
                <!--return task.completed-->
                <!--// if (task.completed) return true-->
                <!--// return false-->
            <!--})-->
        <!--},-->
        <!--active: function(tasks){-->
            <!--return tasks.filter(function (task) {-->
                <!--return !task.completed-->
                <!--// if (!task.completed) return true-->
                <!--// return false-->
            <!--})-->
        <!--},-->
    <!--}-->
    <!--//document.getEkebementById-->
    <!--export default {-->
        <!--data(){-->
            <!--return {-->
                <!--filter: 'All', //all completed actual-->
                <!--newTask:'',-->
                <!--tasks: [-->
                    <!--{-->
                        <!--id: 1,-->
                        <!--name:'Comprar pa ',-->
                        <!--completed:false-->
                    <!--},-->
                    <!--{-->
                        <!--id: 2,-->
                        <!--name:'Comprar llet ',-->
                        <!--completed:true-->
                    <!--},-->
                    <!--{-->
                        <!--id: 3,-->
                        <!--name:'Estudiar php ',-->
                        <!--completed:false-->
                    <!--},-->
                <!--]-->
            <!--}-->
        <!--},-->

        <!--computed: {-->
            <!--total(){-->
              <!--return this.tasks.length-->
            <!--},-->
          <!--filteredTasks(){-->
              <!--//segons el filtre actiu-->
              <!--//alternativa switch/case -> array asociatiu-->
              <!--return filters[this.filter](this.tasks)-->
          <!--}-->
        <!--},-->
        <!--methods:{-->
            <!--setFilter(newFilter){-->
              <!--console.log(xivato);-->
              <!--console.log(newFilter);-->
              <!--this.filter = newFilter-->
            <!--},-->
            <!--add(){-->
                <!--// console.log('TODO ADD')-->
                <!--this.tasks.splice(0,0,{name:this.newTask,completed:false})-->
                <!--this.newTask=''-->
            <!--},-->
            <!--remove(task) {-->
                <!--window.console.log(task);-->
                <!--this.tasks.splice(this.tasks.indexOf(task),1)-->
            <!--}-->
        <!--}-->
    <!--}-->
    <!--// {-->
    <!--//     marca:'Renault',-->
    <!--//     consum:'5l/100',-->
    <!--//     start: function (){-->
    <!--//         console.log('arraca');-->
    <!--// }-->
    <!--//-->
    <!--// }-->
<!--</script>-->

<!--<style>-->
    <!--.strike{-->
        <!--text-decoration: line-through;-->
    <!--}-->

<!--</style>-->

<template>
    <div class="flex justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-red-light">Tasques ({{total}}): </h1>
            <div class="flex-row"  >

                <input type="text" placeholder="Nova Tasca"
                       v-model="newTask" @keyup.enter="add"
                       class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">
                <button @click="add" class="text-center text-red"  >Afegir</button>
            </div>
            <ul>
                <li v-for="task in filteredTasks" :key="task.id">
                    <span :class="{ strike: task.completed }">{{task.name}}</span>
                    &nbsp;
                    <span @click="remove(task)">&#215;</span>
                </li>
            </ul>

            <br>
            <h3>Filtros:</h3>
            <br>
            Filtre emprat -> {{ filter }}

            <ul>
                <br>
                <li><button @click="setFilter('all')">Totes</button></li>
                <li><button @click="setFilter('completed')">Completades</button></li>
                <li><button @click="setFilter('active')">Pendents</button></li>
            </ul>
        </div>
    </div>
</template>

<script>
    var filters = {
        all:function (tasks) {
            return tasks
        },
        completed:function (tasks) {
            return tasks.filter(function (task) {
                return task.completed
                // if (task.completed)return true
                // else return false
            })
        },
        active:function (tasks) {
            return tasks.filter(function (task) {
                return !task.completed
            })
        },
    }
    //document.getEkebementById
    export default {
        data() {
            return {
                filter: 'all', // All Completed Active
                newTask: '',
                tasks: [
                    {
                        id: 1,
                        name: 'Comprar pa',
                        completed: false
                    },
                    {
                        id: 2,
                        name: 'Comprar llet',
                        completed: false
                    },
                    {
                        id: 3,
                        name: 'Estudiar PHP',
                        completed: true
                    }
                ]
            }
        },
        computed: {
            total() {
                return this.tasks.length
            },
            filteredTasks() {
                // Segons el filtre actiu
                // Alternativa switch/case -> array associatiu
                return filters[this.filter](this.tasks)
            }
        },
        methods: {
            setFilter(newFilter) {
                this.filter = newFilter
            },
            add() {
                this.tasks.splice(0,0,{ name: this.newTask, completed: false } )
                this.newTask=''
            },
            remove(task) {
                window.console.log(task)
                this.tasks.splice(this.tasks.indexOf(task),1)
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
    .strike {
        text-decoration: line-through;
    }
</style>
// {
//     marca:'Renault',
//     consum:'5l/100',
//     start: function (){
//         console.log('arraca');
// }
//
// }