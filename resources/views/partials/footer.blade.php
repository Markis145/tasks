</v-flex>
</v-layout>
</v-container>
</v-content>
<v-footer color="indigo" app>
    <span class="white--text"> Created by Marc Mestre Algueró &copy;2018 All rights reserved</span>
</v-footer>
</v-app>
</div>

<footer></footer>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
<script>
    new Vue({
        el: '#app' ,
        data: () => ({
            drawer: null
        }),
        props: {
            source: String
        }})
</script>
</body>
</html>