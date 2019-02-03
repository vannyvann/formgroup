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
                'Radio' => [
                    'view' => 'formgroup::default.radio',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value', 'nullable']
                ],
                'Radios' => [
                    'view' => 'formgroup::default.radios',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value', 'nullable']
                ],
                'Checkbox' => [
                    'view' => 'formgroup::default.checkbox',
                    'casts' => ['name', 'value', 'checked'],
                    'hidden' => ['nullable']
                ],
                'Checkboxes' => [
                    'view' => 'formgroup::default.checkboxes',
                    'casts' => ['name', 'options', 'value'],
                    'hidden' => ['value', 'nullable']
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
