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
    
    public function changeUserProfile()
    {
        $this->checkPermissions("");
        $user = $this->input->post('user');
        $profile = $this->input->post('profile');
        $prifile = (strlen($profile) === 0) ? null : $profile;
		$this->load->model('utilizadores_model', 'users');
		$result = $this->users->changeRoles($user, $profile);
		$array = array(
			'result' => $result,
		);
		echo json_encode($array);
    }
		
	public function logs(){
		$this->load->model('log_model', 'logs');
		$logs = $this->logs->getLogs(true);
		$data['logs'] = $logs;
		$data['page'] = "logs";
		$data['breadcrumb'] = array(
			"0" => "Home",
			"1" => "Configurações",
			"2" => "Logs"
		);
		$this->loadPage('configuracoes/logs', $data);
	}
	
	public function utilizadores(){
		$this->load->model('utilizadores_model', 'users');
		$this->load->model('profilesModel', 'profile');
		$users = $this->users->get_users();
		$data['profiles'] = $this->profile->getProfiles(true);
		$data['users'] = $users;
		$data['page'] = "utilizadores";
		$data['breadcrumb'] = array(
			"0" => "Home",
			"1" => "Configurações",
			"2" => "Utilzadores"
		);
		$this->loadPage('configuracoes/utilizadores', $data);
	}

	public function change_user_status(){
		$user = $this->input->post('user');
		$this->load->model('utilizadores_model', 'users');
		$status = $this->users->change_status($user);
		$result = ($status === false)? false : true;
		$array = array(
			'result' => $result,
			'user' => $user,
			'status' => $status
		);
		if($status >= 0){
			$this->log($this->session->userdata('user'), "account status change", $array);
		}
		echo json_encode($array);
	}
	
	public function send_status_email(){
		$user = $this->input->post('user');
		$this->load->model('utilizadores_model', 'users');
		$query = $this->users->get_user($user);
		if($query === false){
			$result = false;
		} else {
			$status = ($query['status'] == 0)? "desativada" : "ativada";
			$subject = 'Conta ' . $status;
			$message = '<!DOCTYPE html PUBLIC><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    </head><body>';
			$message .= '<p>Caro(a) '. $query['firstName'] . ' ' . $query['lastName'] . '</p>';
			$message .= '<p>Este email foi enviado para o(a) informar que a sua conta foi <b>' . $status . '</b> pelo administrador!</p>';
			$message .= '<p>Obrigado!</p>';
			$message .= '<p>A Equipa do ' . $this->config->item('title') . '</p>';
			$message .= '</body></html>';    
			$result = $this->send_email($query['email'], $subject, $message);
		}      
		$array = array(
			'result' => $result,
		);
		echo json_encode($array);
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
        $data['page'] = "estrutura";
        $data['breadcrumb'] = array(
            "0" => "Home",
            "1" => "Configurações",
            "2" => "Permissões"
        );
        $this->loadPage('configuracoes/estrutura', $data);
    }
    
    public function perfis(){
		$data['alerta'] = null;
		if($this->input->post('guardar') === "guardar"){
			if($this->input->post('catchar')) redirect('Configuracoes/perfis');
			$data['alerta'] = $this->addProfile();
		}
		if($this->input->post('editar') === "editar"){
			if($this->input->post('catchar')) redirect('Configuracoes/perfis');
			$data['alerta'] = $this->editProfile();
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
    
    private function checkPermissions($permission){
        
    }
	
	private function editProfile(){
		$alerta = null;
		$this->form_validation->set_rules('nomeEdit', 'Nome', 'trim|required');
		$this->form_validation->set_rules('descricaoEdit', 'Descrição', 'trim|required');
		if($this->form_validation->run() === TRUE){
			$inserted_profile = null;
			$this->load->model('configuracoesModel', 'conf');
			$this->load->model('profilesModel', 'profiles');
			if($this->input->post('id')){
				$profile = $this->profiles->getProfileById($this->input->post('id'), true);
				if($profile){
					$oldProfile = clone $profile;
					$profile->name = $this->input->post('nomeEdit');
					$profile->description = $this->input->post('descricaoEdit');
					$struct = $this->conf->getStruct();
					$profile->permissions = $this->createPermissionsArrayEdit($struct);
					$profile->last_edit = new MongoDate();
					if($this->profiles->editProfile($profile)){
						$this->log($this->session->userdata('user'), "edit profile " . $oldProfile->name, $profile);
						$alerta = array(
							"class" => "success",
							"cabeçalho" => "Sucesso!",
							"mensagem" => "Perfil editado com sucesso!<br>",
							"icon" => "check"
						);
					} else {
						//Erro ao criar o profile
						$alerta = array(
							"class" => "danger",
							"cabeçalho" => "Erro!",
							"mensagem" => "Aconteceu um erro ao editar o perfil!<br>",
							"icon" => "times"
						);
					}
				}
			}
		} else {
			//ERRO NO PREENCHIMENTO DO FORMULARIO
			$alerta = array(
				"class" => "danger",
				"cabeçalho" => "Erro!",
				"mensagem" => "Erro no preenchimento!<br>" . validation_errors(),
				"icon" => "times"
			);
		}
		//echo date('Y-m-d H:i:s', $profile['last_edit']->sec);
		//print("<pre>".print_r($inserted_profile,true)."</pre>");
		return $alerta;
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
						"mensagem" => "Perfil criado com sucesso!<br>",
						"icon" => "check"
					);
				} else {
					//Erro ao criar o profile
					$alerta = array(
						"class" => "danger",
						"cabeçalho" => "Erro!",
						"mensagem" => "Aconteceu um erro ao criar o perfil!<br>",
						"icon" => "times"
					);
				}
				
			} else {
				//Profile já existent
				$alerta = array(
					"class" => "danger",
					"cabeçalho" => "Erro!",
					"mensagem" => "O Perfil que está a tentar criar já existe!<br>",
					"icon" => "times"
				);
			}
		} else {
			//ERRO NO PREENCHIMENTO DO FORMULARIO
			$alerta = array(
				"class" => "danger",
				"cabeçalho" => "Erro!",
				"mensagem" => "Erro no preenchimento!<br>" . validation_errors(),
				"icon" => "times"
			);
		}
		//echo date('Y-m-d H:i:s', $profile['last_edit']->sec);
		//print("<pre>".print_r($inserted_profile,true)."</pre>");
		return $alerta;
	}

	private function createPermissionsArrayEdit($struct, $array = null){
		$control = 0;
		foreach ($struct as $key => $value){
			if(!($key === "_id")){
				$array[$key] = $value;
				if(is_array($value)){
					$array[$key] = $this->createPermissionsArrayEdit($value, $array[$key]);
				} else {
					if($control === 1){
						if($key === "name"){
							$name = $value;
						}
						if($key === "view"){
							$var_view = ($name . "-Consultar-Editar");			
							$array[$key] = ($this->input->post($var_view) === "on") ? true : false; 
						}
						if($key === "edit"){
							$var_view = ($name . "-Editar-Editar");
							$array[$key] = ($this->input->post($var_view) === "on") ? true : false; 
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
							$var_view = ($name . "-Editar");
							$array[$key] = ($this->input->post($var_view) === "on") ? true : false; 
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
	
	private function send_email($email, $subject, $message){
		$this->load->library('email');

		$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.bvcuba.pt',
			'smtp_user' => 'firedispatcher@bvcuba.pt',
			'smtp_pass' => 'a53uFJz^4ziX2BjVYU1Pph*C@LRuKR^X8&O4lo3S',
			'smtp_port' => 25,
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype'  => 'html', 
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		));

		$this->email->from($this->config->item('email'), $this->config->item('title'));
		$this->email->to($email);

		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
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
