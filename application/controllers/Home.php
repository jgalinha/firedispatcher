<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index(){
        
        if($this->session->userdata('login') === TRUE)
        {
            $this->dashboard();
        }
        else
        {
            redirect('conta/entrar');
        }
    }
    
	public function dashboard()	{
        
        $data['main_view'] = "dashboard_view";
        $data['footer_view'] = 'footer_view';
        
		$this->load->view('template/main', $data);
	}
}