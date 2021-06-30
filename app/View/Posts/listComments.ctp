<br/><br/>      
<h1>Add comment</h1>
<?php
    echo $this->Form->create('Comment'); 
    echo $this->Form->input('text', array('rows' => '3'));
    echo $this->Form->end('Save Comment'); 
?>
<br/><br/>
<table>
    <tr>
        <th>Id</th>
        <th>Comment</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?php echo $comment['Comment']['id']; ?></td>
        <td><?php echo $comment['Comment']['text']; ?></td>
        <td><?php echo $comment['Comment']['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>