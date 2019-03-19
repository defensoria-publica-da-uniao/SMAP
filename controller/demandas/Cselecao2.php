<?php

if (!empty($_POST) OR isset($_SESSION['filtro_dt_despacho'])) {
    if (!empty($_POST)) {
        if(isset($_POST['reiniciar'])) {
          unset($_SESSION['filtro_dt_despacho']);
        js_go('selecao');
          exit;
        } else {
            $dt_despacho = $_POST['dt_processo'];}
    } else {
        $explode=explode('/',$_SESSION['filtro_dt_despacho']);
        $dt_despacho=$explode[2].'-'.$explode[1].'-'.$explode[0];
        //echo $dt_despacho = date('Y-m-d', strtotime($_SESSION['filtro_dt_despacho']));
    }
    $arDocumento = array();
    $arCancelados = array();
    $arDespachos = array();


    $resultD = $objSei->buscaDocumento_sei_esp($dt_despacho);

    $contD = 1;
    $destino = null;

    $resultCancelados = $objSei->buscaDocumentoCancelado_sei_esp($dt_despacho);
    while ($arDadosC = mssql_fetch_array($resultCancelados)) {
        $arCancelados[] = $arDadosC['id_origem'];
    }

    while ($arDadosD = mssql_fetch_array($resultD)) {
        $idProtocolo = $arDadosD['id_protocolo'];
        $dtAssinaturaDocumento = date('Y.m.d', strtotime($arDadosD['data_inicio_tramite']));
        $resultA = $objSei->buscaDestinoDocumento_sei_esp($idProtocolo, $dt_despacho, $dtAssinaturaDocumento);
        $destino = null;
        $chaveD = $arDadosD['id_documento_sei'];

        if (!in_array($chaveD, $arDocumento) and ! in_array($chaveD, $arCancelados)) {
            while (@$arDestino = mssql_fetch_array($resultA)) {

                $arDespachos[$contD]['id_documento_sei'] = $arDadosD['id_documento_sei'];
                $arDespachos[$contD]['id_protocolo'] = $arDadosD['id_protocolo'];
                $arDespachos[$contD]['protocolo_formatado'] = $arDadosD['protocolo_formatado'];
                $arDespachos[$contD]['tipo_processo'] = utf8_encode($arDadosD['tipo_processo']);
                $arDespachos[$contD]['conteudo'] = $arDadosD['conteudo'];
                $arDespachos[$contD]['dt_assinatura_documento'] = date('d/m/Y H:i:s', strtotime($arDadosD['data_inicio_tramite']));
                $arDespachos[$contD]['dt_despacho'] = date('d/m/Y H:i:s', strtotime($arDestino["data_inicio_tramite"]));
                $arDespachos[$contD]['sigla_unidade'] = $arDestino['destino'];
                $arDespachos[$contD]['numero_sei'] = $arDadosD['nr_documento'];
                $arDespachos[$contD]['tipo_documento'] = utf8_encode($arDadosD['nome']);
                $contD++;
            }//fim while de destinos
        }//fim array de documentos já passados no laço
        $arDocumento[] = $chaveD;
    }// fim while documento


    $Resultacomp = $objSmap->selectcamp('id_documento_sei,str_destino_sei', 'tb_acompanhamento');
    $idacompanhamento = Array('0');
    while ($array = mssql_fetch_array($Resultacomp)) {
        $idacompanhamento[] = $array[0] . $array[1];
    };
    
    $sqlDadosduplicados=$objGeral->select('tb_dados_duplicados');
        $idDuplicados = Array('0');
         while ($array2 = mssql_fetch_array($sqlDadosduplicados)) {
        $idDuplicados[] = $array2['str_chave'];
    };

    $_SESSION['filtro_dt_despacho'] = date('d/m/Y', strtotime($dt_despacho));
}
?>



