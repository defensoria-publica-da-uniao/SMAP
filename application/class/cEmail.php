<?php 
	require_once 'class.phpmailer.php';
		
	class cEmail extends PHPMailer{
		
		function envio($assunto, $nome, $email){  die(45);
			$body 				= $this->getFile( INCLUDES . 'email/alteraSenha.php');
			$body             	= eregi_replace("[\]",'',$body);
			$this->IsSendmail();
			$this->From       = "desen.coinf@dpu.gov.br";
			$this->FromName   = "Desenvolvimento";
			$this->Subject    	= "{$assunto}";
			$this->AltBody    	= "{$body}"; // optional, comment out and test
			$this->MsgHTML($body);
			$this->AddAddress("$email", "$nome");
			return $mail->Send();
		}
		
		
	}

?>