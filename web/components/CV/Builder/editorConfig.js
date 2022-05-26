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

const editorConfig = {
    container: '#editor',
    fromElement: true,
    storageManager: false,
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
};

export default editorConfig;
