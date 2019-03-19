<?php 
    //require_once INCLUDES . 'validaLogin.php';
    require_once 'controller/alert.php'; 

    js_alert('O endereço especificado não foi encontrado');  
    js_go('javascript:window.history.go(-1)');
?>