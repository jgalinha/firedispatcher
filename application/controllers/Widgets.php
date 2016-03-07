<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Widgets extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('login'))
        {
            redirect('conta/entrar');
        }
    }

    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }
}