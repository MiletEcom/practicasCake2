<?php 
class FindPostShell extends AppShell {
    
    public $uses = array('Post');

    public function main() {
        $this->out('Hola, ingresa con la palabra show');
    }
    public function show() {
        $opciones=array(
            'limit' => 10,
            'page' => 1,
            'order' => 'Post.id ASC');
        $posts = $this->Post->find('all',$opciones);

        while($posts){
            $posts = $this->Post->find('all',$opciones);
            foreach($posts as $p) {
                //$this->out($p['Post']['slug']);//die();
                if (empty($p['Post']['slug'])) {
                
                    $titlePost = strtolower(Inflector::slug($p['Post']['title'],'-') );
                    $p['Post']['slug'] = $titlePost;

                    if (!$this->Post->save($p['Post'])) {
                        $this->out('FALSE, no guardo');
                    }else{
                        //die('holaaa');
                        $this->out('Le agregué una nueva slug '.$titlePost);
                    }
                     
                }else{
                   $this->out('Ya el post tiene una slug asociada, no hago nada');
                }
            }
            
            $opciones['page']++;
        }
    }
}
