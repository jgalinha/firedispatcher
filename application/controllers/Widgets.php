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

    private function log($user, $movement, $log = null){
        $this->load->model('log_model');
        $this->log_model->log($user, $movement, $log);
    }
}