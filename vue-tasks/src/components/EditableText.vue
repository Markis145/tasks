<template>
    <span>
        <span v-if="!editing" @dblclick="editing=true">
            <slot></slot>
        </span>
        <span v-if="editing" @keyup.esc="editing=false"
                @keyup.enter="edit">

            <input type="text" value="">
        </span>

    </span>
</template>

<script>

    export default {
        name: 'EditableText',
        data(){
            return {
                editing:false
            }
        },
        methods: {
            edit(){
                window.console.log('TODO EDIT')
                this.editing = false
            }
        }
    }

</script>