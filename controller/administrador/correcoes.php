<?php
session_start();
require_once '../alert.php';
require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';
require_once '../' . MODELS . 'cSmap.php';
require_once '../' . MODELS . 'cSei.php';

$oGeral = new cGeral();
$oSmap = new cSmap();
$oSei = new cSei();

//Selecionando o Documento mais atual
$docsei=$_POST['int_numero_sei'];
$consultaDadosHistorico=$oSmap->select_hitorico_acompanhamento($docsei);
$dadosHistorico= mssql_fetch_array($consultaDadosHistorico);

$ultimo_historico=$dadosHistorico['id_historico_acompanhamento'];
//Update estatus todos para 0;
$update0=$oSmap->update_hitorico_acompanhamento($docsei);

if($update0==true){
//Realizando update para 1 no estatus do ultimo historico
$correcao=$oGeral->update('tb_historico_acompanhamento','int_estatus=1','id_historico_acompanhamento',$ultimo_historico );
    
}


if($correcao==true){
    
    $_SESSION['correcao_doc_sei']='Documento Sei <b>'.$docsei.'</b> Corrigdo';
        js_go(RAIZ . 'administrador/correcaoEstatusDocumento');
}else{
    
}

?>
