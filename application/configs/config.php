
<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	 
	/************* CONSTANTES BANCO ***********/
	define('B_HOST','172.28.97.213:1437');
	define('B_USUARIO','usr_teste');
	define('B_SENHA','123456');
	define('B_BANCO','DB_SMAP'); 
        
	/********* CONSTANTES CAMADA - VISAO E REDIRECIONAMENTO ********/
	$PROTOCOLO = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === true) ? 'http' : 'https';
	define('PROTOCOLO', $PROTOCOLO);
	define('DIR', '/sistemas/smap/');
	define('SERVER', $_SERVER['SERVER_NAME']); 
	define('RAIZ', PROTOCOLO .'://'. SERVER . DIR); 
        
	define ('CSS', RAIZ . 'public/css/');
	define ('JS',  RAIZ . 'public/js/');
	define ('IMG', RAIZ . 'public/img/');
	define ('SWF', RAIZ . 'public/swf/');
	define ('ARQUIVOS', RAIZ . 'public/arquivos/');
	define ('AJAX', RAIZ . 'application/ajax/');
	define ('PUBLICO', RAIZ . 'public/');
        define ('ANEXO', RAIZ . 'ArquivosSEI/');


	
	define ('LAYOUTS', 'application/layouts/');
	define ('INCLUDES', 'application/includes/');
	define ('CONTROLLER', RAIZ. 'controller/');
       
		
	
	/********* Constantes a serem utilizadas na camada de - Controle ********/
	define ('MODELS',  '../model/');
	define ('CLASS_PHP',  '../application/class/');

?>