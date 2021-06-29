<?php 
    App::uses('CakeEventManager', 'Event');
    App::uses('PostSlugListener', 'Lib/Event');
    CakeEventManager::instance()->attach(new PostSlugListener());
?>