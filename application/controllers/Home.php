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
        $this->load_page('dashboard/main', $data);
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

    private function load_page($page, $data = null){
        
		$this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_panel');
        $this->load->view($page, $data);
        $this->load->view('template/shortcut');
        $this->load->view('template/footer');
        $this->load->view('template/foot');
    }
}