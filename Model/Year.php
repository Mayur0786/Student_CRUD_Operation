<?php
class Year extends AppModel {

    public $hasMany = [
        'Student' => [
            'className' => 'Student',
            'foreignKey' => 'year_id',
            'dependent' => true
        ]
    ];

    public $validate = [
        'name' => [
            'notBlank' => [
                'rule' => 'notBlank',
                'message' => 'Branch name is required'
            ],
            'isUnique' => [
                'rule' => 'isUnique',
                'message' => 'Branch already exists'
            ]
        ]
    ];
}
?>
