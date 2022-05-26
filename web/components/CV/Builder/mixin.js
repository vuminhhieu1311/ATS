import grapesjs from 'grapesjs';
import 'grapesjs/dist/css/grapes.min.css';
import 'grapesjs-preset-newsletter';
import editorConfig from './editorConfig';

export default {
    data() {
        return {
            editor: {},
        };
    },

    mounted() {
        this.editor = grapesjs.init(editorConfig);

        this.editor.Panels.removePanel('devices-c');
    },
};
