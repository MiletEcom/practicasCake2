<?php
App::uses('CakeEventListener', 'Event');
//App::uses('Post', 'Model');
class BeforeSavePost implements CakeEventListener {
    public function implementedEvents() {
        return array(
            'Model.Post.beforeSave' => 'updateSlugPost',
            'passParams' => true
        );
    }
    public function updateSlugPost($event) {
        //die('holaaa');
        $titlePost = strtolower(Inflector::slug($event->data['data']['title'],'-') );
        $Post = ClassRegistry::init('Post');
        $datos = $Post->find('all', array(
            'conditions' => array(
                'Post.slug' => $titlePost
                )
            )
        );
        if (!empty($datos)) {
            throw new Exception('Ya existe un slug con la misma caracteristica en la BD');
        }else{
            $event->data['Post']['slug'] = $titlePost;
            $Post->save($event->data['Post']);
        }

    }
}

?>