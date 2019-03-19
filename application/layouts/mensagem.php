<?php
if( isset($_SESSION['MSG'])){ 
	switch ($_SESSION['MSG']){
    		case 1: // operacao 
    			$MSG = 'Operação realizado com sucesso.';
    			$IMG = 'sucesso';
    			break;
    			
    		case 2: // erro 
    			$MSG = 'Erro na Operação. Entre em contato com o administrador.';
    			$IMG = 'erro';
    			break;
			
			case 3: // contato
    			$MSG = 'Obrigado pelo contato, em breve entraremos em contato.';
    			$IMG = 'sucesso';
    			break;
			
			case 4: // contato
    			$MSG = 'Ouve uma falha ao enviar sua mensagem. Entre em contato com o administrador';
    			$IMG = 'erro';
    			break;
    		
    		case 5: // login
    			$MSG = 'Dados não conferem, efetue login novamente';
    			$IMG = 'erro';
    			break;
    		
    		case 6: // login
    			$MSG = 'Acesso negado, efetue seu login para ter acesso';
    			$IMG = 'erro';
    			break;
		
		case 7: // Autenticacao LDAP
    			$MSG = 'Erro na autenticação, verifique seu login e senha.';
    			$IMG = 'erro';
    			break;
			
			case 8: // Conecta AD
    			$MSG = 'Erro ao se conectar com o servidor.';
    			$IMG = 'erro';
    			break;
			
			case 9: // Erro na consulta do usuario no AD
    			$MSG = 'Erro na consulta do usuário.';
    			$IMG = 'erro';
    			break;
			
			case 10: // operacao 
    			$MSG = 'Inscrições realizadas com sucesso';
    			$IMG = 'sucesso';
    			break;
				
			case 11: // operacao 
    			$MSG = 'Inscrição cancelada com sucesso';
    			$IMG = 'sucesso';
    			break;
				
			case 12: // operacao 
    			$MSG = 'Evento desativado com sucesso';
    			$IMG = 'sucesso';
    			break;
                    case 13: // operacao 
    			$MSG = 'Desculpe,Você não tem acesso ao sistema';
    			$IMG = 'erro';
    			break;
                      case 14: // operacao 
    			$MSG = 'Seu usuários foi desativado, contate seu supervisor';
    			$IMG = 'erro';
    			break;
    	}
    	  	
    	echo '
            <div class="alert alert-block label-default fade in">
                <button type="button" class="close" data-dismiss="alert"></button>
                 <img class="img" title="Alterar" src="' . IMG . 'ajax/' . $IMG . '.png" border="0" />' . $MSG . '
            </div>';
    	unset( $_SESSION['MSG']);
}
?>