<?php
class Student extends AppModel {

    public $actsAs = ['Containable'];

    public $belongsTo = [
        'Branch' => [
            'className' => 'Branch',
            'foreignKey' => 'branch_id'
        ],
        'Year' => [
            'className' => 'Year',
            'foreignKey' => 'year_id'
        ]
    ];

    public $validate = [
        'name' => [
            'notBlank' => [
                'rule' => 'notBlank',
                'message' => 'Student name is required'
            ],
            'isUnique' => [
                'rule' => 'isUnique',
                'message' => 'Student already exists'
            ]
        ],
        
        'branch_id' => [
            'rule' => 'numeric',
            'message' => 'Please select a valid branch'
        ],
        'year_id' => [
            'rule' => 'numeric',
            'message' => 'Please select a valid year'
        ]
    ];
}
?>
