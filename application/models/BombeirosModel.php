<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BombeirosModel extends CI_Model 
{
    public function __construct(){
        parent::__construct();
        
    }
    
    public function get($id = null, $object = false){
        $result = null;
        if ( ! is_null ($id)){
            $theObjId = new MongoId($id);
		    $query = $this->cimongo->where(array('_id'=> $theObjId))->get('bombeiros');
    		if($query->num_rows() > 0){
    			if(!$object){
    				$result = $query->result_array()[0];
    			} else {
    				$result = $query->result_object()[0];
    			}
    		}
        } else {
            $query = $this->cimongo->get('bombeiros');
    		if($query->num_rows() > 0){
    			if(!$object){
    				$result = $query->result_array()[0];
    			} else {
    				$result = $query->result_object()[0];
    			}
    		}
        }
        return $result;
    }
    
    public function save($bombeiro){
        $query = $this->cimongo->insert('bombeiros', $this->_setBombeiro($bombeiro));
    	if($query->num_rows() > 0){
    	    return $this->cimongo->insert_id();
		}
		return null;
    }
    
    public function update($bombeiro){
        //Atualização do Bombeiro
    }
    
    public function delete($id){
        //Eliminação do Bombeiro
    }
    
    private function _setBombeiro($bombeiro){
        return array(
            "nome" => $bombeiro['nome']
        );
    }
}