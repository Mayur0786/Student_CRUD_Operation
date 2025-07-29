<?php
class Branch extends AppModel {

    public $hasMany = [
        'Student' => [
            'className' => 'Student',
            'foreignKey' => 'branch_id',
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
