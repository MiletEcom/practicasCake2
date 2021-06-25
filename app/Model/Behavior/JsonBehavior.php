<?php
//class Json extends AppModel {
class JsonBehavior extends ModelBehavior {

    public function setup(Model $Model, $settings = array()) {
        /*if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array(
                'Reclamo' => 'Reclamo',
                'Sugerencia' => 'Sugerencia',
                'comentario' => 'comentario',
            );
        }
        $this->settings[$Model->alias] = array_merge(
            $this->settings[$Model->alias], (array)$settings);
    */
    }

    public function beforeSave(Model $Model,$options = array()) {
        if (!empty($Model->data['Post']['tag'])) {
    
            $Model->data['Post']['tag'] = $this->tagFormatBeforeSave(
                $Model->data['Post']['tag']
            );
        }
        return true;
    }
    
    public function tagFormatBeforeSave($dataTag) {

        $array = explode(",",$dataTag);//pasar dataTag a array
        //debug($array);
        //die();
        return json_encode($array);
    }
    

    public function afterFind(Model $Model, $results, $primary = false) {
        //debug($Model);
        //die();
        foreach ($results as $key => $val) {
            if (isset($val['Post']['tag'])) {
                $results[$key]['Post']['tag'] = $this->tagFormatAfterFind(
                    $val['Post']['tag']
                );
            }
        }
        return $results;
    }
    
    public function tagFormatAfterFind($tagString) {
        //die();
        return json_decode($tagString,true);
    }
    
}