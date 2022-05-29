import grapesjs from 'grapesjs';
import 'grapesjs/dist/css/grapes.min.css';
import 'grapesjs-preset-newsletter';
import html2pdf from 'html2pdf.js';
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
            availableEntries: ['Description', 'Education', 'Experience', 'Certification'],
            outline: ['Description', 'Education', 'Experience', 'Certification'],
        };
    },

    mounted() {
        this.editor = grapesjs.init(editorConfig(this.resume));

        this.editor.Panels.removePanel('devices-c');
    },

    methods: {
        deleteOutline(val) {
            const index = this.outline.indexOf(val);
            if (index > -1) {
                this.outline.splice(index, 1);
            }
        },
        downloadResume() {
            const source = this.editor.runCommand('gjs-get-inlined-html');

            const opt = {
                margin: 0.5,
                filename: 'mycv.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            };
            html2pdf().from(source).set(opt).save();
        },
    },

    watch: {
        outline() {
            setTimeout(() => {
                this.editor.setComponents(this.$refs.resumeTemplate.$el.outerHTML);
            }, 1);
        },
    },
};
