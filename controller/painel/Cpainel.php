<?php

if (empty($_POST)) {


    //Busca Demandas SGE



    $arDocumento = array();
    $arCancelados = array();
    $arDespachos = array();
    //$resultD = $objSei->buscaDocumento_sei();
    $contD = 1;
    $destino = null;
    $chavesSei = Array();
/*
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
 * 
 */

    //Buscar na base Demandas Abertas DPGU E UNIDADE
    $Resulttotal = $objSmap->selectcampgrafico('1', '30');
    $aberto_total = mssql_num_rows($Resulttotal);


    //Buscar na base Demandas Resolvidas DPGU
    $ResultRdpgu = $objSmap->select_demandas_dpgu('3', '30');
    $DpguR = mssql_num_rows($ResultRdpgu);

    //Buscar na base Demandas Em andamento DPGU
    $ResultAdpgu = $objSmap->select_demandas_dpgu('2', '30');
    $DpguA = mssql_num_rows($ResultAdpgu);



    $Sdpgu = $DpguR + $DpguA;

    @$ProdpguR = ($DpguR * 100) / $Sdpgu;
    $ProdpguR = substr($ProdpguR, 0, 5);
    @$ProdpguA = ($DpguA * 100) / $Sdpgu;
    $ProdpguA = substr($ProdpguA, 0, 5);


//Buscar na base Demandas Resolvidas Unidades
    $ResultRunidade = $objSmap->select_damandas_unidades2('3', '30');
    $unidadeR = mssql_num_rows($ResultRunidade);



    //Buscar na base Demandas Em Andamento Unidades
    $ResultAunidade = $objSmap->select_damandas_unidades2('2', '30');
    $unidadeA = mssql_num_rows($ResultAunidade);


    $Somaunidade = $unidadeR + $unidadeA;

    @$ProunidadeR = ($unidadeR * 100) / $Somaunidade;
    $ProunidadeR = substr($ProunidadeR, 0, 5);
    @$ProunidadeA = ($unidadeA * 100) / $Somaunidade;
    $ProunidadeA = substr($ProunidadeA, 0, 5);



    //Alertas Tipos processos
    //Pegando o nome do alerta (tipo dele) e o icone
    $dataatual = date("Y-m-d ");
    $sqlTipos = $objSmap->select_alertas();
    $tipos = Array();
    $contTipos = 0;
    while ($arTipos = mssql_fetch_array($sqlTipos)) {
        $tipos[$contTipos]['nome'] = $arTipos['str_nome_tipo'];
        $tipos[$contTipos]['icone'] = $arTipos['str_nome_icone'];

        $contTipos++;
    }

    //Pegando a quantidade de alertas que existem para a contagem final
    $cont2 = array();
    for ($p = 0; $p < count($tipos); $p++) {
        $cont2[$p] = 0;
    }

    //Dados dos processos dos "tipos"
    $dados_processos_tipos = array();
    //Id dos acompanhamento dos "tipos"
    $id_tipos = array();
    $cont3 = 0;
    for ($i = 0; $i < count($tipos); $i++) {
        $Result3 = $objSmap->selectrel_pendencias_alerta_tipos(($tipos[$i]['nome']));

        while ($arDados = mssql_fetch_array($Result3)) {

               
            if(!empty($arDados['dt_prazo'])){
                //echo'tenho dt prazo';
              $data_prazo = $arDados['dt_prazo'];
          
                $diferenca = strtotime($data_prazo) - strtotime($dataatual) ;
             (int)$dados_processos_tipos[$cont3]['dt_prazo'] = floor($diferenca / (60 * 60 * 24));
             $id_tipos[] = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
          
            }else {
                // valor simbolico diferente de 0 ou maior que 0 ou menor que 0
                 (int)$dados_processos_tipos[$cont3]['dt_prazo'] = 1999;
            }
            
            $data_convertida = date("Y-m-d", strtotime($arDados['dt_criacao_acomp']));
            $diferenca = strtotime($dataatual) - strtotime($data_convertida);
            $dados_processos_tipos[$cont3]['diferenca'] = floor($diferenca / (60 * 60 * 24));
            
            $dados_processos_tipos[$cont3]['protocolo'] = $arDados['str_protocol_formatado'];
            $dados_processos_tipos[$cont3]['tipo'] = $tipos[$i]['nome'];
            $dados_processos_tipos[$cont3]['id_acompanhamento'] = $arDados['id_acompanhamento'];
            $dados_processos_tipos[$cont3]['id_documento_sei'] = $arDados['id_documento_sei'];
            $dados_processos_tipos[$cont3]['str_destino_sei'] = $arDados['str_destino_sei'];
            
            

           // $id_tipos[] = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
            $cont2[$i] ++;

            $cont3++;
        }
    }
 
    




    //Alertas Sem movimentação


    $dias = Array(15, 30, 60);
    $intervalo = Array(29, 59);
    $parar = 0;
    //id de todos os acompanhamentos 
    $dados_alertas = Array();
    $cont = array(0, 0, 0);
    $cont4 = 0;

    for ($z = 0; $z < 3; $z++) {


        //Condição para 15 e 30 dias
        if ($parar < 2) {
            $periodo1 = $objSmap->diminuiDias($dias[$z]);
            $periodo2 = $objSmap->diminuiDias($intervalo[$z]);

            $Result2 = $objSmap->selectrel_pendencias_alerta_pendencia_periodo($periodo2, $periodo1);
            $parar++;
        }//Condição para 60 dias
        else {
            $periodo = $objSmap->diminuiDias($dias[$z]);
            $Result2 = $objSmap->selectrel_pendencias_alerta_pendencia($periodo);
        }
        while ($arDados = mssql_fetch_array($Result2)) {
           
            $dados_alertas[$cont4]['id_chave'] = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
            $dados_alertas[$cont4]['tempo'] = $dias[$z];
            $dados_alertas[$cont4]['protocolo'] = $arDados['str_protocol_formatado'];
            //Calcular a diferença do ultimo acompanhamento para hoje
            $data_convertida = date("Y-m-d", strtotime($arDados['dt_vencimento']));
            $diferenca = strtotime($dataatual) - strtotime($data_convertida);
            $dados_alertas[$cont4]['diferenca'] = floor($diferenca / (60 * 60 * 24));

            $dados_alertas[$cont4]['id_acompanhamento'] = $arDados['id_acompanhamento'];
            $dados_alertas[$cont4]['id_documento_sei'] = $arDados['id_documento_sei'];
            $dados_alertas[$cont4]['str_destino_sei'] = $arDados['str_destino_sei'];

            $cont4++;
            $cont[$z] ++;
        }
    }
 
    $sql_dtprazo=$objSmap->select_dt_prazo();



//Soma total de todos os alertas
      $soma_total_alertas = array_sum($cont2);
    $soma_total_parados= array_sum($cont);


  
//Data para painel
   $data_painel=date("d/m/Y");
    $data_30=$objSmap->diminuiDias(30);
    $data_convertida2 = date("d/m/Y", strtotime($data_30));
    $data_final_painel= $data_convertida2.' À '. $data_painel;

}
