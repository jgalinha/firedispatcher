<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilizadores_model extends CI_Model {
    
    
    public function get_user_email($user){
        $query = $this->cimongo->where(array('user'=> $user))->get('users');
        if($query->num_rows() > 0){
            $array =  $query->result_array();
            return $array[0]['email'];        
        } else {
            return false;
        }        
    }
    
    //Ativa/Desactiva a conta do utilizador
    public function change_status($user){
        $query = $this->cimongo->where(array('user'=> $user))->get('users');
        if($query->num_rows() > 0){
            $array =  $query->result_array();
            $new_status = ($array[0]['status'] == 0) ? 1 : 0;
            $update_query =  $this->cimongo->where(array('user' => $user))->set(array('status' => $new_status))->update('users');
            return $new_status;        
        } else {
            return false;
        }
    }
       
    
    //Devolve todos os utilizadores
    public function get_users(){
        $users = null;
        $query = $this->cimongo->get('users');

        if($query->num_rows() > 0){
            $users = $query->result_array();
            return $users;
        } else {
            return FALSE;
        }
    }
    
    public function get_user_id($user){
        $query = $this->cimongo->where(array('user'=> $user))->get('users');

        if($query->num_rows() > 0){
            $user = $query->result_array();
            return $user['0']['_id'];
        } else {
            return FALSE;
        }
    }
    
    //Activa a conta atravez do email enviado para a conta
    public function activar_conta($id){

        $query =  $this->cimongo->where(array('user' => $id))->set(array('activated' => 1))->update('users');
        return $query;
    }

    public function get_user_by_id($id){

        $user = null;
        $theObjId = new MongoId($id);
        $query = $this->cimongo->where(array('_id'=> $theObjId))->get('users');
        if($query->num_rows() > 0){
            $user = $query->result_array();
            return $user[0];
        } else {
            return FALSE;
        }

    }
    
    public function get_user($user){

        $query = $this->cimongo->where(array('user'=> $user))->get('users');
        if($query->num_rows() > 0){
            $user = $query->result_array();
            return $user[0];
        } else {
            return FALSE;
        }

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