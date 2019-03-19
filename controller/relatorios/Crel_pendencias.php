<?php

if (!empty($_POST)) {
    $destino_sel = $_POST['destino_sel'];
  $periodo = $_POST['periodo'];
  $periodopdf=$periodo;
    $intervalo = 0;
    if ($periodo == 15) {
        $intervalo = 29;
    } else if ($periodo == 30) {
        $intervalo = 59;
    } else {
    $intervalo = 1;
    }
    
    $id_secretaria_destino = @$_POST['id_secretaria_destino'];
    $id_unidade_destino = @$_POST['id_unidade_destino'];

    //Pegando o id do acompanhamento para pegar os históricos
    if (!empty($id_secretaria_destino)) {
        if ($intervalo == 1) {
           $periodo = $objSmap->diminuiDias($periodo);
            $Result = $objSmap->selectrel_pendencias_secretaria_id($id_secretaria_destino, $periodo);
        } else {
            $periodo = $objSmap->diminuiDias($periodo);
             $periodo2 = $objSmap->diminuiDias($intervalo);
            $Result = $objSmap->selectrel_pendencias_secretaria_id2($id_secretaria_destino, $periodo,$periodo2);
        }
        $contarray = mssql_num_rows($Result);
    } else if (!empty($id_unidade_destino)) {
        if ($intervalo == 1) {
             $periodo = $objSmap->diminuiDias($periodo);
             $Result = $objSmap->selectrel_pendencias_unidades_id($id_unidade_destino, $periodo);
        } else {
            $periodo = $objSmap->diminuiDias($periodo);
             $periodo2 = $objSmap->diminuiDias($intervalo);
            $Result = $objSmap->selectrel_pendencias_unidades_id2($id_unidade_destino, $periodo,$periodo2);
        }
        $contarray = mssql_num_rows($Result);
    }

    $id_documento = ARRAY();
    $id_protocolo = ARRAY();
    $id_acompanhamento_fix = ARRAY();
    $id_acompanhamento = ARRAY();
    $destino_final = Array();


    $protocolo_formatado = ARRAY();
    $assunto = ARRAY();
    $uni_origem = ARRAY();
    $dt_despacho = ARRAY();
    $unidade_final = ARRAY();
    $movimentacao = ARRAY();

    $resumo = ARRAY();
    $situ_final = ARRAY();



    while ($arId = mssql_fetch_array($Result)) {

        $id = $arId['id_acompanhamento'];
        //Pegando dados do histórico do acompanhamento
        // ATENÇÃO:    Nome da consulta abaixo está errado. Pois a consulta pega todos os históricos de acompanhamentos.
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
              $chave=$arDados['id_documento_sei'].$arDados['str_destino_sei'];
              
            if (empty($id_documento)) {
                $id_documento[] = $arDados['id_documento_sei'].$arDados['str_destino_sei'];

                $protocolo_formatado[] = $arDados['str_protocol_formatado'];
                $assunto[] = $objSmap->trataDemandas($arDados['str_conteudo']);

                $dt_despacho[] = date('d/m/Y ', strtotime($arDados['dt_despacho']));
                if (!empty($arDados['str_sigla'])) {
                    $destino_final[] = $arDados['str_sigla'];
                    $destino_resumo = $arDados['str_sigla'];
                } else {
                    $destino_final[] = $arDados['str_uf'] . ' - ' . utf8_encode($arDados['str_descricao']);
                    $destino_resumo = $arDados['str_uf'] . ' - ' . $arDados['str_descricao'];
                }
               // $resumo[] = '<b>Data:&nbsp;</b>' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:</b>&nbsp;' . utf8_encode($arDados['str_resumo']) . '<br><b>Destino:</b>&nbsp;' . utf8_encode($destino_resumo) . '<br/><br/>';
                $resumo[] = utf8_encode($arDados['str_resumo']) . '<br>';
                $vencimento[] = date('d/m/Y ', strtotime($arDados['dt_vencimento']));
            }// Dando Continuidade no relatório
            else {
                // Caso haja um novo despacho no loop 
                if (!in_array($chave, $id_documento)) {
                    $id_documento[] = $arDados['id_documento_sei'].$arDados['str_destino_sei'];

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
                    //$resumo[] = '<b>Data:</b>&nbsp;' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:</b>&nbsp;' . utf8_encode($arDados['str_resumo']) . '<br><b>Destino:</b>&nbsp;' . @$arDados['str_sigla'] . '<br/><br/>';
                    $resumo[] = utf8_encode($arDados['str_resumo']) . '<br>';
                    $vencimento[] = date('d/m/Y ', strtotime($arDados['dt_vencimento']));
                }//Caso Um despacho que ja passou no loop tenha mais de um histórico 
                else if (in_array($chave, $id_documento)) {
                    for ($i = 0; $i < count($id_documento); $i++) {
                         $chavetemp= $arDados['id_documento_sei'].$arDados['str_destino_sei'];
                        if ($chavetemp == $id_documento[$i]) {
                            if (!empty($arDados['str_sigla'])) {
                                $destino = $arDados['str_sigla'];
                            } else {
                                $destino = $arDados['str_uf'] . ' - ' . utf8_encode($arDados['str_descricao']);
                            }
                           // $resumo[$i] = $resumo[$i] . '<b>Data:</b>&nbsp;' . date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])) . '<br><b>Resumo:&nbsp;</b>' . utf8_encode($arDados['str_resumo']) . '<br><b>Destino:</b>&nbsp;' . utf8_encode($destino) . '<br/><br/>';
                       $resumo[$i] = $resumo[$i] .utf8_encode($arDados['str_resumo']) . '<br>';
                        }
                    }
                }
            }
        }
    }

    // HTML da página que vai gerar o PDF
    include_once 'view/relatorios/rel_pendencias_pdf.php';
    // FIM HTML da página que vai gerar o PDF
}
?>

