<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {
    
    public function ativar($id) {
        $alerta = null;
        if($this->session->userdata('login') === TRUE)
        {
            redirect('home');
        }
        else
        {
            $this->load->model('utilizadores_model', 'users');
            $user = $this->users->get_user_by_id($id);
            
            
            if ($user['activated'] === 0)
            {
                $activar = $this->users->activar_conta($user['user']);
                
                if($activar) {
                    $alerta = array(
                        "class" => "success",
                        "cabeçalho" => "Conta Confirmada!",
                        "mensagem" => "A sua conta foi confirmada.<br>Espera até que um administrador a active." . validation_errors()
                    );
                } else {
                    $alerta = array(
                        "class" => "warning",
                        "cabeçalho" => "Erro!",
                        "mensagem" => "Ocorreu um erro durante a activação.<br>Tente novamente." . validation_errors()
                    );
                }
            } else {
                $alerta = array(
                    "class" => "danger",
                    "cabeçalho" => "Erro!",
                    "mensagem" => "A sua conta já se encontra activada, faça login." . validation_errors()
                );
            }
            
            $dados = array (
                "alerta" => $alerta
            );
            $this->load->view('conta/login_view', $dados);
        }
    }
    
    public function registar(){
        $alerta = null;
        if($this->session->userdata('login') === TRUE)
        {
            redirect('home');
        }
        else
        {
            if($this->input->post('registar') === "registar"){
                if($this->input->post('captcha')) redirect('conta/registar');
                
                $this->form_validation->set_rules('utilizador', 'Utilizador', 'trim|required|numeric|max_length[8]|min_length[7]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
                $this->form_validation->set_rules('passwordConfirm', 'Confirmação da Password', 'required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('firstname', 'Primeiro Nome', 'required');
                $this->form_validation->set_rules('lastname', 'Último Nome', 'required');
                
                if($this->form_validation->run() === TRUE){
                    $this->load->model('utilizadores_model', 'users');
                    
                    $utilizador = $this->input->post('utilizador');
                    $email = $this->input->post('email');
                    
                    $mecanografico = $this->users->check_mecanografico($utilizador);
                    
                    if($mecanografico === FALSE){
                        
                        $email = $this->users->check_email($email);
                        if($email === FALSE) {
                            
                            $hash = password_hash($this->input->post('password'), $this->config->item('password_algorithm'), $this->config->item('password_options'));
                            
                            $dados_utilizador = array(
                                'user' =>  $this->input->post('utilizador'),
                                'firstName' => $this->input->post('firstname'),
                                'lastName' => $this->input->post('lastname'),
                                'type' => null,
                                'pwd' => $hash,
                                'email' =>  $this->input->post('email'),
                                'roles' => null,
                                'status' => 0,
                                'activated' => 0,
                                'photo' => null
                            );
                            
                            $user_insert = $this->users->insert_user($dados_utilizador);
                            
                            if ($user_insert) {
                                
                                $inserted_id = $this->cimongo->insert_id();

                                $this->load->library('email');

                                $this->email->initialize(array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'mail.bvcuba.pt',
                                    'smtp_user' => 'geral@bvcuba.pt',
                                    'smtp_pass' => 'gerbvc',
                                    'smtp_port' => 25,
                                    'crlf' => "\r\n",
                                    'newline' => "\r\n",
                                    'mailtype'  => 'html', 
                                    'charset' => 'utf-8',
                                    'wordwrap' => TRUE
                                ));
                                
                                $link = base_url('/conta/ativar/') . "/" . $inserted_id;

                                $this->email->from($this->config->item('email'), $this->config->item('title'));
                                $this->email->to($dados_utilizador['email']);

                                $this->email->subject('Ativação de conta');
                                $this->email->message('Caro(a) '. $dados_utilizador['firstName'] . ' ' . $dados_utilizador['lastName'] . '<br><br>' . 'Obrigado por se ter registado no FireDispatcher.<br>Para ativar a sua conta aceda ao <a href="'. $link . '">link</a> e conclua o processo.');

                                $this->email->send();

                                $this->log($dados_utilizador['user'], 'new user', $dados_utilizador);

                                $alerta = array(
                                    "class" => "success",
                                    "cabeçalho" => "Sucesso!",
                                    "mensagem" => "O utilizador foi criado com sucesso!<br>Receberá um email com o link para ativação da conta." . validation_errors()
                                );
                                
                            } else {
                                $alerta = array(
                                    "class" => "danger",
                                    "cabeçalho" => "Erro!",
                                    "mensagem" => "Houve um erro na criação da sua conta, tente novamente!<br>Obrigado." . validation_errors()
                                );
                            }                         
                            
                        } else {
                            //Email já existe
                            $alerta = array(
                                "class" => "danger",
                                "cabeçalho" => "Erro!",
                                "mensagem" => "O email introduzido já existe!<br>" . validation_errors()
                            );
                        }
                        
                    } else {
                        //Mecanográfico já existe
                        $alerta = array(
                            "class" => "danger",
                            "cabeçalho" => "Erro!",
                            "mensagem" => "O utilizador introduzido já existe!<br>" . validation_errors()
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
            }
            
            $dados = array (
                "alerta" => $alerta
            );
            $this->load->view('conta/sign_in_view', $dados);
        }
    }

    public function sair() {
        
        
        $user = $this->session->userdata('user');
        $this->log($user, 'logout');
        $this->session->sess_destroy();
        redirect('conta/entrar');
    }

	public function entrar(){
        
        $alerta = null;
        
        if($this->input->post('entrar') === "entrar"){
            if($this->input->post('captcha')) redirect('conta/entrar');
            
            $this->form_validation->set_rules('utilizador', 'utilizador', 'trim|required|numeric|max_length[8]|min_length[7]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[20]');
            if($this->form_validation->run() === TRUE){
                $this->load->model('utilizadores_model', 'users');
                $this->load->model('log_model');
                
                $utilizador = $this->input->post('utilizador');
                $password = $this->input->post('password');
                
                $login = $this->users->check_login($utilizador, $password);
                
                if($login){
                    $utilizador = $login;
                    
                    if($utilizador['activated'] == 1){
                        
                        if($utilizador['status'] == 1){
                    
                            $session = array(
                                'user' => $utilizador['user'],
                                'firstName' => $utilizador['firstName'],
                                'lastName' => $utilizador['lastName'],
                                'login' => TRUE,
                                'lock' => FALSE
                            );

                            $this->session->set_userdata($session);
                            $this->log($utilizador['user'], 'login', $session);

                            redirect('home');
                            
                        } else {
                            //CONTA NÃO ATIVADA
                            $alerta = array(
                                "class" => "warning",
                                "cabeçalho" => "Erro!",
                                "mensagem" => "A sua conta não se encontra ativada<br>" . validation_errors()
                            );
                        }
                        
                    } else {
                        //CONTA NÃO CONFIRMADA
                        $alerta = array(
                            "class" => "warning",
                            "cabeçalho" => "Erro!",
                            "mensagem" => "A sua conta não se encontra confirmada<br>" . validation_errors()
                        );
                    }
                    
                } else {
                    //LOGIN INVALIDO
                    $alerta = array(
                        "class" => "danger",
                        "cabeçalho" => "Erro!",
                        "mensagem" => "Dados de login incorrectos<br>" . validation_errors()
                    );
                }
                
            } else {
                //ERRO NO PREENCHIMENTO DO FORMULARIO
                $alerta = array(
                    "class" => "danger",
                    "cabeçalho" => "Erro!",
                    "mensagem" => "Erro no login!<br>" . validation_errors()
                );
            }
        }
        
        $dados = array (
            "alerta" => $alerta
        );
        
        $this->load->view('conta/login_view', $dados);
	}
    
    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }
}