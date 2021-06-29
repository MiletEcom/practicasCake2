<?php 
    App::uses('AfterSavePost', 'Lib/Event');
    App::uses('CakeEventManager', 'Event');
    CakeEventManager::instance()->attach(new AfterSavePost());
?>