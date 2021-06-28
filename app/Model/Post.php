<?php

class Post extends AppModel {
        public $name = 'Post';
        //behaviors
        //public $actsAs = array('Json'); //variable reservada
        public $actsAs = array(
            'Json' => array(
                'field' => 'tag'
            )
        );

        public function parentNode() {
            if (!$this->id && empty($this->data)) {
                return null;
            }
            if (isset($this->data['Post']['tag'])) {
                $groupId = $this->data['Post']['tag'];
            } else {
                $groupId = $this->field('tag');
            }
            if (!$groupId) {
                return null;
            }
            return array('Post' => array('id' => $groupId));
        }

        public $validate = array(
            'title' => array(
                'rule' => 'notBlank' //'rule' => 'notEmpty' //Validation::notEmpty() is deprecated. Use Validation::notBlank() instead
            ),
            'body' => array(
                'rule' => 'notBlank'
            ),
            'tag' => array(
                'rule' => 'notBlankTags',
                'message' => 'Only letters separated by commas can be accepted.'
            )
        );
        public function notBlankTags($check) {
            $value = array_values($check);
            $value = $value[0];
    
            return preg_match('|^[a-zA-Z,]*$|', $value); //solo acepta letras y comas
        }

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
        /*public function beforeSave($options = array()) {
            if (!empty($this->data['Post']['tag'])) {
        
                $this->data['Post']['tag'] = $this->tagFormatBeforeSave(
                    $this->data['Post']['tag']
                );
            }
            return true;
        }
        
        public function tagFormatBeforeSave($dataTag) {

            $array = explode(",",$dataTag);//pasar dataTag a array
            //debug($array);
            //die();
            return json_encode($array);
        }
        

        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Post']['tag'])) {
                    $results[$key]['Post']['tag'] = $this->tagFormatAfterFind(
                        $val['Post']['tag']
                    );
                }
            }
            return $results;
        }
        
        public function tagFormatAfterFind($tagString) {
            //debug($tagString);
            //die();
            return json_decode($tagString,true);
        }*/
        
    }
?>
