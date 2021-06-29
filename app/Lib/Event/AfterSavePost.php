<?php

App::uses('CakeEventListener', 'Event');

class AfterSavePost implements CakeEventListener {
    public function implementedEvents() {
        return array(
            'Model.Post.afterSave' => 'updateSlugPost',
            'passParams' => true
        );
    }

    public function updateSlugPost(CakeEvent $event) {
        debug($event);
        die();
        $this->Post = ClassPost::init('Post.afterSave');
        //$titlePost = strtolower(Inflector::slug($event->data['title'],'-') );
        $titlePost=strtolower(str_replace(' ','-',$event->data['title']));

        $this->Post->id = $event->data['id'];
        $this->Post->set(array(
            'slug' => $titlePost
        ));
        $this->Post->save();

        /*$data = $event->data;
        $subject = $event->subject();

        $this->Document->SomethingImportantHappened($data,$subject); */
    }
}

?>