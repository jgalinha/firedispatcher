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
	
	public function getProfile(){
		$profile = $this->input->post('profile');
		$this->load->model('profilesModel', 'profile');
		$result = $this->profile->getProfile($profile);
		$array = array(
			'result' => $result,
		);
		echo json_encode($array);
	}
	
	public function removeProfile(){
		$profile = $this->input->post('profile');
		$this->load->model('profilesModel', 'profile');
		$result = $this->profile->removeProfile($profile);
		$this->log($this->session->userdata('user'), "profile " . $profile . " remove", $result);
		$array = array(
			'result' => $result,
		);
		echo json_encode($array);
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
			$data['alerta'] = $this->addProfile();
		}
        $this->load->model('profilesModel', 'profile');
		$this->load->model('configuracoesModel', 'conf');
        $data['profiles'] = $this->profile->getProfiles(true);
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
		$alerta = null;
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required');
		if($this->form_validation->run() === TRUE){
			$inserted_profile = null;
			$this->load->model('configuracoesModel', 'conf');
			$this->load->model('profilesModel', 'profiles');
			$profile['name'] = $this->input->post('nome');
			$profile['description'] = $this->input->post('descricao');
			$struct = $this->conf->getStruct();
			$profile['permissions'] = $this->createPermissionsArray($struct);
			$profile['create_date'] = new MongoDate();
			$profile['last_edit'] = new MongoDate();
			if(!$this->profiles->checkName($profile['name'])){
				if($this->profiles->createProfile($profile)){
					
					$this->log($this->session->userdata('user'), "profile created", $profile);
					$alerta = array(
						"class" => "success",
						"cabeçalho" => "Sucesso!",
						"mensagem" => "Perfil criado com sucesso!<br>"
					);
				} else {
					//Erro ao criar o profile
					$alerta = array(
						"class" => "danger",
						"cabeçalho" => "Erro!",
						"mensagem" => "Aconteceu um erro ao criar o perfil!<br>"
					);
				}
				
			} else {
				//Profile já existent
				$alerta = array(
					"class" => "danger",
					"cabeçalho" => "Erro!",
					"mensagem" => "O Perfil que está a tentar criar já existe!<br>"
				);
			}
		} else {
			//ERRO NO PREENCHIMENTO DO FORMULARIO
			$alerta = array(
				"class" => "danger",
				"cabeçalho" => "Erro!",
				"mensagem" => "Erro no preenchimento!<br>" . validation_errors()
			);
		}
		//echo date('Y-m-d H:i:s', $profile['last_edit']->sec);
		//print("<pre>".print_r($inserted_profile,true)."</pre>");
		return $alerta;
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

	private function log($user, $movement, $log = null){
		$this->load->model('log_model');
		$this->log_model->log($user, $movement, $log);
	}
}
