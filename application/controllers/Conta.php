<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('login'))
        {
            redirect('home');
        }
    }

    //TODO: retirar confirmação de login em todas as funções para verificar se o construtor funciona
    public function update_password(){
        $alerta = null;
        if($this->input->post('recuperar') === "recuperar"){
            if($this->input->post('captcha')) redirect('conta/recuperar_password');
            if($this->input->post('email_hash') != sha1($this->input->post('email') . $this->input->post('email_code')))
                die('Erro na actualização da password!');

            $this->form_validation->set_rules('email_hash', 'email_hash', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('passwordConfirm', 'Confirmação da Password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if($this->form_validation->run() === TRUE){

                $this->load->model('utilizadores_model', 'users');

                $update = $this->users->update_password_by_email($this->input->post('email'), $this->input->post('password'));
                $user = $this->users->get_user_by_email($this->input->post('email'));
                if($update) {                    
                    $this->log($user['user'], 'Actualização da password', $update);                    
                    $alerta = array(
                        "class" => "success",
                        "cabeçalho" => "Sucesso!",
                        "mensagem" => "A sua password foi actualizada com sucesso, faça login!"
                    );
                    $dados = array (
                        "alerta" => $alerta
                    );
                    $this->load->view('conta/login_view', $dados);
                } else {
                    $this->log($user['user'], 'Actualização da password', $update);   
                    $alerta = array(
                        "class" => "danger",
                        "cabeçalho" => "Erro!",
                        "mensagem" => "Erro na actualização da password! " . validation_errors()
                    );
                    $dados = array (
                        "alerta" => $alerta
                    );
                    $this->load->view('conta/login_view', $dados);
                }

            } else {
                $alerta = array(
                    "class" => "danger",
                    "cabeçalho" => "Erro!",
                    "mensagem" => "Erro na actualização da password! " . validation_errors()
                );
                $dados = array (
                    "alerta" => $alerta
                );
                $this->load->view('conta/login_view', $dados);
            }            
        }
    }

    public function recuperar_password(){

        $alerta = null;
        if($this->session->userdata('login') === TRUE)
        {
            redirect('home');
        }
        else
        {
            if($this->input->post('recuperar') === "recuperar"){
                if($this->input->post('captcha')) redirect('conta/entrar');

                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                if($this->form_validation->run() === TRUE){
                    $this->load->model('utilizadores_model', 'users');

                    $email = $this->input->post('email');
                    if($this->users->check_email($email)){

                        $this->send_reset_password_email($email);   
                        $user = $this->users->get_user_by_email($email);
                        $this->log($user['user'], "Pedido de Reset Password");
                        $alerta = array(
                            "class" => "success",
                            "cabeçalho" => "Sucesso!",
                            "mensagem" => "Foi-lhe enviado um email com as indicações para recuperar a sua password!<br>" . validation_errors()
                        );

                    } else {
                        //ERRO NO PREENCHIMENTO DO FORMULARIO
                        $alerta = array(
                            "class" => "danger",
                            "cabeçalho" => "Erro!",
                            "mensagem" => "Insira um email válido!<br>" . validation_errors()
                        );
                    }
                } else {
                    //ERRO NO PREENCHIMENTO DO FORMULARIO
                    $alerta = array(
                        "class" => "danger",
                        "cabeçalho" => "Erro!",
                        "mensagem" => "Email não registado!<br>" . validation_errors()
                    );
                }
            }

            $dados = array (
                "alerta" => $alerta
            );

            $this->load->view('conta/recuperar_password_view', $dados);
        }

    }

    public function reset_password($email, $hash){
        $alerta = null;
        if(isset($email, $hash)){
            $this->load->model('utilizadores_model', 'users');

            $email = trim($email);
            $email_hash = sha1($email . $hash);
            $check_email = $this->users->verify_reset_password_hash($email, $hash);

            if($check_email){
                $dados = array (
                    "alerta" => $alerta,
                    "email_hash" => $email_hash,
                    "email_code" => $hash,
                    "email" => $email
                );

                $this->load->view('conta/reset_password_view', $dados);
            } else {
                $alerta = array(
                    "class" => "danger",
                    "cabeçalho" => "Erro!",
                    "mensagem" => "Ocorreu um problema com o seu link, tente novamente!<br>" . validation_errors()
                );

                $dados = array (
                    "alerta" => $alerta,
                    "email" => $email
                );

                $this->load->view('conta/recuperar_password_view', $dados);
            }
        }    

    }

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
                    $this->log($user['user'], 'Activação de Conta');
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
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
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

    public function entrar(){

        $alerta = null;
        if($this->session->userdata('login') === TRUE)
        {
            redirect('home');
        }
        else
        {
            if($this->input->post('entrar') === "entrar"){
                if($this->input->post('captcha')) redirect('conta/entrar');

                $this->form_validation->set_rules('utilizador', 'utilizador', 'trim|required|numeric|max_length[8]|min_length[7]');
                $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[20]');
                if($this->form_validation->run() === TRUE){
                    $this->load->model('utilizadores_model', 'users');

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
                        $this->log($utilizador, 'erro no login');
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
    }

    private function send_reset_password_email($email){

        $this->load->model('utilizadores_model', 'users');
        $this->load->library('email');
        $user = $this->users->get_user_by_email($email);
        $hash = md5($this->config->item('Encryption_Key') . $user['firstName']);

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

        $link = base_url('/conta/reset_password/') . "/" . $email . '/' . $hash;

        $this->email->from($this->config->item('email'), $this->config->item('title'));
        $this->email->to($email);

        $this->email->subject('Recuperação de Password');
        $message = '<!DOCTYPE html PUBLIC><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    </head><body>';
        $message .= '<p>Caro(a) '. $user['firstName'] . ' ' . $user['lastName'] . '</p>';
        $message .= '<p>Queremos ajuda-lo a recuperar a sua password. Por-favor <a href="'. $link . '">clique aqui</a>.</p>';
        $message .= '<p>Obrigado!</p>';
        $message .= '<p>A Equipa do ' . $this->config->item('title') . '</p>';
        $message .= '</body></html>';

        $this->email->message($message);

        $this->email->send();
    }

    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }
}