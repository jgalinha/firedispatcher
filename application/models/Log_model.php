<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model 
{
    public function log($utilizador, $movement, $log)
    {
        $dados = array(
            'movement' => $movement,
            'user' => $utilizador,
			'date' => new MongoDate(),
            'log' => $log
        );
        $this->cimongo->insert('log', $dados);
    }
	
	public function getLogs($object = false){
		$query = $this->cimongo->get('log');
		if($query->num_rows() > 0){
			if(!$object){
				$result = $query->result_array();
			} else {
				$result = $query->result_object();
			}
			return $result;
		}
		return FALSE;
	}
}