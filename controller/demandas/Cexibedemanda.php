<?php

if (!empty($_POST) || !empty($_SESSION['deletesucesso']) || !empty($_SESSION['updatesucesso']) || !empty($_SESSION['insertsucesso']) || !empty($_SESSION['updatefixo']) || $p1 == 'alerta') {
    if ($pagina == 'exibedemanda_filtro') {
        if (!empty($_SESSION['deletesucesso']) || !empty($_SESSION['updatesucesso']) || !empty($_SESSION['insertsucesso']) || !empty($_SESSION['updatefixo'])) {
            $id_acompanhamento = $_SESSION['id_acompanhamento'];
            $id_documento_sei = $_SESSION['id_documento'];
            $destino_sei = $_SESSION['destino_sei'];
            unset($_SESSION['insertsucesso']);
            unset($_SESSION['updatesucesso']);
            unset($_SESSION['deletesucesso']);
            unset($_SESSION['updatefixo']);
            unset($_SESSION['id_acompanhamento']);
            unset($_SESSION['id_protocolo']);
            unset($_SESSION['id_documento']);
            unset($_SESSION['destino_sei']);
        } else if ($p2 <> 'inicio') {
            $id_acompanhamento = $p2;
            $id_documento_sei = $p3;
            $destino_sei = $p4;
        } else {
           
           $id_acompanhamento = $_POST['id_acompanhamento'];
           $id_documento_sei = $_POST['id_documento_sei'];
           $destino_sei = $_POST['destino_sei'];
        }


        $result = $objSmap->selectjoin2($id_acompanhamento, $id_documento_sei);

        $id_protocolo = 0;


        while ($arDados = mssql_fetch_array($result)) {

            $protocolo_formatado = $arDados['str_protocol_formatado'];
            if ($id_protocolo == 0) {
                $id_protocolo = $arDados['id_processo_sei'];
            }
            $tipo_processo = $arDados['str_tipo_processo'];
            $anotacao = $arDados['str_anotacao'];
            $dta_assinatura = $arDados['dt_assinatura'];
            $conteudo = $arDados['str_conteudo'];
            $dta_despacho = $arDados['dt_despacho'];
            $situacao = $arDados['int_situ'];
            $resumo = $arDados['str_resumo'];
            $dt_acomp = $arDados['dt_criacao_acomp'];
            $str_user = $arDados['str_usr_criador'];
            $numero_sei = $arDados['int_numero_sei'];
            $destino_sei = $arDados['str_destino_sei'];
            
            if ($arDados['dt_prazo'] == NULL) {
                $dta_prazo = "Sem data de prazo";
            } else {
                $dta_prazo = $arDados['dt_prazo'];
                $dta_prazo = date('d/m/Y', strtotime($dta_prazo));
            }
            
             if ($arDados['dt_vencimento'] == NULL) {
                $dta_vencimento = "Sem data de vencimento";
            } else {
                 $dta_vencimento = $arDados['dt_vencimento'];
                 $dta_vencimento = date('d/m/Y', strtotime( $dta_vencimento));
            }
            //Dados origem
            if (!empty($arDados['secretaria_descricao'])) {
                $origem = $arDados['secretaria_sigla'] . ' - ' . utf8_encode($arDados['secretaria_descricao']);
            } else {
                $origem = $arDados['uf_origem'] . ' - ' . utf8_encode($arDados['unidade_descricao']);
            }

            //Dados destinos
            if (!empty($arDados['secretaria_descricao_destino'])) {
                $destino = $arDados['secretaria_sigla_destino'] . ' - ' . utf8_encode($arDados['secretaria_descricao_destino']);
            } else {
                $destino = $arDados['uf_destino'] . ' - ' . utf8_encode($arDados['unidade_descricao_destino']);
            }

            @$id_unidade = $arDados['id_unidade'];
            if ($situacao == 2) {
                $situ2 = "checked='checked'";
            } else if ($situacao == 3) {
                $situ3 = "checked='checked'";
            } else if ($situacao == 1) {
                $situ1 = "checked='checked'";
            } else if ($situacao == 4) {
                $situ4 = "checked='checked'";
            }
        }

        $result2 = $objSmap->selectcamp2($id_documento_sei, $destino_sei);
        $total = mssql_num_rows($result2);

        $resulthistorisei = $objSei->selecthistoricosei($id_protocolo);
        $resulthistoridocumento = $objSei->selecthistoricodocumento($id_protocolo);
       
        //Selecionando o 1º criador e o ultimo do historico de acompanhamento
          $dados_primeira_modificao=$objSmap->ultima_modificao_processo(1,$id_acompanhamento);
        $data_criacao=date('d/m/Y H:i:s',strtotime($dados_primeira_modificao['dt_criacao_acomp']));
        $criador=$dados_primeira_modificao['str_usr_criador'];
        
       $dados_ultima_modificao=$objSmap->ultima_modificao_processo(2,$id_acompanhamento);
        $dt_ultima_modificao=date('d/m/Y H:i:s',strtotime($dados_ultima_modificao['dt_criacao_acomp']));
        $ultimo_criador=$dados_ultima_modificao['str_usr_criador'];
        
        
    }

    //Vindo da pagina de seleção do sei
    else {

        $id_documento = $_POST['id_documento_sei'];
        $id_protocolo = $_POST['id_protocolo'];
        $protocolo_formatado = $_POST['protocolo_formatado'];
        //$anotacao = $_POST['anotacao'];
        $tipo_processo = $_POST['tipo_processo'];
        $conteudo = $_POST['conteudo'];
        
        $dta_despacho = $_POST['dta_despacho'];
        $dta_despacho = str_replace("/", "-", $dta_despacho);
        $dta_despacho = date('d/m/Y', strtotime($dta_despacho));

        $dta_assinatura = $_POST['dta_assinatura'];
        $dta_assinatura = str_replace("/", "-", $dta_assinatura);
        $dta_assinatura = date('d/m/Y', strtotime($dta_assinatura));
        //$id_unidade = $_POST['id_unidade'];
        $sigla_unidade = $_POST['sigla_unidade'];
        // $descricao = $_POST['descricao'];
        // $nome = $_POST['nome'];
        // $sigla_uf = $_POST['sigla_uf'];
        $numero_sei = $_POST['numero_sei'];

        $result2 = $objSei->selecthistoricosei($id_protocolo);
        $resulthistoridocumento = $objSei->selecthistoricodocumento($id_protocolo);
    }
}
//Ajax
else if (!empty($_GET)) {
    
    $idunidades_origem = $_GET['origem'];
    $idunidades_destinos = $_GET['destino'];

    require_once '../../application/configs/config.php';
    require_once '../' . MODELS . 'cGeral.php';
    require_once '../' . MODELS . 'cSmap.php';
    require_once '../' . MODELS . 'cSei.php';

    $oSei = new cSei();
    $oSmap = new cSmap();

    if (@$idunidades_origem == 'DPGU') {
        $result = $oSmap->consultacombo_DPGU('id_secretaria_origem',0 );
    } else if (@$idunidades_origem == 'DPU') {        
        $result = $oSmap->consultacombo_DPU('id_unidade_origem',0);
    } else if (@$idunidades_destinos == 'DPGU') {
        $result = $oSmap->consultacombo_DPGU('id_secretaria_destino',0);
    } else if (@$idunidades_destinos == 'DPU') {
        $result = $oSmap->consultacombo_DPU('id_unidade_destino', 0);
    } else if (@$idunidades_destinos == 'DPU_email') {
        $result = $oSmap->consultacombo_DPU_email('email');
    } else if (@$idunidades_destinos == 'DPGU_email') {
        $result = $oSmap->consultacombo_DPGU_email('email');
    }
    
} else if (empty($_POST)) {
    
    require_once 'controller/alert.php';
    js_go('javascript:window.history.go(-1)');
    exit;
}

/*
  // Pegando informações das unidades para jogar no autocomplete
  $result3 = $objSei->selectunidasei();
  $nome_unidade = ARRAY();
  while ($arUnidade = mssql_fetch_array($result3)) {
  $nome_unidade[] = utf8_encode($arUnidade['sigla']);
  }
 * 
 * vai na view : 
  <input class="form-control form-control-inline input-medium " id="tags" name="sigla_unidade_auto" placeholder="Defina o Destino">

 * 
 */
?>

