<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Post</h1>
<?php
    //echo $this->Form->create('Post', array('action' => 'edit')); //Deprecated (16384): Using key `action` is deprecated, use `url` directly instead. [CORE/Cake/View/Helper/FormHelper.php, line 383]
    echo $this->Form->create('Post'); 
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');
?>