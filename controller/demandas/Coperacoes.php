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
//Update de dados (Novo acompanhamento)
if (!empty($_POST['update'])) {
    
    //Definando Origem
    $verifica_origem = @$_POST['id_secretaria_origem'];
    $verifica_origem2 = @$_POST['id_unidade_origem'];

    if (!empty($verifica_origem) || !empty($verifica_origem2)) {
        $id_secretaria_origem = @$_POST['id_secretaria_origem'];
        $id_unidade_origem = @$_POST['id_unidade_origem'];
        if (!empty($id_secretaria_origem)) {
            $campo_insert_origem_unidade_secretaria = 'id_secretaria';
            $value_insert_origem_unidade_secretaria = $id_secretaria_origem;
        } else {
            $campo_insert_origem_unidade_secretaria = 'id_unidade';
            $value_insert_origem_unidade_secretaria = $id_unidade_origem;
        }

        $inserir_origem = $oGeral->insert('tb_origem_destino', $campo_insert_origem_unidade_secretaria, "$value_insert_origem_unidade_secretaria");

        $pegar_id_origem = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
        $result_id_origem = mssql_fetch_array($pegar_id_origem);

        $id_origem = $result_id_origem['id_origem_destino'];
    }





    //Definando Destino
    $id_secretaria_destino = @$_POST['id_secretaria_destino'];
    $id_unidade_destino = @$_POST['id_unidade_destino'];

    if (!empty($id_secretaria_destino)) {
        $campo_insert_destino_unidade_secretaria = 'id_secretaria';
        $value_insert_destino_unidade_secretaria = $id_secretaria_destino;
    } else {
        $campo_insert_destino_unidade_secretaria = 'id_unidade';
        $value_insert_destino_unidade_secretaria = $id_unidade_destino;
    }

    $inserir_destino = $oGeral->insert('tb_origem_destino', $campo_insert_destino_unidade_secretaria, "$value_insert_destino_unidade_secretaria");

    $pegar_id_destino = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
    $result_id_destino = mssql_fetch_array($pegar_id_destino);

    $id_destino = $result_id_destino['id_origem_destino'];


    $situacao = $_POST['situacao'];
    $resumo = utf8_decode($_POST['resumo']);
    $id_acompanhamento = $_POST['id_acompanhamento'];
    $usr_criador = $_POST['usr_criador'];
    $dt_hoje = date("Y-m-d H:i:s");
    $id_protocolo = $_POST['id_protocolo'];
    $id_documento = $_POST['id_documento'];
    $protocolo_formatado = $_POST['protocolo_formatado'];
    //$id_unidade = $_POST['id_unidade'];
    $dt_prazo = $_POST['dt_prazo'];
    $dt_vencimento=$_POST['dt_vencimento'];
    $destino_sei = $_POST['destino_sei'];
    


    if (empty($dt_prazo)) {
        $dt_prazo = 'NULL';
    } else {
        $dt_prazo = date('Y-m-d', strtotime((str_replace('/', '-', $dt_prazo))));
        $dt_prazo = "'$dt_prazo'";
    }

    if (empty( $dt_vencimento)) {
         $dt_vencimento = 'NULL';
    } else {
         $dt_vencimento = date('Y-m-d', strtotime((str_replace('/', '-', $dt_vencimento))));
         $dt_vencimento = "'$dt_vencimento'";
    }

    //$sigla_unidade_auto = utf8_decode($_POST['sigla_unidade_auto']);



    $Result = $oGeral->select('tb_processo_sei', "WHERE id_processo_sei = $id_protocolo ");
    $Result = mssql_fetch_array($Result);

    //Atualizando o ultimo despacho para Inativo (0)
    $old_despacho = $oGeral->select('tb_historico_acompanhamento', "WHERE id_acompanhamento = $id_acompanhamento and int_estatus = 1", 'dt_criacao_acomp DESC');
    $old_despacho = mssql_fetch_array($old_despacho);

    $ultimo_id_historico = $old_despacho['id_historico_acompanhamento'];
//Atualizando o ultimo despacho feito para ficar inativo
    $update_acompanhamento_ultimo = $oGeral->update('tb_historico_acompanhamento', 'int_estatus=0', 'id_historico_acompanhamento', $ultimo_id_historico);


    //Update do Despacho(Novo resumo de despacho)
    $inseriracompahistori = $oGeral->insert('tb_historico_acompanhamento', 'id_acompanhamento,str_resumo,str_usr_criador,dt_criacao_acomp,id_origem_destino,int_situ,int_estatus', "$id_acompanhamento,'$resumo','$usr_criador','$dt_hoje',$id_destino,$situacao,1");
    // Atualizando o despacho 
    if (!empty($verifica_origem) || !empty($verifica_origem2)) {
        $update_acompanhamento = $oGeral->update('tb_acompanhamento', "dt_prazo=$dt_prazo,dt_vencimento=$dt_vencimento,id_origem_destino=$id_origem", 'id_acompanhamento', $id_acompanhamento);
    } else {
        $update_acompanhamento = $oGeral->update('tb_acompanhamento', "dt_prazo=$dt_prazo,dt_vencimento=$dt_vencimento", 'id_acompanhamento', $id_acompanhamento);
    }

    if ($inseriracompahistori == 1) {

        //InserÃ§Ã£o na tabela log
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador,id_acompanhamento,id_generica_tabela', "'$dt_hoje','$usr_criador','$id_acompanhamento','3'"
        );
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador,id_acompanhamento,id_generica_tabela', "'$dt_hoje','$usr_criador','$id_acompanhamento','2'"
        );

        $_SESSION['id_acompanhamento'] = $id_acompanhamento;
        $_SESSION['id_protocolo'] = $id_protocolo;
        $_SESSION['id_documento'] = $id_documento;
        $_SESSION['destino_sei'] = $destino_sei;
        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Processo $protocolo_formatado Atualizado !";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'demandas/exibedemanda_filtro');
    }
}
//Delete historico de acompanhamento
else if (!empty($_POST['delete'])) {
    
    $id_historico_acompanhamento = $_POST['id_historico_acompanhamento'];
    $id_acompanhamento = $_POST['id_acompanhamento'];
    $id_protocolo = $_POST['id_protocolo'];
    $id_documento = $_POST['id_documento_sei'];
    $int_estatus = $_POST['int_estatus'];
    $destino_sei=$_POST['destino_sei'];

 $delete = $oGeral->delete('tb_historico_acompanhamento', 'id_historico_acompanhamento', $id_historico_acompanhamento);
 
    if ($int_estatus == 1) {
        //Atualizando o ultimo despacho para Ativo (1)
        $old_despacho = $oGeral->select('tb_historico_acompanhamento', "WHERE id_acompanhamento = $id_acompanhamento", 'dt_criacao_acomp DESC');
        $old_despacho = mssql_fetch_array($old_despacho);

       $ultimo_id_historico = $old_despacho['id_historico_acompanhamento'];
        //Atualizando o ultimo despacho feito para ficar Ativo
        $update_acompanhamento_ultimo = $oGeral->update('tb_historico_acompanhamento', 'int_estatus=1', 'id_historico_acompanhamento', $ultimo_id_historico);  
    }
    
  
    if ($delete == 1) {
                  
        $str_usr_criador=$_SESSION['usuario']['login'];
        $dt_registro=date('Y-m-d H:i:s');
        
      $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador,id_acompanhamento,id_generica_tabela', "'$dt_registro','$str_usr_criador','$id_acompanhamento','4'"
        );
      
        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = 'Histórico de Acompanhamento excluido !';
        $_SESSION['deletesucesso'] = 1;
        $_SESSION['id_acompanhamento'] = $id_acompanhamento;
        $_SESSION['id_protocolo'] = $id_protocolo;
        $_SESSION['id_documento'] = $id_documento;
        $_SESSION['destino_sei'] = $destino_sei;

        js_go(RAIZ . 'demandas/exibedemanda_filtro');
    }
}
//Update historico de acompanhamento
else if (!empty($_POST['updatehistorico'])) {
    
 $dt_prazo = $_POST['dt_prazo'];
    if (empty($dt_prazo)) {
        $dt_prazo = 'NULL';
    } else {
        $dt_prazo = date('Y-m-d', strtotime((str_replace('/', '-', $dt_prazo))));
        $dt_prazo = "'$dt_prazo'";
    }
    
     $dt_vencimento = $_POST['dt_vencimento'];
    if (empty( $dt_vencimento)) {
        echo $dt_vencimento = 'NULL';
    } else {
         $dt_vencimento = date('Y-m-d', strtotime((str_replace('/', '-',  $dt_vencimento))));
         $dt_vencimento = "'$dt_vencimento'";
    }

    //Definando Origem
    $verifica_origem = @$_POST['id_secretaria_origem'];
    $verifica_origem2 = @$_POST['id_unidade_origem'];

    if (!empty($verifica_origem) || !empty($verifica_origem2)) {
        $id_secretaria_origem = @$_POST['id_secretaria_origem'];
        $id_unidade_origem = @$_POST['id_unidade_origem'];
        if (!empty($id_secretaria_origem)) {
            $campo_insert_origem_unidade_secretaria = 'id_secretaria';
            $value_insert_origem_unidade_secretaria = $id_secretaria_origem;
        } else {
            $campo_insert_origem_unidade_secretaria = 'id_unidade';
            $value_insert_origem_unidade_secretaria = $id_unidade_origem;
        }

        $inserir_origem = $oGeral->insert('tb_origem_destino', $campo_insert_origem_unidade_secretaria, "$value_insert_origem_unidade_secretaria");

        $pegar_id_origem = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
        $result_id_origem = mssql_fetch_array($pegar_id_origem);

        $id_origem = $result_id_origem['id_origem_destino'];
    }

    //Definando Destino
    $verifica_destino = @$_POST['id_secretaria_destino'];
    $verifica_destino2 = @$_POST['id_unidade_destino'];



    if (!empty($verifica_destino) || !empty($verifica_destino2)) {
        //Definando Destino
        $id_secretaria_destino = @$_POST['id_secretaria_destino'];
        $id_unidade_destino = @$_POST['id_unidade_destino'];

        if (!empty($id_secretaria_destino)) {
            $campo_insert_destino_unidade_secretaria = 'id_secretaria';
            $value_insert_destino_unidade_secretaria = $id_secretaria_destino;
        } else {
            $campo_insert_destino_unidade_secretaria = 'id_unidade';
            $value_insert_destino_unidade_secretaria = $id_unidade_destino;
        }

        $inserir_destino = $oGeral->insert('tb_origem_destino', $campo_insert_destino_unidade_secretaria, "$value_insert_destino_unidade_secretaria");

        $pegar_id_destino = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
        $result_id_destino = mssql_fetch_array($pegar_id_destino);

        $id_destino = $result_id_destino['id_origem_destino'];
    }

    $situacao = $_POST['situacao'];
    $resumo = utf8_decode($_POST['resumo']);

    $id_acompanhamento = $_POST['id_acompanhamento'];
    $id_documento = $_POST['id_documento'];
    $usr_criador = $_POST['usr_criador'];
    $dt_hoje = date("Y-m-d H:i:s");
    $id_historico_acompanhamento = $_POST['id_historico_acompanhamento'];
    $destino_sei=$_POST['destino_sei'];


    if (!empty($verifica_origem) || !empty($verifica_origem2)) {
        $update_acompanhamento = $oGeral->update('tb_acompanhamento', "dt_prazo=$dt_prazo,dt_vencimento=$dt_vencimento,id_origem_destino=$id_origem", 'id_acompanhamento', $id_acompanhamento);
    } else {
        $update_acompanhamento = $oGeral->update('tb_acompanhamento', "dt_prazo=$dt_prazo,dt_vencimento=$dt_vencimento", 'id_acompanhamento', $id_acompanhamento);
    }
    if (!empty($verifica_destino) || !empty($verifica_destino2)) {
        $updatefix = $oGeral->update('tb_historico_acompanhamento', "str_resumo='$resumo',str_usr_criador='$usr_criador',dt_criacao_acomp='$dt_hoje',int_situ=$situacao,id_origem_destino=$id_destino", 'id_historico_acompanhamento', $id_historico_acompanhamento);
    } else {
        $updatefix = $oGeral->update('tb_historico_acompanhamento', "str_resumo='$resumo',str_usr_criador='$usr_criador',dt_criacao_acomp='$dt_hoje',int_situ=$situacao", 'id_historico_acompanhamento', $id_historico_acompanhamento);
    }

    if ($updatefix == 1) {
        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = 'Histórico de Acompanhamento Atualizado !';
        $_SESSION['updatefixo'] = 1;

        $_SESSION['id_acompanhamento'] = $id_acompanhamento;
        $_SESSION['id_documento'] = $id_documento;
        $_SESSION['destino_sei'] = $destino_sei;

        js_go(RAIZ . 'demandas/exibedemanda_filtro');
    }
}
//Inserir novos dados
else {

$situacao =@$_POST['situacao'];
    if (empty($situacao)) {
        $situacao = 1;
    } 

    //Definando Origem
    $id_secretaria_origem = @$_POST['id_secretaria_origem'];
    $id_unidade_origem = @$_POST['id_unidade_origem'];
    if (!empty($id_secretaria_origem)) {
        $campo_insert_origem_unidade_secretaria = 'id_secretaria';
        $value_insert_origem_unidade_secretaria = $id_secretaria_origem;
    } else {
        $campo_insert_origem_unidade_secretaria = 'id_unidade';
        $value_insert_origem_unidade_secretaria = $id_unidade_origem;
    }

    $inserir_origem = $oGeral->insert('tb_origem_destino', $campo_insert_origem_unidade_secretaria, "$value_insert_origem_unidade_secretaria");

    $pegar_id_origem = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
    $result_id_origem = mssql_fetch_array($pegar_id_origem);

    $id_origem = $result_id_origem['id_origem_destino'];




    //Definando Destino
    $id_secretaria_destino = @$_POST['id_secretaria_destino'];
    $id_unidade_destino = @$_POST['id_unidade_destino'];

    if (!empty($id_secretaria_destino)) {
        $campo_insert_destino_unidade_secretaria = 'id_secretaria';
        $value_insert_destino_unidade_secretaria = $id_secretaria_destino;
    } else {
        $campo_insert_destino_unidade_secretaria = 'id_unidade';
        $value_insert_destino_unidade_secretaria = $id_unidade_destino;
    }

    $inserir_destino = $oGeral->insert('tb_origem_destino', $campo_insert_destino_unidade_secretaria, "$value_insert_destino_unidade_secretaria");

    $pegar_id_destino = $oGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
    $result_id_destino = mssql_fetch_array($pegar_id_destino);

    $id_destino = $result_id_destino['id_origem_destino'];


    $resumo = utf8_decode($_POST['resumo']);
    $id_documento = $_POST['id_documento'];
    $id_protocolo = $_POST['id_protocolo'];
    $protocolo_formatado = $_POST['protocolo_formatado'];
    $tipo_processo = utf8_decode($_POST['tipo_processo']);
    $conteudo = $_POST['conteudo'];

    $dta_despacho = $_POST['dta_despacho'];
    $dta_despacho = str_replace("/", "-", $dta_despacho);
    $dta_despacho = date('Y-m-d', strtotime($dta_despacho));
    $dta_assinatura = $_POST['dta_assinatura'];
    $dta_assinatura = str_replace("/", "-", $dta_assinatura);
    $dta_assinatura = date('Y-m-d', strtotime($dta_assinatura));

    $usr_criador = $_POST['usr_criador'];
    $dt_hoje = date("Y-m-d H:i:s");
    $dt_prazo = $_POST['dt_prazo'];
    $dt_vencimento= $_POST['dt_vencimento'];
    $numero_sei = $_POST['numero_sei'];
    $destino_sei = utf8_decode($_POST['sigla_unidade']);

    if (empty($dt_prazo)) {
        $dt_prazo = 'NULL';
    } else {
        $dt_prazo = date('Y-m-d', strtotime((str_replace('/', '-', $dt_prazo))));
        $dt_prazo = "'$dt_prazo'";
    }
     if (empty($dt_vencimento)) {
        $dt_vencimento = 'NULL';
    } else {
        $dt_vencimento = date('Y-m-d', strtotime((str_replace('/', '-', $dt_vencimento))));
        $dt_vencimento = "'$dt_vencimento'";
    }


    $Resultsei = $oGeral->select('tb_processo_sei', "WHERE id_processo_sei = $id_protocolo ");
    $Resultsei = mssql_fetch_array($Resultsei);
//Check ver se ja existe esse processo no banco 


    if ($Resultsei == false) {

        //Inserindo o novo Processo sei 
        $inserirsei = $oGeral->insert('tb_processo_sei', 'id_processo_Sei,str_protocol_formatado,str_tipo_processo', "$id_protocolo,'$protocolo_formatado','$tipo_processo'");
    }


    $Resultdoc_sei = $oGeral->select('tb_documento_sei', "WHERE id_documento_sei = $id_documento ");
    $Resultdoc_sei = mssql_fetch_array($Resultdoc_sei);
//Check ver se ja existe esse documento no banco 
    if ($Resultdoc_sei == false) {
        //Inserindo o Documento do Despacho
        $inserirdespacho = $oGeral->insert('tb_documento_sei', 'id_documento_sei,str_conteudo,dt_despacho,id_processo_sei,int_numero_sei,dt_assinatura', "$id_documento,'$conteudo','$dta_despacho',$id_protocolo,$numero_sei,'$dta_assinatura'");
    }

//Inserindo o Acompanhamento
    $inseriracompa = $oGeral->insert('tb_acompanhamento', 'id_documento_sei,dt_prazo,dt_vencimento,id_origem_destino,str_destino_sei,str_usr_criador', "$id_documento,$dt_prazo,$dt_vencimento,$id_origem,'$destino_sei','$usr_criador'");

//Pegando o ultimo Id da tabela acompanhamento    
    $lastIdR = $oGeral->select('tb_acompanhamento', null, 'id_acompanhamento desc');
    $lastIddados = mssql_fetch_array($lastIdR);
    $lastId = $lastIddados['id_acompanhamento'];

//Inserindo o Historico  Acompanhamento
    $inseriracompahistori = $oGeral->insert('tb_historico_acompanhamento', 'id_acompanhamento,str_resumo,str_usr_criador,dt_criacao_acomp,id_origem_destino,int_situ,int_estatus', "$lastId,'$resumo','$usr_criador','$dt_hoje',$id_destino,$situacao,1");

    if ($inseriracompa == 1 && $inseriracompahistori == 1) {

        $_SESSION['id_acompanhamento'] = $lastId;
        $_SESSION['id_protocolo'] = $id_protocolo;
        $_SESSION['id_documento'] = $id_documento;
        $_SESSION['id_documento'] = $id_documento;
        $_SESSION['destino_sei'] = $destino_sei;
        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Processo $protocolo_formatado Acompanhado !";
        $_SESSION['insertsucesso'] = 1;
        js_go(RAIZ . 'demandas/exibedemanda_filtro');
    }
}




