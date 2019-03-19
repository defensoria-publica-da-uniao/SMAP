<?php

if (!empty($_POST)) {


    $destino_sel = $_POST['destino_sel'];
    $dt_ini = $_POST['dt_ini'];
    $dt_ini = date('Y-m-d', strtotime((str_replace('/', '-', $dt_ini))));
    $dt_fin = $_POST['dt_fin'];
    $dt_fin = date('Y-m-d', strtotime((str_replace('/', '-', $dt_fin))));
    $situacao = $_POST['situacao'];

    $id_secretaria_destino = @$_POST['id_secretaria_destino'];
    $id_unidade_destino = @$_POST['id_unidade_destino'];

    
    $Consulta_duplicados=$objSmap->dados_duplicados_confirmar();
    $arDuplicadoschave=Array();

    while($idDados_duplicados= mssql_fetch_array($Consulta_duplicados)){
    $arDuplicadoschave[]=$idDados_duplicados['id_documento_sei'].''.$idDados_duplicados['str_destino_sei'];
    }

    if (empty($situacao)) {
        $situ1 = '2';
        $situ2 = '3';
        $situ_nome = 'Em Andamento / Concluido';
    } else if ($situacao == 1) {
        $situ1 = '1';
        $situ2 = '0';
        $situ_nome = 'Aberto';
    } else if ($situacao == 2) {
        $situ1 = '2';
        $situ2 = '0';
        $situ_nome = 'Em andamento';
    } else if ($situacao == 3) {
        $situ1 = '3';
        $situ2 = '0';
        $situ_nome = 'Concluido';
    } else if ($situacao == 4) {
        $situ1 = '4';
        $situ2 = '0';
        $situ_nome = 'Ciente';
    }

    //Pegando o id do acompanhamento para pegar os históricos
    if (!empty($id_secretaria_destino)) {
        // @$periodo = $objSmap->diminuiDias($periodo);
        $Result = $objSmap->selectrel_demandas_secretaria_id($id_secretaria_destino, $dt_ini, $dt_fin, $situ1, $situ2);
        $contarray = mssql_num_rows($Result);
    } else if (!empty($id_unidade_destino)) {
        //@$periodo = $objSmap->diminuiDias($periodo);
        $Result = $objSmap->selectrel_demandas_unidades_id($id_unidade_destino, $dt_ini, $dt_fin, $situ1, $situ2);
        $contarray = mssql_num_rows($Result);
    }


    $id_documento = ARRAY();
    $id_protocolo = ARRAY();
    $id_acompanhamento_fix = ARRAY();
    $id_acompanhamento = ARRAY();
    $destino_inicial = Array();

    
    $protocolo_formatado = ARRAY();
    $assunto = ARRAY();
    $uni_origem = ARRAY();
    $dt_despacho = ARRAY();
    $unidade_final = ARRAY();
    $movimentacao = ARRAY();

    $resumo = ARRAY();
    $situ_final = ARRAY();

    $x = 0;
    while ($arId = mssql_fetch_array($Result)) {

        $id = $arId['id_acompanhamento'];
        //Pegando dados do histórico do acompanhamento          
        //ATENÇÃO:    Nome da consulta abaixo está errado. Pois a consulta pega todos os históricos de acompanhamentos.
        $pegar_dados = $objSmap->selectrel_pendencias($id);

        //Pegando Origem do acompanhamento
        $pegar_origem = $objSei->acompanhamento_origem($id);
        $origem_resul = mssql_fetch_array($pegar_origem);

        if (!empty($origem_resul['str_sigla'])) {
            $uni_origem[] = $origem_resul['str_sigla'];
        } else {
            $uni_origem[] = $origem_resul['str_uf'] . ' - ' . utf8_encode($origem_resul['str_descricao']);
        }

        while ($arDados = mssql_fetch_array($pegar_dados)) {

            //Iniciando a listagem dos  relatorios
            $chave = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
          
            // echo '<br/>';
            if (empty($id_documento)) {
                $id_documento[] = $chave;

                $protocolo_formatado[] = $arDados['str_protocol_formatado'];
                $assunto[] = $objSmap->trataDemandas($arDados['str_conteudo']);

                $dt_despacho[] = date('d/m/Y ', strtotime($arDados['dt_despacho']));
                if (!empty($arDados['str_sigla'])) {
                    $destino_final[] = $arDados['str_sigla'];
                    $destino_resumo = $arDados['str_sigla'];
                } else {
                    $destino_final[] = $arDados['str_uf'] . ' - ' . $arDados['str_descricao'];
                    $destino_resumo = $arDados['str_uf'] . ' - ' . $arDados['str_descricao'];
                }
                //retirando caracteres especificos na consulta
                $resumo_limpo = str_replace('"', " ", $arDados['str_resumo']);
                //FIM retirando caracteres especificos na consulta
                //colocando <br> em algumas váriavéis 
                // $resumo_limpo = str_replace('[','<br /><br />[',$resumo_limpo);
                //$resumo[] = '<b>Data:</b>&nbsp;' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:</b>&nbsp;' . utf8_encode($resumo_limpo) . '<br><b>Destino:</b>&nbsp;' . $destino_resumo . '<br><br>';
                $resumo_temp = utf8_encode($resumo_limpo) . '<br>';

                //Ver quantos [(Data de resumos) existem no resumo
                $contagem_especial = substr_count($resumo_temp, '[');
                $resumo_corrigido = '';
                $explode = explode("[", $resumo_temp);
//pulando linha a cada resumo novo
                for ($h = 0; $h <= $contagem_especial; $h++) {
                    if (empty($resumo_corrigido)) {
                        //Colocando -8 pois estava acrescentenado [ a mais (Bug?)
                        $resumo_corrigido = "-/*" . $explode[$h];
                    } else {
                        $resumo_corrigido = $resumo_corrigido . '' . '[' . $explode[$h];
                    }
                }
                //limpando -8;
                $resumo[] = trim(str_replace('-/*', '', $resumo_corrigido));

                $movimentacao[] = date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp']));
                $situ_final[] = $arDados['int_situ'];
            }// Dando Continuidade no relatório
            else {
                // Caso haja um novo despacho no loop 

                if (!in_array($chave, $id_documento)) {
                    $id_documento[] = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];

                    $protocolo_formatado[] = $arDados['str_protocol_formatado'];
                    $assunto[] = $objSmap->trataDemandas($arDados['str_conteudo']);

                    $dt_despacho[] = date('d/m/Y ', strtotime($arDados['dt_despacho']));
                    if (!empty($arDados['str_sigla'])) {
                        $destino_final[] = $arDados['str_sigla'];
                        $destino_resumo = $arDados['str_sigla'];
                    } else {
                        $destino_final[] = $arDados['str_uf'] . ' - ' . $arDados['str_descricao'];
                        $destino_resumo = $arDados['str_uf'] . ' - ' . $arDados['str_descricao'];
                    }
                    //retirando caracteres especificos na consulta
                    $resumo_limpo = str_replace('"', " ", $arDados['str_resumo']);
                    //FIM retirando caracteres especificos na consulta
                    //colocando <br> em algumas váriavéis 
                    // $resumo_limpo = str_replace('[','<br /><br />[',$resumo_limpo);
                    // $resumo[] = '<b>Data:</b>&nbsp;' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:</b>&nbsp;' . utf8_encode($resumo_limpo) . '<br><b>Destino:</b>&nbsp;' . @$arDados['str_sigla'] . '<br><br>';
                    $resumo_temp = utf8_encode($resumo_limpo) . '<br>';

                    //Ver quantos [(Data de resumos) existem no resumo
                    $contagem_especial = substr_count($resumo_temp, '[');
                    $resumo_corrigido = '';
                    $explode = explode("[", $resumo_temp);
//pulando linha a cada resumo novo
                    for ($h = 0; $h <= $contagem_especial; $h++) {
                        if (empty($resumo_corrigido)) {
                            //Colocando -8 pois estava acrescentenado [ a mais (Bug?)
                            $resumo_corrigido = "-/*" . $explode[$h];
                        } else {
                            $resumo_corrigido = $resumo_corrigido . '' . '[' . $explode[$h];
                        }
                    }
                    //limpando -8;
                    $resumo[] = str_replace('-/*', '', $resumo_corrigido);

                    $movimentacao[] = date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp']));
                    $situ_final[] = $arDados['int_situ'];
                }//Caso Um despacho que ja passou no loop tenha mais de um histórico 
                else if (in_array($chave, $id_documento)) {


                    for ($i = 0; $i < count($id_documento); $i++) {
                        $chavetemp = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
                        if ($chavetemp == $id_documento[$i]) {

                            if (!empty($arDados['str_sigla'])) {
                                $destino = $arDados['str_sigla'];
                            } else {
                                $destino = $arDados['str_uf'] . ' - ' . utf8_encode($arDados['str_descricao']);
                            }
                            //retirando caracteres especificos na consulta
                            $resumo_limpo = str_replace('"', " ", $arDados['str_resumo']);
                            //FIM retirando caracteres especificos na consulta
                            //colocando <br> em algumas váriavéis 
                            //   $resumo_limpo = str_replace('[','<br /><br />[',$resumo_limpo);
                            // $resumo[$i] = $resumo[$i] . '<b>Data:</b>&nbsp;' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:</b>&nbsp;' . utf8_encode($resumo_limpo) . '<br><b>Destino:</b>&nbsp;' . $destino . '<br><br>';
                            $resumo_temp = utf8_encode($resumo_limpo) . '<br>';

                            //Ver quantos [(Data de resumos) existem no resumo
                            $contagem_especial = substr_count($resumo_temp, '[');
                            $resumo_corrigido = '';
                            $explode = explode("[", $resumo_temp);
//pulando linha a cada resumo novo
                            for ($h = 0; $h <= $contagem_especial; $h++) {
                                if (empty($resumo_corrigido)) {
                                    //Colocando -8 pois estava acrescentenado [ a mais (Bug?)
                                    $resumo_corrigido = "-/*" . $explode[$h];
                                } else {
                                    $resumo_corrigido = $resumo_corrigido . '' . '[' . $explode[$h];
                                }
                            }
                            //limpando -8;
                            $resumo_final = str_replace('-/*', '', $resumo_corrigido);

                            $resumo[$i] = $resumo[$i] . $resumo_final . '<br>';
                        }
                    }
                }
            }
        }
    }
    /*
      echo '<pre>';
      var_dump($id_documento);
      var_dump($protocolo_formatado);
      var_dump($assunto);
      var_dump($dt_despacho);
      var_dump($unidade);
      var_dump( $resumo);
      var_dump( $situ_final);
     * 
     */


    // HTML da página que vai gerar o PDF
    include_once 'view/relatorios/rel_demandas_pdf.php';
    // FIM HTML da página que vai gerar o PDF
}
?>

