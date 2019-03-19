<?php
/**  REFERENCIA: 
	 * http://www.gilbertoalbino.com/url-amigaveis-com-php-e-apache-um-padrao-de-projeto-de-software/ 
	 */
	require_once "application/configs/config.php";  
	require_once "cRoteadorUrl.php"; 
	$oRoteador = new cRoteadorUrl(); 
	
	$modulo = $oRoteador->modulo();
	$pagina = $oRoteador->pagina();
	$p1 = $oRoteador->p1();
	$p2 = $oRoteador->p2();
	$p3 = $oRoteador->p3();
	$p4 = $oRoteador->p4();
	$p5 = $oRoteador->p5();
	$p6 = $oRoteador->p6();
	
	$request = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $urls    = 'view/'. $modulo . '/' . $pagina . '.php';
   
   
    if(file_exists($urls)) {
		$urlRedirect = $urls;
	}
    else {
	echo "<script>location.href='".RAIZ."erro/inicio'; </script>";
		exit;
     
	}



?>