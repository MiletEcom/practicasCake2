<?php
class Post extends AppModel {
        public $name = 'Post';
    
        public $validate = array(
            'title' => array(
                'rule' => 'notBlank'
                //'rule' => 'notEmpty' //Validation::notEmpty() is deprecated. Use Validation::notBlank() instead
            ),
            'body' => array(
                'rule' => 'notBlank'
                //'rule' => 'notEmpty' //Validation::notEmpty() is deprecated. Use Validation::notBlank() instead
            )
        );

        public $hasMany = array(
            'Comment' => array(
                'className' => 'Comment',
                'foreignKey' => 'post_id',
                'conditions' => '',
                'order' => 'Comment.created DESC',
                'limit' => '25',
                'dependent' => true //si se elimina un post, eliminara tambien todos los comentarios asociados a ese post
            )
        );
    }
?>
