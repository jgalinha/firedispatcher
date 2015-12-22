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
		if($this->input->post('guardar') === "guardar"){
			if($this->input->post('catchar')) redirect('Configuracoes/perfis');
			$this->addProfile();
		}
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
	
	private function addProfile(){
		$this->load->model('configuracoesModel', 'conf');
		$profile['name'] = $this->input->post('nome');
		$profile['description'] = $this->input->post('descricao');
		$struct = $this->conf->getStruct();
		$profile['permissions'] = $this->createPermissionsArray($struct);
		$profile['create_date'] = new MongoDate();
		$profile['last_edit'] = new MongoDate();
		//echo date('Y-m-d H:i:s', $profile['last_edit']->sec);
		print("<pre>".print_r($profile,true)."</pre>");
		exit();
	}
	
	private function createPermissionsArray($struct, $array = null){
		$control = 0;
		foreach ($struct as $key => $value){
			if(!($key === "_id")){
				$array[$key] = $value;
				if(is_array($value)){
					$array[$key] = $this->createPermissionsArray($value, $array[$key]);
				} else {
					if($control === 1){
						if($key === "name"){
							$name = $value;
						}
						if($key === "view"){
							$var_view = ($name . "-Consultar");
							$array[$key] = ($this->input->post($var_view) === "on") ? true : false; 
						}
						if($key === "edit"){
							$var_edit = ($name . "-Editar");
							$array[$key] = ($this->input->post($var_edit) === "on") ? true : false; 
						}
					}
					if($key === "sub" && $value === false){
						$control++;
					}
				}	
			}
		}
		return $array;
	}
    
    private function loadPage($page, $data = null){
        $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_panel', $data);
        $this->load->view($page, $data);
        $this->load->view('template/shortcut');
        $this->load->view('template/footer');
        $this->load->view('template/foot');
    }
}
