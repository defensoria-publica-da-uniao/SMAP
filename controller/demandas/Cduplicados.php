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


if (isset($_POST['confirmacao_duplicados'])) {
//Remoção(movimentação) de processos duplicados (do colaborador para o ADM)
    $explode = explode('@', $_POST['duplicados_confirmar']);

    $cont = 0;
    $data_acao = date('Y-m-d H:i:s');
    for ($i = 0; $i < count($explode); $i++) {
        if (!empty($explode[$i])) {

            $explode2 = explode(';', $explode[$i]);
            $id_documento_sei = $explode2[0];
            $destino_sei = utf8_decode($explode2[1]);
            $str_usr_criador = $_SESSION['usuario']['login'];
             
            $consulta = $oGeral->select_acompanhamento_especifico($id_documento_sei,$destino_sei);
            
            $resultId = mssql_fetch_array($consulta);

            $id_acompanhamento = $resultId['id_acompanhamento'];
            
            
            //Inserindo na tabela duplicados_confirmar
            $oGeral->insert('tb_dados_duplicados_confirmar', 'id_documento_sei,str_destino_sei,dt_acao,str_usr_criador', "'$id_documento_sei','$destino_sei','$data_acao','$str_usr_criador'");
            //Auditoria

            $dt_registro = date('Y-m-d H:i:s');
            $oGeral->insert('tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela, id_acompanhamento', "'$dt_registro','$str_usr_criador','20',$id_acompanhamento");
               
            $cont++;
        }
    }



    $_SESSION['alerta_duplicados'] = '<b>' . $cont . ' </b> Processos foram Mandados para Confirmação de Remoção';
    js_go(RAIZ . 'demandas/selecao');
} else {

    //Remoção de processos duplicados definitivo(feito pelo adm)
 
    $explode = explode('@', $_POST['duplicados']);

    $cont = 0;
    $data_acao = date('Y-m-d H:i:s');

 
    for ($i = 0; $i < count($explode); $i++) {
        if (!empty($explode[$i])) {

            $explode2 = explode(';', $explode[$i]);
            $id_documento_sei = $explode2[0];
            $destino_sei = utf8_decode($explode2[1]);
           
           
            //Buscando id_acompanhamento e destino_sei
            $consultaAcompanhamento=$oSmap->select_id_acompanhamento($id_documento_sei,$destino_sei);
            
            $resultAcompanhamento=mssql_fetch_array($consultaAcompanhamento);
            
          
            
            $id_acompanhamento=$resultAcompanhamento['id_acompanhamento'];
            $numero_doc_sei=$resultAcompanhamento['int_numero_sei'];
            
            
            //Inserindo na tabela duplicados
            $oGeral->insert('tb_dados_duplicados', 'id_documento_sei,str_destino_sei,dt_acao,id_acompanhamento,int_numero_doc_sei', "'$id_documento_sei','$destino_sei','$data_acao',$id_acompanhamento,$numero_doc_sei");

            $consulta = $oGeral->select_acompanhamento_especifico($id_documento_sei,$destino_sei);

            $resultId = mssql_fetch_array($consulta);

            $id_acompanhamento_sei = $resultId['id_acompanhamento'];
                
            //Exluindo da tabela acompanhamento
            $oSmap->delete_acompanhamento($id_documento_sei, $destino_sei);
                
            //Auditoria
            $str_usr_criador = $_SESSION['usuario']['login'];
            $dt_registro = date('Y-m-d H:i:s');

            if (isset($_POST['confirmar_remocao'])) {
                   
              
                
                //Remover da lista de à confirmar
                $oSmap->delete_dados_duplicados_confirmar($id_documento_sei, $destino_sei);
                
               
                
                //Registrar auditoria
                $oGeral->insert(
                        'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela, id_acompanhamento', "'$dt_registro','$str_usr_criador','22',$id_acompanhamento_sei"
                );
            } else {
                //Registrar auditoria
                $oGeral->insert(
                        'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela, id_acompanhamento', "'$dt_registro','$str_usr_criador','19',$id_acompanhamento_sei"
                );
            }

            $cont++;
        }
    }






    if (isset($_POST['confirmar_remocao'])) {
        $_SESSION['alerta_duplicados_confirmacao'] = '<b>' . $cont . ' </b> Processos foram removidos do sistema';
        js_go(RAIZ . 'administrador/confirmar_remocao');
    } else {
        $_SESSION['alerta_duplicados'] = '<b>' . $cont . ' </b> Processos foram removidos do sistema';
        js_go(RAIZ . 'demandas/selecao');
    }
}