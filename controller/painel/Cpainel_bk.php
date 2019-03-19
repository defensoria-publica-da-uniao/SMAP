<?php

if (empty($_POST)) {


    //Busca Demandas SGE



    $arDocumento = array();
    $arCancelados = array();
    $arDespachos = array();
    $resultD = $objSei->buscaDocumento_sei();
    $contD = 1;
    $destino = null;
    $chavesSei = Array();

    $resultCancelados = $objSei->buscaDocumentoCancelado_sei();
    while ($arDadosC = mssql_fetch_array($resultCancelados)) {
        $arCancelados[] = $arDadosC['id_origem'];
    }

    while ($arDadosD = mssql_fetch_array($resultD)) {
        $idProtocolo = $arDadosD['id_protocolo'];
        $dtAssinaturaDocumento = date('Y.m.d', strtotime($arDadosD['data_inicio_tramite']));
        $resultA = $objSei->buscaDestinoDocumento_sei($idProtocolo, $dtAssinaturaDocumento);
        $destino = null;
        $chaveD = $arDadosD['id_documento_sei'];

        if (!in_array($chaveD, $arDocumento) and ! in_array($chaveD, $arCancelados)) {
            while (@$arDestino = mssql_fetch_array($resultA)) {
                $arDespachos[$contD]['id_documento_sei'] = $arDadosD['id_documento_sei'];
                $contD++;
                $chavesSei[] = $arDadosD['id_documento_sei'] . $arDestino['destino'];
            }//fim while de destinos
        }//fim array de documentos já passados no laço
        $arDocumento[] = $chaveD;
    }// fim while documento

    $Seicont = count($arDespachos);

    //Buscar na base Demandas Abertas DPGU E UNIDADE
    $Resulttotal = $objSmap->select_demandas_geral('1', '15');
    $aberto_total = mssql_num_rows($Resulttotal);


    //Buscar na base Demandas Resolvidas DPGU
    $ResultRdpgu = $objSmap->select_demandas_dpgu('3', '15');
    $DpguR = mssql_num_rows($ResultRdpgu);

    //Buscar na base Demandas Em andamento DPGU
    $ResultAdpgu = $objSmap->select_demandas_dpgu('2', '15');
    $DpguA = mssql_num_rows($ResultAdpgu);



    $Sdpgu = $DpguR + $DpguA;

    @$ProdpguR = ($DpguR * 100) / $Sdpgu;
    $ProdpguR = substr($ProdpguR, 0, 5);
    @$ProdpguA = ($DpguA * 100) / $Sdpgu;
    $ProdpguA = substr($ProdpguA, 0, 5);


//Buscar na base Demandas Resolvidas Unidades
    $ResultRunidade = $objSmap->select_damandas_unidades2('3', '15');
    $unidadeR = mssql_num_rows($ResultRunidade);



    //Buscar na base Demandas Em Andamento Unidades
    $ResultAunidade = $objSmap->select_damandas_unidades2('2', '15');
    $unidadeA = mssql_num_rows($ResultAunidade);


    $Somaunidade = $unidadeR + $unidadeA;

    @$ProunidadeR = ($unidadeR * 100) / $Somaunidade;
    $ProunidadeR = substr($ProunidadeR, 0, 5);
    @$ProunidadeA = ($unidadeA * 100) / $Somaunidade;
    $ProunidadeA = substr($ProunidadeA, 0, 5);



    //Alertas Pendencias
    $dataatual = date("Y-m-d ");

    $dias = Array(15, 30, 60);
    $intervalo = Array(30, 60);
    $parar = 0;
    //id de todos os acompanhamentos 
    $arID_acompanhamento = Array();
    //Numero de todos os processos
    $arstr_processo = Array();

    $cont = array(0, 0, 0);
    $condicao_alerta_tempo = Array();
    $diferenca_dias = Array();
    //Id dos processos que tem restrição de tempo
    $arid_tempo = Array();
    for ($i = 0; $i < 3; $i++) {


        //Condição para 15 e 30 dias
        if ($parar < 2) {
            $periodo1 = $objSmap->diminuiDias($dias[$i]);
            $periodo2 = $objSmap->diminuiDias($intervalo[$i]);
            $Result2 = $objSmap->selectrel_pendencias_alerta_pendencia_periodo($periodo2, $periodo1);
            $parar++;
        }//Condição para 60 dias
        else {
            $periodo = $objSmap->diminuiDias($dias[$i]);
            $Result2 = $objSmap->selectrel_pendencias_alerta_pendencia($periodo);
        }
        while ($arDados = mssql_fetch_array($Result2)) {
            if (@!in_array(@$arDados['id_acompanhamento'], $arID_acompanhamento)) {
                $arstr_processo[] = $arDados['str_protocol_formatado'];
                $cont[$i] ++;
                $arID_acompanhamento[] = $arDados['id_acompanhamento'];
                $condicao_alerta_tempo[] = $dias[$i];
                $arid_tempo[] = $arDados['id_acompanhamento'];

                //Calcular a diferença do ultimo acompanhamento para hoje
                $data_convertida = date("Y-m-d", strtotime($arDados['dt_criacao_acomp']));
                // Calcula a diferença em segundos entre as datas
                $diferenca = strtotime($dataatual) - strtotime($data_convertida);
                //Calcula a diferença em dias
                $diferenca_dias[] = floor($diferenca / (60 * 60 * 24));
            }
        }
    }



    //Alertas Tipos processos
    $tipos = Array('Ações Judiciais', 'Pedido de Acesso à Informação - SIC', 'Contratos - Aditivo/Renovação/Rescisão ', 'Imóvel - Reforma');
    //Dados dos processos dos "tipos"
     $dados_processos_tipos = array();
    //Id dos acompanhamento dos "tipos"
    $arID_acompanhamento2 = array();
    $cont2 = array(0, 0, 0, 0);

    for ($i = 0; $i < count($tipos); $i++) {
        $Result3 = $objSmap->selectrel_pendencias_alerta_tipos(utf8_decode(($tipos[$i])));

        while ($arDados = mssql_fetch_array($Result3)) {
            
                
                $dados_processos_tipos[$tipos[$i]]['protocol_formatado'][] = $arDados['str_protocol_formatado'];
                $data_convertida = date("Y-m-d", strtotime($arDados['dt_criacao_acomp']));
                // Calcula a diferença em segundos entre as datas
                $diferenca = strtotime($dataatual) - strtotime($data_convertida);
               //Calcula a diferença em dias
                $dados_processos_tipos[$tipos[$i]]['diferenca_dias'][] = floor($diferenca / (60 * 60 * 24));
                
                $cont2[$i] ++;
                 
            
        }
    }

//Soma total de todos os alertas
    $soma_total_alertas = array_sum($cont) + array_sum($cont2);
    

  /*
    echo'<pre>';
    var_dump($dados_processos_tipos);
    
    echo $dados_processos_tipos;

*/

}
