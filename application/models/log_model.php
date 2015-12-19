<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model 
{
    public function log($utilizador, $movement, $log)
    {
        $dados = array(
            'movement' => $movement,
            'user' => $utilizador,
            'log' => $log
        );
        $this->cimongo->insert('log', $dados);
    }
}