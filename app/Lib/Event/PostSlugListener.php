<?php

App::uses('CakeEventListener', 'Event');

class PostSlugListener implements CakeEventListener {

    public function implementedEvents() {
        return array(
            'Model.Post.createdSlug' => 'updateSlugPost',
        );
    }

    public function updateSlugPost($event) {
        debug($event);
        die();
        $this->Post = ClassEdit::init('Post');
        $titlePost=strtolower(str_replace(' ','-',$post['Post']['title']));

        $this->Post->id = $event->data['id'];
        $this->Post->set(array(
            'slug' => $titlePost
        ));
        $this->Post->save();

        
    }
}

?>