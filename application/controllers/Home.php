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

        if($this->session->userdata('lock'))
        {
            $this->bloquear();
        } else {
            $this->dashboard();
        }
    }    


    public function bloquear(){
        if($this->input->post('captcha')) redirect('home');
        $this->load->model('utilizadores_model', 'users');
        $user = $this->session->userdata('user');
        if(!$this->input->post('lock'))
        {
            if(!$this->session->userdata('lock')){
                $this->session->set_userdata('lock', true);
            }
            $email = $this->users->get_user_email($user);
            $data['email'] = $email;
            $this->load->view('dashboard/lock_view', $data);
        } else {
            $pass = $this->input->post('lock');
            $query = $this->users->check_login($user, $pass);
            if($query){
                $this->session->set_userdata('lock', false);
                $this->dashboard();
            }
        }
    }

	public function dashboard()	{

        $this->load->model('utilizadores_model', 'users');
        $users = $this->users->get_users();
        $data['page'] = "dashboard";
        $data['users'] = $users;
        $this->load_page('dashboard/main', $data);
	}

    public function sair() {
        $user = $this->session->userdata('user');
        $this->log($user, 'logout');
        $this->session->sess_destroy();
        redirect('conta/entrar');
    }
    
    private function load_widgets(){
        $user = $this->session->userdata('user');
    }

    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }

    private function load_page($page, $data = null){

		$this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_panel', $data);
        $this->load->view($page, $data);
        $this->load->view('template/shortcut');
        $this->load->view('template/footer');
        $this->load->view('template/foot');
    }
}