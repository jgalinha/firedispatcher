<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizadores_model extends CI_Model {
    
    //Activa a conta atravez do email enviado para a conta
    public function activar_conta($id){
        
        $query =  $this->cimongo->where(array('user' => $id))->set(array('activated' => 1))->update('users');
        return $query;        
    }
    
    public function get_user_by_id($id){
        
        $user = null;

        $theObjId = new MongoId($id); 

        $connection = new MongoClient(); 
        $db = $connection->firehouse->users; 

        // this will return our matching entry. 
        $user = $db->findOne(array("_id" => $theObjId)); 
        
        return $user;
        
    }
    
    public function get_user_by_email($email){

        $user = null;
        $query = $this->cimongo->where(array('email'=> $email))->get('users');
        
        if($query->num_rows() > 0){
            $user = $query->result_array();
            return $user[0];
        } else {
            return FALSE;
        }

    }
    
    public function insert_user($dados_utilizador){
        
        return $this->cimongo->insert('users', $dados_utilizador); 
    }
    
    public function update_password_by_email($email, $password){
        
        $hash = password_hash($password, $this->config->item('password_algorithm'), $this->config->item('password_options'));
        $user = array(
            'email' => $email
        );
        $pwd = array(
            'pwd' => $hash
        );
        
        $query = $this->cimongo->where($user)->get('users');
        
        if($query->num_rows() > 0){
            
            $this->cimongo->where($user)->set($pwd)->update('users');
            return TRUE;
            
        } else {
            return FALSE;
        }        
    }
    
    public function check_login($utilizador, $senha){
        
        
        $login = $this->cimongo->where(array('user'=> $utilizador))->get('users');
            
        if($login->num_rows() > 0){
            $user = $login->result_array();
            $dados = $user[0];
            if(password_verify($senha, $user[0]['pwd'])){
                if (password_needs_rehash( $user[0]['pwd'], $this->config->item('password_algorithm'), $this->config->item('password_options'))) { 
                    $hash = password_hash($senha, $this->config->item('password_algorithm'), $this->config->item('password_options')); 
                    $user = array(
                        '_id' => $user[0]['_id']
                    );
                    $pwd = array(
                        'pwd'=>$hash
                    );
                    $this->cimongo->where($user)->set($pwd)->update('users');
                }  
                return $dados;
                
            } else {
                return FALSE;
            }            
        } else {
            return FALSE;
        }
    }
    
    public function check_mecanografico($utilizador){
        
        $login = $this->cimongo->where(array('user'=> $utilizador))->get('users');
        if($login->num_rows() > 0){
            return TRUE;

        } else {
            return FALSE;
        }
    }
    
    public function check_email($email){

        $login = $this->cimongo->where(array('email'=> $email))->get('users');
        if($login->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function verify_reset_password_hash($email, $hash)
    {
        $query = $this->cimongo->where(array('email'=> $email))->get('users');

        if($query->num_rows() === 1){
            $user = $query->result_array();
            return ($hash == md5($this->config->item('Encryption_Key') . $user[0]['firstName'])) ? true : false;
        } else {
            return FALSE;
        }
        
    }

}