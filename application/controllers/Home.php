<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('login'))
        {
            redirect('conta/entrar');
        }
    }
    
    public function index(){
    
            $this->dashboard();

    }
    
	public function dashboard()	{
        
        $data['main_view'] = "dashboard_view";
        $data['footer_view'] = 'footer_view';
        
		$this->load->view('template/main', $data);
	}
    
    public function sair() {      
        $user = $this->session->userdata('user');
        $this->log($user, 'logout');
        $this->session->sess_destroy();
        redirect('conta/entrar');
    }
    
    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }
}