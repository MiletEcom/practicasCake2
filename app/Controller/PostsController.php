<?php

class PostsController extends AppController {
    public $helpers = array('Html','Form');

     function index() {
        //$this->set('posts', $this->Post->find('all')); //cambié
        $this->set('posts', $this->Post->find('all', array('conditions' => array('Post.habilitado' => '1'))));
    }

    public function view($id = null) {
        $this->loadmodel('Comment');
        if (!$id) {
            $this->redirect(array('action' => 'error404'));
        }
        $post = $this->Post->findById($id);
        if (!$post) {
            $this->redirect(array('action' => 'error404'));
        }
    
        $this->set('post', $this->Post->findById($id));

	/*if (!empty($this->request->data)) { //con esto se crea un nuevo post y un nuevo comentario asociado a ese id del NUEVO post
		// Use the following to avoid validation errors:
		unset($this->Post->Comment->validate['post_id']);
		$this->Post->saveAssociated($this->request->data);
	}*/
        if ($this->request->is('post')) {
            $this->request->data['Comment']['post_id']=$id;
        	//pr($this->request->data);
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success('Your comment has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            //throw new NotFoundException(__('Invalid post'));
            $this->redirect(array('action' => 'error404'));
        }
    
        $post = $this->Post->findById($id);
        if (!$post) {
            //throw new NotFoundException(__('Invalid post'));
            $this->redirect(array('action' => 'error404'));
        }
    
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
    
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Flash->success('The post with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }

    function error404() {
        if ($this->request->is('post')) {
            $this->redirect(array('action' => 'index'));
        }
    }
}
?>
