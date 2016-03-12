<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilesModel extends CI_Model 
{
	public function getProfile($profile, $object = false){
		$result = null;
		$query = $this->cimongo->where(array('name'=> $profile))->get('profiles');
		if($query->num_rows() > 0){
			if(!$object){
				$result = $query->result_array()[0];
			} else {
				$result = $query->result_object()[0];
			}
		}
		return $result;
	}
	
	public function getProfileById($id, $object = false){
		$result = null;
		$theObjId = new MongoId($id);
		$query = $this->cimongo->where(array('_id'=> $theObjId))->get('profiles');
		if($query->num_rows() > 0){
			if(!$object){
				$result = $query->result_array()[0];
			} else {
				$result = $query->result_object()[0];
			}
		}
		return $result;
	}
	
	public function editProfile($profile){
		$array = (array) $profile;
		unset($array['_id']);
		$id = array(
			'_id' => $profile->_id
		);
		//print_r($array);
		//exit();
		return $this->cimongo->where($id)->set($array)->update('profiles');
		//return null;
	}
	
	public function removeProfile($profile){
		$query = $this->cimongo->where(array('name'=> $profile))->delete('profiles');
		return $query;
	}
	
	public function createProfile($profile){
		return $this->cimongo->insert('profiles', $profile);
	}
	
	public function checkName($profile){
		$query = $this->cimongo->where(array('name'=> $profile))->get('profiles');
		if($query->num_rows() > 0){
			return TRUE;
		}
		return FALSE;
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