<?php
    class Comment extends AppModel {

        var $name = 'Comment';
        
        public $validate = array(
            'text' => array(
                'rule' => 'notBlank'
            )
        );
        //belongsTo de muchos a uno
        var $belongsTo = array('Post' =>
            array('className' =>'Post',
            'conditions'=>'',
            'order' =>'',
            'foreignKey'=>'post_id'
            )
        );
    }
?>

