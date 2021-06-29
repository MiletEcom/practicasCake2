<?php

App::uses('CakeEventListener', 'Event');

class AfterSavePost implements CakeEventListener {
    /**
     *
     * @var Document The model.
     */
    protected $Document;

    public function __construct()
    {
        // referencia al modelo que usaremos
        $this->Document = ClassPost::init('Post.afterSave');
    }

    public function implementedEvents() {
        return array(
            'Model.Post.afterSave' => 'updateSlugPost',
            'passParams' => true
        );
    }

    public function updateSlugPost(CakeEvent $event) {

        $data = $event->data;

        debug($data);
        /*
        $subject = $event->subject();

        $this->Document->SomethingImportantHappened($data,$subject);


        debug($data);
        die();
        $this->Post = ClassEdit::init('Post');
        $titlePost = strtolower(Inflector::slug($post['Post']['title'],'-') );
        //$titlePost=strtolower(str_replace(' ','-',$post['Post']['title']));

        $this->Post->id = $event->data['id'];
        $this->Post->set(array(
            'slug' => $titlePost
        ));
        $this->Post->save();
        */
        
    }
}

?>