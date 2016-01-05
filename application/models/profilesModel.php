<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilesModel extends CI_Model 
{
	public function createProfile($profile){
		return $this->cimongo->insert('profiles', $profile);
	}
	
	public function checkName($profile){
		$login = $this->cimongo->where(array('name'=> $profile))->get('profiles');
		if($login->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
    public function getProfiles($object = false){
        $query = $this->cimongo->get('profiles');
        if($query->num_rows() > 0){
			if(!$object){
				$result = $query->result_array();
			} else {
				$result = $query->result_object();
			}
            
            return $result;
        }
        return FALSE;
    }
}