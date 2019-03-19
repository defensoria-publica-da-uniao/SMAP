<?php
require_once '../application/configs/config.php';
require_once 'cBanco.php';

class cLogin extends cBanco{
	
	private $login;
	private $senha;
	private $idUsuario;
	
	/* 
	* verificando login do usuario
	*/
	public function login($arrDadosForm){
		$this->sql = " SELECT id_usuario, ds_login, ds_senha 
						FROM usuario
						WHERE ds_login = '". $arrDadosForm['ds_login'] ."'
						AND ds_senha   = '". md5($arrDadosForm['ds_senha']) . "'"; 
		return $this->query();
	}
	
	/*
	* validando login do usuario
	*/
	public function validaLogin(){
		$this->sql = " SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['id_usuario'] . " AND senha = '" . $_SESSION['ds_senha'] . "'";
		$rs = $this->query();
		return $rs;
	}
	
}

?>