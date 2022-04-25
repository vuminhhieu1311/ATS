<template>
    <quill-editor
        ref="textEditor"
        v-model="content"
        :options="editorOption"
    />
</template>

<script>
    import { quillEditor } from 'vue-quill-editor';
    import 'quill/dist/quill.snow.css';

    export default {
        components: {
            quillEditor,
        },

        props: {
            text: {
                type: String,
                required: true,
            },
            placeholder: {
                type: String,
                default: '',
            },
        },

        data() {
            return {
                content: this.text,
                editorOption: {
                    placeholder: this.placeholder,
                    modules: {
                        toolbar: [
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            { color: [] },
                            { background: [] },
                            { align: [] },
                            { list: 'ordered' },
                            { list: 'bullet' },
                            { script: 'sub' },
                            { script: 'super' },
                            { indent: '-1' },
                            { indent: '+1' },
                            'link',
                            'clean',
                            { font: [] },
                            { size: ['small', false, 'large', 'huge'] },
                            { header: [1, 2, 3, 4, 5, 6, false] },
                        ],
                    },
                },
            };
        },

        watch: {
            text(val) {
                this.content = val;
            },
            content(val) {
                this.$emit('onChangeText', val);
            },
        },
    };
</script>

<style lang="scss">
    .ql-editor {
        height: 25vh;
    }

    .quill-editor {
        margin-bottom: 15px;
        background-color: white;
    }
</style>
