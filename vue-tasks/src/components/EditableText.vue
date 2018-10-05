<template>
    <span>
        <span v-if="!editing" @dblclick="editing=true">
            {{ currentText }}
        </span>
        <span v-if="editing" @keyup.esc="editing=false"
                @keyup.enter="edit">
            <input type="text" :value="text">
            <!--<input type="text" :value="text" @input="text= $event.target.value">-->
            <input type="text" v-model="currentText">
        </span>

    </span>
</template>

<script>

    export default {
        name: 'EditableText',
        data(){
            return {
                editing:false,
                currentText: this.text
            }
        },
        props: {
            'text': {
                type: String,
                required: true
            }
        }   ,
        // props: ['text'],
        methods: {
            edit(){
                this.editing = false
                //informat al pare
                this.$emit('edited',this.currentText)
            }
        }
    }

</script>