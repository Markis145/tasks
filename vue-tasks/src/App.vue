<!--<template>-->
  <!--<div id="app">-->
       <!--&lt;!&ndash; API-->
            <!--JSON APIS / REST APIS-->

            <!--//BACKEND/LARAVEL/PHP que em preoporcioni la llista de tasques-->

            <!--http:://myservidor.com/tasks-->

            <!--API REST O JSON NO TORNEN HTML -> Tornen objectes javascript en format JSON-->

            <!--JSON-->
       <!--&ndash;&gt;-->
    <!--<tasks :tasks="[]"> </tasks>-->
  <!--</div>-->
<!--</template>-->

<!--<script>-->
    <!--import Tasks from './components/Tasks.vue'-->
    <!--import axios from 'axios'-->
    <!--import EditableText from './components/EditableText'-->

    <!--export default {-->
        <!--name: 'app',-->
        <!--data (){-->
          <!--return {-->
              <!--tasks : []-->
          <!--}-->
        <!--},-->
        <!--components: {-->
            <!--'tasks' : Tasks,-->
        <!--},-->
        <!--created() {-->
            <!--console.log('Component APP ha estat creat')-->
            <!--//AJAX -> Asynchronous JAvascript i XML-->
            <!--// XHR -> XML/JSON HTTP Request Asincrones-->
            <!--//this.tasks =-->

            <!--// JAVASCRIPT NO BLOQUEJA-->
            <!--// let result = axios.get('http://localhost:8050/api/v1/tasks')-->
            <!--// console.log(result);-->
            <!--// axios.get('http://localhost:8050/api/v1/tasks')-->

            <!--//3 opcions-->
            <!--// 1) CALLBACKS -> Funcions anònimes-->
            <!--// ket file = fileManager.open('/home/marcmestre/.bashrc')-->
            <!--// console.log(file);-->
            <!--// fileManager.open('/home/marcmestre/.bashrc',(file) => {-->
            <!--//     console.log(file);-->
            <!--// })-->

            <!--// 2) PROMISES then.catch-->
            <!--axios.get('http://localhost:8050/api/v1/tasks').then(() => {-->
                <!--console.log('tot ha anat bé');-->
            <!--}).catch(() => {-->
                <!--console.log('connection error');-->
            <!--})-->

            <!--// 3 ASYNC WAIT-->
            <!--// async function(){-->
            <!--//     let result = await axios.get('http://localhost:8050/api/v1/tasks')-->
            <!--// }-->



            <!--//3 opcions-->
              <!--// 1) Api per defecte de javascript-->
              <!--// 2) Jquery &ndash;&gt; Ajax/XHR-->
              <!--// 3) Llibreria específica -> Axios-->
        <!--}-->
    <!--}-->
<!--</script>-->

<!--<style>-->

<!--</style>-->


<template>
    <div id="app">
        <!--Api
          backend, larqavel --lista de taskes
          Api rest no tornen html
          JSON
        -->
        <tasks :tasks="tasks"></tasks>
    </div>
</template>

<script>
    import Tasks from './components/Tasks.vue'
    import axios from 'axios'
    import EditableText from './components/EditableText'
    export default {
        name: 'app',
        data(){
            return{
                tasks:[],
                error: null
            }
        },
        components: {
            'tasks' : Tasks,
        },
        created(){
            console.log('Component ha estat creat ')
            axios.get('http://localhost:8050/api/v1/tasks').then((response)=>{
                    this.tasks = response.data
                }
            ).catch(
                (error)=>{
                    this.error = error
                }
            )
            //ASYNC WAIT
            // async function f() {
            //     // let result= await axios.get('http://localhost:8050/api/v1/tasks')
            // }
        }
    }
</script>

<style>
</style>