<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilesModel extends CI_Model 
{
    public function getProfiles(){
        $query = $this->cimongo->get('profiles');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        return FALSE;
    }
}