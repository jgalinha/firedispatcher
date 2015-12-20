<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('login')){
            redirect('conta/entrar');
        } elseif ($this->session->userdata('lock')){
            redirect('home/bloquear');
        }
    }

    public function estrutura(){
        $this->load->model('configuracoesModel', 'conf');
        $data['struct'] = $this->conf->getStruct();
        $data['page'] = "permissoes";
        $data['breadcrumb'] = array(
            "0" => "Home",
            "1" => "Configurações",
            "2" => "Permissões"
        );
        $this->loadPage('configuracoes/estrutura', $data);
    }
    
    public function perfis(){
        $this->load->model('profilesModel', 'profile');
		$this->load->model('configuracoesModel', 'conf');
        $data['profiles'] = $this->profile->getProfiles();
		$data['struct'] = $this->conf->getStruct();
        $data['page'] = "perfis";
        $data['breadcrumb'] = array(
            "0" => "Home",
            "1" => "Configurações",
            "2" => "Perfis"
        );
        $this->loadPage('configuracoes/perfis', $data);
    }
    
    private function loadPage($page, $data = null){
        $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_panel');
        $this->load->view($page, $data);
        $this->load->view('template/shortcut');
        $this->load->view('template/footer');
        $this->load->view('template/foot');
    }
}
