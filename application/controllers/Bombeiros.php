<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "/libraries/REST_Controller.php";

class Bombeiros extends REST_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('login')){
            redirect('conta/entrar');
        } elseif ($this->session->userdata('lock')){
            redirect('home/bloquear');
        }
        
        $this->load->model('BombeirosModel', 'bombeiros');
    }
    
    public function index_get(){
        $bombeiros = $this->bombeiros->get();
        
        if( ! is_null($bombeiros)) {
            $this->response(array("response" => $bombeiros), 200);
        } else {
            $this->response(array("error" => "Não há bombeiros registados"), 404);
        }
    }
    
    public function index_post(){
        if(!$this->post("bombeiro")){
            $this->response(NULL, 400);
        }
        
        $bombeiroId = $this->bombeiros->save($this->post("bombeiro"));
        
        if( ! is_null($bombeiroId)) {
            $this->response(array("response" => $bombeiroId), 200);
        } else {
            $this->response(array("error" => "Ocorreu um erro"), 400);
        }
    }
    
    public function index_put($id){
        if(!$this->put("bombeiro") || ! $id){
            $this->response(NULL, 400);
        }
        
        $bombeiroId = $this->bombeiros->update($id, $this->put("bombeiro"));
        
        if( ! is_null($bombeiroId)) {
            $this->response(array("response" => "Bombeiro atualizado"), 200);
        } else {
            $this->response(array("error" => "Ocorreu um erro"), 400);
        }
    }
    
    public function index_delete($id){
        if (!$id){
            $this->response(NULL, 400);
        }
        
        $delete = $this->bombeiros->delete($id);
        
        if( ! is_null($delete)) {
            $this->response(array("response" => "Bombeiro eliminado"), 200);
        } else {
            $this->response(array("error" => "Ocorreu um erro"), 400);
        }
    }
    
    public function find_get($id){
        
        if (!$id){
            $this->response(NULL, 400);
        }
        
        $bombeiro = $this->bombeiros->get($id);
        
        if( ! is_null($bombeiro)) {
            $this->response(array("response" => $bombeiro), 200);
        } else {
            $this->response(array("error" => "O Bombeiro que procura não existe"), 404);
        }
    }
}
