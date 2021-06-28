<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo $post['Post']['title']?></h1>

<p><small>Created: <?php echo $post['Post']['created']?></small></p>

<p><?php echo $post['Post']['body']?></p>

<p><?php
    if (!empty($post['Post']['tag'])) { 
        foreach ($post['Post']['tag'] as $tags): 
            echo '<li>'.$tags.'</li>';
        endforeach; 
    }
?> </p>

<?php // echo print_r($post) ?>

<br/><br/>      
<h1>Add comment</h1>
<?php
    echo $this->Form->create('Comment'); 
    echo $this->Form->input('text', array('rows' => '3'));
    echo $this->Form->end('Save Comment'); 
    
    if (empty($post['Comment'])){
    	echo "<p>Este Post no tiene comentarios</p>";
    }else{
?>
<br/><br/>
<table>
    <tr>
        <th>Id</th>
        <th>Comment</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($post['Comment'] as $comm): ?>
    <tr>
        <td><?php echo $comm['id']; ?></td>
        <td><?php echo $comm['text']; ?></td>
        <td><?php echo $comm['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
<?php } //end_else 
?>
