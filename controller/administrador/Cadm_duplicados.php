<?php
if(isset($_POST['id_duplicados_confirmar'])){
    //Retirada do Processo da lista de Confirmação de Exclusão
session_start();
require_once '../alert.php';
require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';
require_once '../' . MODELS . 'cSmap.php';
require_once '../' . MODELS . 'cSei.php';

$oGeral = new cGeral(); 
$oSmap = new cSmap();
$oSei = new cSei();
 
$id_duplicado_confirmar=$_POST['id_duplicados_confirmar'];
$deletar_duplicado=$oGeral->delete('tb_dados_duplicados_confirmar','id_duplicados_confirmar', $id_duplicado_confirmar);
   $str_usr_criador = $_SESSION['usuario']['login'];
            $dt_registro = date('Y-m-d H:i:s');
  $oGeral->insert(
                    'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','21'"
            );
  
if($deletar_duplicado==true){
    $_SESSION['alerta_duplicados_confirmacao']='Processo Retirado da lista de Confirmação';
        js_go(RAIZ . 'administrador/confirmar_remocao');
}
    
}
else{
$consultarSql=$objSmap->dados_duplicados_confirmar();
$duplicados_total= mssql_num_rows($consultarSql);
}