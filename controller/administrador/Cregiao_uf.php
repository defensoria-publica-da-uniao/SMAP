<?php
require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cSmap.php';

$oSmap = new cSmap();

//var_dump($_GET);    

if (!empty($_GET)) {
    $regiao = $_GET['regiao'];
    $result = $oSmap->consultacombo_estados($regiao);
    
    
}
else {
    //require_once '../../controller/alert.php';
    //js_go('javascript:window.history.go(-1)');
    exit;
}

?>



