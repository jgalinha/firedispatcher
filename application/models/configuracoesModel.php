<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfiguracoesModel extends CI_Model 
{
    public function getStruct(){
        $query = $this->cimongo->get('struct');
        if($query->num_rows() > 0){
            $struct = $query->result_array();
            return $struct['0'];
        }
        return FALSE;
    }
}