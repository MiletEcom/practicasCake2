<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
    echo $this->Form->create('Post'); //<form id="PostAddForm" method="post" action="/posts/add"> //Post es el modelo
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('tag', array('rows' => '2', 
                                         'placeholder'=>"Separar Tags con comas. Ejm: medicina,doctor,salud"
                                        ));
    echo $this->Form->end('Save Post'); 
?>