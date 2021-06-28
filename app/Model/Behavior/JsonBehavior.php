<?php
//class Json extends AppModel {
class JsonBehavior extends ModelBehavior {

    public function setup(Model $Model, $settings = array()) {

        //debug($this->settings[$Model->alias]);die();
        
        if(!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
                'field' => ''
            );
		}

        //debug($this->settings[$Model->alias]);die();
		$this->settings[$Model->alias]= array_merge(
			$this->settings[$Model->alias] ,(array) $settings
		);
        
        
    }

    public function beforeSave(Model $Model,$options = array()) {
        $field= $this->settings[$Model->alias]['field'];
        
        if (!empty($Model->data[$Model->alias][$field] )) {
            $Model->data[$Model->alias][$field] = $this->tagFormatBeforeSave(
                $Model->data[$Model->alias][$field]
            );
        }
        return true;
    }
    
/*
    $field= $this->settings[$Model->alias]['field'];
        //debug($results);
        foreach ($results as $key => $val) { 
            if (isset($val[$Model->alias][$field])) { 
                $results[$key][$Model->alias][$field]= $this->tagFormatAfterFind(
                    $val[$Model->alias][$field]
                );
            }
            
        }*/
    
    /*public function beforeSave(Model $Model,$options = array()) {
        if (!empty($Model->data['Post']['tag'])) {
    
            $Model->data['Post']['tag'] = $this->tagFormatBeforeSave(
                $Model->data['Post']['tag']
            );
        }
        return true;
    }*/
    
    public function tagFormatBeforeSave($dataTag) {

        $array = explode(",",$dataTag);//pasar dataTag a array
        //debug($array);
        //die();
        return json_encode($array);
    }
    

    public function afterFind(Model $Model, $results, $primary = false) {
        $field= $this->settings[$Model->alias]['field'];
        //debug($results);
        foreach ($results as $key => $val) { 
            if (isset($val[$Model->alias][$field])) { 
                $results[$key][$Model->alias][$field]= $this->tagFormatAfterFind(
                    $val[$Model->alias][$field]
                );
            }
            
        }
            return $results;
    }

    /*foreach ($results as $key => $val) {
        if (isset($val['Post']['tag'])) {
            $results[$key]['Post']['tag'] = $this->tagFormatAfterFind(
                $val['Post']['tag']
            );
        }
    }*/


    public function tagFormatAfterFind($tagString) {
        //die();
        return json_decode($tagString,true);
    }
    
}