<?php
session_start();
require_once '../alert.php';
require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';
require_once '../' . MODELS . 'cBanco.php';
require_once '../' . MODELS . 'cSmap.php';
require_once '../' . MODELS . 'cSei.php';
$oGeral = new cGeral();
$oBanco = new cBanco();
$oSmap = new cSmap();
$oSei = new cSei();

$id_historico_acompanhamento = $_POST['id_acompanhamento_fixo'];
$select = $oSmap-> selecthist($id_historico_acompanhamento);
$arDados = mssql_fetch_array($select);
$id_documento=$arDados['id_documento_sei'];
$id_acompanhamento=$arDados['id_acompanhamento'];
$destino_sei=$arDados['str_destino_sei'];

//echo "<pre>";
//var_dump($arDados);
//exit();

if ($arDados['int_situ'] == 2) {
    $situ2 = "Checked='checked'";
} else if ($arDados['int_situ'] == 3) {
    $situ3 = "Checked='checked'";
}else if ($arDados['int_situ'] == 1) {
     $situ1 = "Checked='checked'";
}else {
     $situ4 = "Checked='checked'";
}
if (!empty($arDados['dt_alert_ini'])) {
    $dt_ini = date('d/m/Y', strtotime($arDados['dt_alert_ini']));
} else {
    $dt_ini = NULL;
}if (!empty($arDados['dt_alert_fin'])) {
    $dt_fin = date('d/m/Y', strtotime($arDados['dt_alert_fin']));
} else {
    $dt_fin = NULL;
}if (!empty($arDados['dt_alert_unica'])) {
    $dt_unica = date('d/m/Y', strtotime($arDados['dt_alert_unica']));
} else {
    $dt_unica = NULL;
}if (!empty($arDados['dt_prazo'])) {
    $dt_prazo = $arDados['dt_prazo'];
} else {
    $dt_prazo = NULL;
}
if (!empty($arDados['dt_vencimento'])) {
  $dt_vencimento = $arDados['dt_vencimento'];
} else {
    $dt_vencimento = NULL;
}


include '../../application/ajax/processaAjax.php';
?>


