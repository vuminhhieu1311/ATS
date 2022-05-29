import grapesjs from 'grapesjs';
import 'grapesjs/dist/css/grapes.min.css';
import 'grapesjs-preset-newsletter';
import editorConfig from './editorConfig';

export default {
    props: {
        resume: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            editor: {},
        };
    },

    mounted() {
        this.editor = grapesjs.init(editorConfig(this.resume));

        this.editor.Panels.removePanel('devices-c');
    },
};
