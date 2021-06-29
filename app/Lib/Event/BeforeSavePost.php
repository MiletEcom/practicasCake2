<?php

App::uses('CakeEventListener', 'Event');
//App::uses('AppModel', 'Model');

class BeforeSavePost implements CakeEventListener {
    public function implementedEvents() {
        return array(
            'Model.Post.beforeSave' => 'updateSlugPost'
        );
    }

    public function updateSlugPost($event) {
        //die('holaaa');

        //debug($event->data['data']['title']);
        $titlePost = strtolower(Inflector::slug($event->data['data']['title'],'-') );
        debug($titlePost);die();
        $this->Post = ClassPost::init('Post.beforeSave');
        
        //$titlePost=strtolower(str_replace(' ','-',$event->data['title']));

        /*$this->Post->id = $event->data['id'];
        $this->Post->set(array(
            'slug' => $titlePost
        ));*/
        $conditions = array("NOT" => array(
            "Post.slug" => array($event->data['title'])
        ) );
        $this->Post->set('posts', $this->Post->find('all', array('conditions' => $conditions)));

        $this->Post->save();
    }


}

?>