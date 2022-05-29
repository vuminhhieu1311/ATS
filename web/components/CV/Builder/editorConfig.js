import cookies from 'axios/lib/helpers/cookies';

const styleManager = {
    appendTo: '#styles-container',
    sectors: [
        {
            name: 'General',
            buildProps: [
                'float',
                'display',
                'position',
                'top',
                'right',
                'left',
                'bottom',
            ],
            properties: [
                {
                    name: 'Alignment',
                    property: 'float',
                    type: 'radio',
                    defaults: 'none',
                    list: [
                        { value: 'none', className: 'fa fa-times' },
                        { value: 'left', className: 'fa fa-align-left' },
                        { value: 'right', className: 'fa fa-align-right' },
                    ],
                },
                { property: 'position', type: 'select' },
            ],
        },
    ],
};

const editorConfig = (resume) => ({
    container: '#editor',
    fromElement: true,
    storageManager: {
        type: 'remote',
        stepsBeforeSave: 1,
        contentTypeJson: true,
        storeComponents: true,
        storeStyles: true,
        storeHtml: true,
        storeCss: true,
        headers: {
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': cookies.read('XSRF-TOKEN'),
        },
        id: 'my-',
        urlStore: `${process.env.API_URL}/resumes/${resume.uuid}/save-content`,
        urlLoad: `${process.env.API_URL}/resumes/${resume.uuid}/load-content`,
    },
    blockManager: {
        appendTo: '#blocks-container',
    },
    styleManager,
    panels: {
        defaults: [
            {
                id: 'basic-actions',
                el: '.panel__basic-actions',
                buttons: [
                    {
                        id: 'visibility',
                        active: true,
                        className: 'btn-toggle-borders',
                        label: '<span class="material-icons-outlined">border_all</span>',
                        command: 'sw-visibility',
                    },
                ],
            },
        ],
    },
    plugins: ['gjs-preset-newsletter'],
    pluginsOpts: {
        'gjs-preset-newsletter': {},
    },
});

export default editorConfig;
