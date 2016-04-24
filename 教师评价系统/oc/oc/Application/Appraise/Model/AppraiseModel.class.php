<?php

namespace Appraise\Model;
use Think\Model\RelationModel;

class AppraiseModel extends RelationModel{

    protected $_link = array(
        'student'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'Member',
            'foreign_key'   => 'studentId',
            'mapping_name'  => 'student',
        ),
    );
 
}
