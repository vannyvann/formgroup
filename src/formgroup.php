<?php

return [

    'groups' => [

        'default' => [
            'components' => [
                'Input' => [
                    'view' => 'formgroup::groups.default.components.input',
                    'casts' => ['name', 'value'],
                ],
                'Select' => [
                    'view' => 'formgroup::groups.default.components.select',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value', 'placeholder', 'options']
                ],
                'Text' => [
                    'view' => 'formgroup::groups.default.components.textarea',
                    'casts' => ['name', 'value'],
                    'hidden' => ['value']
                ]
            ],

            'config' => [
                'prefix' => 'group',
                'hidden' => ['label', 'hint', 'error'],
                'id' => '@name',
                'error' => 'is-invalid',
                'label' => [
                    'auto' => '@name',
                    'replace' => ['_id', '[', ']', '_' => ' '],
                    'capitalize' => 'ucfirst',
                ],
            ],
        ]

    ]
];
