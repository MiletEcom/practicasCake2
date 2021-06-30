<?php 
class FindPostShell extends AppShell {
    public $post = array('Post');

    public function show() {
        $post = $this->Post->findById($this->args[0]);
        $this->out(print_r($post, true));
    }
}