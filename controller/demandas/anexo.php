<?php
session_start();
require_once '../../application/configs/config.php';
@$anexo = $_SESSION['link'];
$destino='../../public/anexos/anexosei';
unset($_SESSION['link']);

if (@copy($anexo, $destino)){
  
} else {
    echo 'erro!!!!!!!';
    exit;
}

unset($_SESSION['link']);

?>
