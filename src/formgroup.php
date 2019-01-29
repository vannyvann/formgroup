<?php

return [

    'groups' => [

        'default' => [
            'components' => [
                'Input' => [
                    'view' => 'formgroup::default.input',
                    'casts' => ['name', 'value'],
                ],
                'Select' => [
                    'view' => 'formgroup::default.select',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value', 'placeholder']
                ],
                'Text' => [
                    'view' => 'formgroup::default.textarea',
                    'casts' => ['name', 'value'],
                    'hidden' => ['value']
                ],
                'Option' => [
                    'view' => 'formgroup::default.radios',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value']
                ]
            ],

            'config' => [
                'prefix' => 'group',
                'hidden' => ['label', 'hint', 'error', 'options'],
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
