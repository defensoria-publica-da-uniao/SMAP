<?php
	require '../application/class/class.phpmailer.php';
	
	class cEnviaEmail{
	
		public $nome;
		public $email;
		public $telefone;
		public $assunto;
		public $mensagem;
		public $acao;
           	
	public function enviaEmail(){
		$mail = new PHPMailer();
		// mandar via SMTP
		$mail->IsSMTP(); 
		// Definindo charse da mensagem
		$mail->Charset =  'utf-8';
		// Seu servidor smtp
		$mail->Host = "webmail.luzianiamix.com.br"; 		
		// Porta de comunicação com o servidor de e-mail
		$mail -> Port = 587;
		// habilita smtp autenticado
		$mail->SMTPAuth = true; 
		// usuário deste servidor smtp
		$mail->Username = "contato@luzianiamix.com.br"; 
		$mail->Password = "tiago1984"; // senha
		//email utilizado para o envio 
		$mail->From = "contato@luzianiamix.com.br";
		
		
		//Email com copia oculta
		//$mail->AddBcc("machado84@gmail.com");
		
		//Enderecos que devem ser enviadas as mensagens
                if($this->acao == 'esqueciMinhaSenha'){
                    $mail->FromName = ucwords('luzianiaMIX');
                    $mail->AddAddress($this->email, 'luzianiaMIX');
                } else{
                    $mail->FromName = ucwords($this->nome);
                    $mail->AddAddress("contato@luzianiamix.com.br","luzianiaMIX");
		}
		//wrap seta o tamanhdo do texto por linha
		$mail->WordWrap = 50; 
		//anexando arquivos no email
		$mail->AddAttachment("anexo/arquivo.zip"); 
		$mail->AddAttachment("imagem/foto.jpg");
		$mail->IsHTML(true); //enviar em HTML
		
		// recebendo os dados do formulario
                $nome     = ucwords($this->nome);
                $email 	  = $this->email;
                $telefone = $this->telefone;
                $assunto  = $this->assunto;
                $mensagem = $this->mensagem;
                // informando a quem devemos responder 
                //ou seja para o mail inserido no formulario
                $mail->AddReplyTo($this->email, $this->nome);
                //criando o codigo html para enviar no email
               
                if($this->acao == 'esqueciMinhaSenha'){ // alteração de senha
                        $msg = $this->mensagem;
                }
                else{ // formulario de contato geral
                        $msg  = "luzianiaMix.com.br<hr>";
                        $msg .= "<b> Nome: </b>". $this->nome ."<br>\n";
                        $msg .= "<b> E-mail: </b>". $this->email ."<br>\n";
                        $msg .= "<b> Telefone: </b>". $this->telefone ."<br>\n";
                        $msg .= "<b> Assunto: </b>". $this->assunto ."<br>\n";
                        $msg .= "<hr>\n";
                        $msg .= "<b> Mensagem: </b>" . $this->mensagem . "<br>\n";
                }
		//$mail->Subject = "ASSUNTO DO EMAIL";
		$mail->Subject = $this->assunto;
		
		//adicionando o html no corpo do email
		$mail->Body = $msg;
		//enviando e retornando o status de envio
		if(!$mail->Send()){
			return false;
		}
		else{
			return true;
		}			 
	
	}
}	
?>