<?php return [
    'default' => [
        'role_subscription'=> 'administrator',
        'redirect' => '/spasibo',
        'name_site' => 'Сайт',
        'title' => 'Заявка',
        'description' => 'Описание',
        'input' => [
            [
                'lable' => 'Имя',
                'name' => 'name',
                'type' => 'text',
                'validation' => 'require'
            ],[
                'lable' => 'Телефон',
                'name' => 'telefon',
                'type' => 'text',
                'validation' => 'require'
            ],[
                'lable' => 'Описание',
                'name' => 'desc',
                'type' => 'textarea',
                'validation' => 'require'
            ]
        ],
        'submit' => [
            'value' => 'Отправить',
            'css' => 'btn-danger'
        ],
        'validator' => [
            [
                'name' => 'required',
                'telefon' => 'required|min:8'
            ],[
                'required' => 'Требует заполнения',
                'min' => 'Слишком короткий номер'
            ]

        ]
    ]
];