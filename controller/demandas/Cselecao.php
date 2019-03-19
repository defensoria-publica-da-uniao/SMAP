<?php



if (empty($_POST) OR ( isset($_POST) AND ! empty($_POST['numero_processo']))) {


    if ($pagina == 'selecao_filtro' and empty($_POST)) {
        $situ = '1';
        $_SESSION['situ'] = 1;
        $msg = "Aberto";
        $Result = $objSmap->selectjoin($situ);
        $arProcesso = Array();
        
        //listar processos que estao na lista de confirmação de exclusão
       $Consulta_duplicados=$objSmap->dados_duplicados_confirmar();
       $arDuplicadoschave=Array();
       
       while($idDados_duplicados= mssql_fetch_array($Consulta_duplicados)){
       $arDuplicadoschave[]=$idDados_duplicados['id_documento_sei'].';'.$idDados_duplicados['str_destino_sei'];
       }
        

    } else {
//Seleção de cadastro sei
        //Com filtro
        if (((empty($_POST['numero_processo'])) ? $numero_processo = null : $numero_processo = $_POST['numero_processo'])) {
            $resultD = $objSei->select_documento_sei($numero_processo);
            $filtro_sei = 1;
  
            unset($_SESSION['filtro_dt_despacho']);
        } else {
            ini_set('max_execution_time', 864000);
            ini_set('mssql.timeout', 864000);
            ini_set('memory_limit', '3024M');
            //Sem filtro
            $refazer_busca = 0;

            $consultando_dados_atuais = $objSei->ultimo_dado_carga();
            $dados_atuais = mssql_fetch_array($consultando_dados_atuais);
            $_SESSION['ultimo_dado_dia'] = $dados_atuais['dt_hr_ultima_carga'];
            //Verificando se esta na mesma data

            $ultimo_dado_dia = date('d', strtotime($dados_atuais['dt_hr_ultima_carga']));
            $data_atual = date('d');
            if ($ultimo_dado_dia <> $data_atual) {
                $refazer_busca = 1;
            } else {
                //Verifico se exite uma diferença de 1h
                $ultimo_dado_horas = date('H:i:s', strtotime($dados_atuais['dt_hr_ultima_carga']));
                $hora_Atual = date('H:i:s');
                $difenreca_hora = $objGeral->calculaTempo($ultimo_dado_horas, $hora_Atual);
                if (strtotime($difenreca_hora) > strtotime('1:00:00')) {
                    $refazer_busca = 1;
                } else {
                    $refazer_busca = 0;
              js_go('selecao_filtro');
              exit;
                }
            }

            if ($refazer_busca == 1) {

                $arDocumento = array();
                $arCancelados = array();
                $arDespachos = array();

                if (empty($_POST)) {
                    $resultD = $objSei->buscaDocumento_sei();
                } else {
                    ((empty($_POST['numero_processo'])) ? $numero_processo = null : $numero_processo = $_POST['numero_processo']);
                    $resultD = $objSei->select_documento_sei($numero_processo);
                    $filtro_sei = 1;
                    unset($_SESSION['filtro_dt_despacho']);
                }
                 
                
                $contD = 1;
                $destino = null;

                $resultCancelados = $objSei->buscaDocumentoCancelado_sei();
                while ($arDadosC = mssql_fetch_array($resultCancelados)) {
                    $arCancelados[] = $arDadosC['id_origem'];
                }
                
                   //Verifica os acompanhamento ja feitos
                            $Resultacomp = $objSmap->selectcamp('id_documento_sei,str_destino_sei', 'tb_acompanhamento');
                            $idacompanhamento = Array('0');
                            while ($array = mssql_fetch_array($Resultacomp)) {
                                $idacompanhamento[] = $array[0] . utf8_decode($array[1]);
                            };

                            //Verifica os documento duplicado
                            $Resultacomp2 = $objSmap->selectcamp('id_documento_sei,str_destino_sei', 'tb_dados_duplicados');
                            $idacompanhamento2 = Array('0');
                            while ($array2 = mssql_fetch_array($Resultacomp2)) {
                               $idacompanhamento2[] = $array2[0] . utf8_decode($array2[1]);
                            };


                while ($arDadosD = mssql_fetch_array($resultD)) {
                    $idProtocolo = $arDadosD['id_protocolo'];
                    $dtAssinaturaDocumento = date('Y.m.d', strtotime($arDadosD['data_inicio_tramite']));
                    $resultA = $objSei->buscaDestinoDocumento_sei($idProtocolo, $dtAssinaturaDocumento);
                    $destino = null;
                    $chaveD = $arDadosD['id_documento_sei'];

                    if (!in_array($chaveD, $arDocumento) and ! in_array($chaveD, $arCancelados)) {
                        while (@$arDestino = mssql_fetch_array($resultA)) {

                            $id_documento_sei = $arDadosD['id_documento_sei'];
                            $id_protocolo = $arDadosD['id_protocolo'];
                            $protocolo_formatado = $arDadosD['protocolo_formatado'];
                            $tipo_processo = $arDadosD['tipo_processo'];
                            $conteudo = $arDadosD['conteudo'];
                            $data_assinatura = date('Y-m-d H:i:s', strtotime($arDadosD['data_inicio_tramite']));
                            $data_despacho = date('Y-m-d H:i:s', strtotime($arDestino["data_inicio_tramite"]));
                            $destino_sei = utf8_decode($arDestino['destino']);
                            $nr_documento = $arDadosD['nr_documento'];
                            $tipo_documento = $arDadosD['nome'];
                            $dt_hr_atual = date('Y-m-d H:i:s');

                            //Começa cadastro SMAP
                         

                          $chave_verificacao = $id_documento_sei . $destino_sei;
                            if (!in_array($chave_verificacao, $idacompanhamento) and !in_array($chave_verificacao, $idacompanhamento2)) {

                                    $situacao = 1;

                                    //Definando Destino
                                    $nome_secretaria = $destino_sei;
                                    $explode = explode('DPGU', $nome_secretaria);
                                    $nome_secretaria = $explode[0];

                                    $id_secretaria = $objSmap->select_destino_sei_smap($nome_secretaria);

                                    //Inserindo Destino
                                    $inserir_destino = $objGeral->insert('tb_origem_destino', 'id_secretaria', "$id_secretaria");
                                    //Pegando id_origem_destino do Destino 
                                    $pegar_id_destino = $objGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
                                    $result_id_destino = mssql_fetch_array($pegar_id_destino);


                                    //Inserindo origem
                                    //Pegando primeiro o id da secretaria "A DEFINIR";
                                    $pegar_id_adefinir = $objGeral->select('tb_secretaria', "where str_sigla='A DEFINIR'", NULL);
                                    $result_id_adefinir = mssql_fetch_array($pegar_id_adefinir);
                                    $id_adefinir = $result_id_adefinir['id_secretaria'];


                                    $inserir_origem = $objGeral->insert('tb_origem_destino', 'id_secretaria', "$id_adefinir");
                                    //Pegando id_origem_destino da origem
                                    $pegar_id_origem = $objGeral->select('tb_origem_destino', null, 'id_origem_destino DESC');
                                    $result_id_origem = mssql_fetch_array($pegar_id_origem);


                                    //Dados para tb_acompanhamento
                                    $dt_prazo = 'NULL';
                                    $dt_vencimento = 'NULL';
                                    $id_origem = $result_id_origem['id_origem_destino'];

                                    $usr_criador = utf8_decode('Automação_smap');

                                    //Check ver se ja existe esse processo no banco                                 
                                    $Resultsei = $objGeral->select('tb_processo_sei', "WHERE id_processo_sei = $id_protocolo ");
                                    $Resultsei = mssql_fetch_array($Resultsei);

                                    if ($Resultsei == false) {
                                        //Inserindo o novo Processo sei 

                                        $inserirsei = $objGeral->insert('tb_processo_sei', 'id_processo_Sei,str_protocol_formatado,str_tipo_processo', "$id_protocolo,'$protocolo_formatado','$tipo_processo'");
                                    }

                                    //Check ver se ja existe esse documento no banco 
                                    $Resultdoc_sei = $objGeral->select('tb_documento_sei', "WHERE id_documento_sei = $id_documento_sei ");
                                    $Resultdoc_sei = mssql_fetch_array($Resultdoc_sei);

                                    if ($Resultdoc_sei == false) {
                                        //Inserindo o Documento do Despacho

                                        $inserirdespacho = $objGeral->insert('tb_documento_sei', 'id_documento_sei,str_conteudo,dt_despacho,id_processo_sei,int_numero_sei,dt_assinatura', "$id_documento_sei,'$conteudo','$data_despacho',$id_protocolo,$nr_documento,'$data_assinatura'");
                                    }

                                    //Inserindo o Acompanhamento
                                    $inseriracompa = $objGeral->insert('tb_acompanhamento', 'id_documento_sei,dt_prazo,dt_vencimento,id_origem_destino,str_destino_sei,str_usr_criador', "$id_documento_sei,$dt_prazo,$dt_vencimento,$id_origem,'$destino_sei','$usr_criador'");

                                    //Pegando o ultimo Id da tabela acompanhamento    
                                    $lastIdR = $objGeral->select('tb_acompanhamento', null, 'id_acompanhamento desc');
                                    $lastIddados = mssql_fetch_array($lastIdR);

                                    //Dados pata tb_historico_acompanhamento
                                    $lastId = $lastIddados['id_acompanhamento'];
                                    $dt_hoje = date("Y-m-d H:i:s");
                                    $resumo = 'Cadastro automatico de processos Sei para SMAP';
                                    $id_destino = $result_id_destino['id_origem_destino'];
                                    $situacao = 1;

                                    //Inserindo o Historico  Acompanhamento
                                    $inseriracompahistori = $objGeral->insert('tb_historico_acompanhamento', 'id_acompanhamento,str_resumo,str_usr_criador,dt_criacao_acomp,id_origem_destino,int_situ,int_estatus', "$lastId,'$resumo','$usr_criador','$dt_hoje',$id_destino,$situacao,1");
                                
                            }
                        }//fim while de destinos
                    }//fim array de documentos já passados no laço
                    $arDocumento[] = $chaveD;
                }// fim while documento


                $dt_hr_atual = date('Y-m-d H:i:s');
                //Deletando a tabela da ultima inserção
                $objGeral->delete_dados_ultima_carga();
                //Inserindo Hora da ultima inserção  
                $inserirúltimacarga = $objGeral->insert('tb_ultima_carga', 'dt_hr_ultima_carga', "'$dt_hr_atual'");

            js_go('selecao_filtro');
            }
        }

        /*
          //Filtro do sei
          if (isset($filtro_sei)) {

          $arDocumento = array();
          $arCancelados = array();
          $arDespachos = array();

          $contD = 1;
          $destino = null;

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
          } else {
          $consulta_dados_temp = $objGeral->select('dados_temp', null, 'dt_despacho DESC');
          }
         * 
         */
    }
} else {



    //Selecionar processos com filtros Em Aberto OU Em Andamento OU Concluido OU Ciente
    if (!empty($_POST['situacao']) OR ! empty($_POST['num_processo']) OR ! empty($_POST['filtro_todos']) OR ! empty($_POST['id_do_setor']) OR ! empty($_POST['dt_despacho_inicial'])) {
                  //listar processos que estao na lista de confirmação de exclusão
       $Consulta_duplicados=$objSmap->dados_duplicados_confirmar();
       $arDuplicadoschave=Array();
       
       while($idDados_duplicados= mssql_fetch_array($Consulta_duplicados)){
       $arDuplicadoschave[]=$idDados_duplicados['id_documento_sei'].';'.$idDados_duplicados['str_destino_sei'];
       }
        
        $situ = $_POST['situacao'];
        //Situação aberta
        if ($_POST['situacao'] == 'sei') {
            js_go('selecao');
        } else {

            $_SESSION['filtros'] = 1;
            $_SESSION['situacao'] = $_POST['situacao'];
            $_SESSION['dt_despacho_inicial'] = $_POST['dt_despacho_inicial'];
            $_SESSION['dt_despacho_final'] = $_POST['dt_despacho_final'];
            $_SESSION['num_processo']=$_POST['num_processo'];
            if (!isset($_POST['id_unidade_destino'])) {
                $_SESSION['id_unidade_destino'] = null;
            } else {
                $_SESSION['id_unidade_destino'] = $_POST['id_unidade_destino'];
            }
            if (!isset($_POST['id_secretaria_destino'])) {
                $_SESSION['id_secretaria_destino'] = null;
            } else {
                $_SESSION['id_secretaria_destino'] = $_POST['id_secretaria_destino'];
            }
            if (!isset($_POST['filtro_todos'])) {
                $_SESSION['filtro_todos'] = null;
            } else {
                $_SESSION['filtro_todos'] = @$_POST['filtro_todos'];
            }

            $dt_despacho_inicial_br = $_POST['dt_despacho_inicial'];
            $dt_despacho_final_br = $_POST['dt_despacho_final'];

            $dt_despacho_ex = explode('/', $dt_despacho_inicial_br);
            @$dt_despacho_inicial = $dt_despacho_ex[2] . '-' . $dt_despacho_ex[1] . '-' . $dt_despacho_ex[0];

            $dt_despacho_ex2 = explode('/', $dt_despacho_final_br);
            @$dt_despacho_final = $dt_despacho_ex2[2] . '-' . $dt_despacho_ex2[1] . '-' . $dt_despacho_ex2[0];


            /*
              $Result = $objSmap->selectjoin($situ);
              $arProcesso = Array();
              $_SESSION['situ'] = 1;
              if ($situ == 2) {
              @$msg = "Em andamento";
              } else if ($situ == 3) {
              @$msg = "Concluídos";
              } else if ($situ == 1) {
              @$msg = "Aberto";
              } else if ($situ == 4) {
              @$msg = "Ciente";
              }
             * 
             */
            if (!empty($_POST['id_unidade_destino'])) {
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo uma Unidade ou Secretaria (Especifica)
                $id_do_setor = $_POST['id_unidade_destino'];
                $dpgu_dpu = 'dpu';

                $Result = $objSmap->select_filtro_unidade_secretaria($situ, $id_do_setor, $dpgu_dpu, $dt_despacho_inicial, $dt_despacho_final);
                $arProcesso = Array();

                // Mostrando mensagem de sub-título dos filtros selecionados
                if (!empty($_POST['situacao'])) {
                    $_SESSION['situ'] = 1;
                    if ($situ == 2) {
                        @$msg = "Escolhido uma Unidade / Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 3) {
                        @$msg = "Escolhido uma Unidade / Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 1) {
                        @$msg = "Escolhido uma Unidade / Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 4) {
                        @$msg = "Escolhido uma Unidade / Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    }
                } else {
                    @$msg = "Escolhido uma Unidade Com data de despacho em : $dt_despacho_br";
                }
                // FIM Mostrando mensagem de sub-título dos filtros selecionados
            } else if (!empty($_POST['id_secretaria_destino'])) {
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo uma Unidade ou Secretaria (Especifica)
                $id_do_setor = $_POST['id_secretaria_destino'];
                $dpgu_dpu = 'dpgu';

                $Result = $objSmap->select_filtro_unidade_secretaria($situ, $id_do_setor, $dpgu_dpu, $dt_despacho_inicial, $dt_despacho_final);

                $arProcesso = Array();

                // Mostrando mensagem de sub-título dos filtros selecionados
                if (!empty($_POST['situacao'])) {
                    $_SESSION['situ'] = 1;
                    if ($situ == 2) {
                        @$msg = "Escolhido uma Secretaria / Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 3) {
                        @$msg = "Escolhido uma Secretaria / Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 1) {
                        @$msg = "Escolhido uma Secretaria / Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    } else if ($situ == 4) {
                        @$msg = "Escolhido uma Secretaria / Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    }
                } else {
                    @$msg = "Escolhido uma Secretaria </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                }
                // FIM Mostrando mensagem de sub-título dos filtros selecionados
            } else if (!empty($_POST['filtro_todos'])) {
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo TODOS de uma Unidade ou Secretaria
                $confere = $_POST['filtro_todos'];
                $todos = 0;

                if ($confere == 'TODOS_DPGU') {
                    $Result = $objSmap->select_filtro_todos_secretaria($situ, $todos, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();

                    // Mostrando mensagem de sub-título dos filtros selecionados
                    if (!empty($_POST['situacao'])) {
                        $_SESSION['situ'] = 1;
                        if ($situ == 2) {
                            @$msg = "Todas as Secretaria / Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 3) {
                            @$msg = "Todas as Secretaria / Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 1) {
                            @$msg = "Todas as Secretaria / Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 4) {
                            @$msg = "Todas as Secretaria / Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        }
                    } else {
                        @$msg = "Todas as Secretaria </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    }
                    // FIM Mostrando mensagem de sub-título dos filtros selecionados
                } else if ($confere == 'TODOS_DPU') {
                    $Result = $objSmap->select_filtro_todos_unidade($situ, $todos, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();

                    // Mostrando mensagem de sub-título dos filtros selecionados
                    if (!empty($_POST['situacao'])) {
                        $_SESSION['situ'] = 1;
                        if ($situ == 2) {
                            @$msg = "Todas as Unidades / Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 3) {
                            @$msg = "Todas as Unidades / Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 1) {
                            @$msg = "Todas as Unidades / Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 4) {
                            @$msg = "Todas as Unidades / Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        }
                    } else {
                        @$msg = "Todas as Unidades </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    }
                    // FIM Mostrando mensagem de sub-título dos filtros selecionados
                } else if ($confere == 'TODOS_DPGU_DPU') {
                    $Result = $objSmap->selectjoin3($situ, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();

                    // Mostrando mensagem de sub-título dos filtros selecionados
                    if (!empty($_POST['situacao'])) {
                        $_SESSION['situ'] = 1;
                        if ($situ == 2) {
                            @$msg = "Todas as Unidades e Secretarias / Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 3) {
                            @$msg = "Todas as Unidades e Secretarias  / Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 1) {
                            @$msg = "Todas as Unidades e Secretarias / Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        } else if ($situ == 4) {
                            @$msg = "Todas as Unidades e Secretarias / Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                        }
                    } else {
                        @$msg = "Todas as Unidades e Secretarias </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br ";
                    }
                    // FIM Mostrando mensagem de sub-título dos filtros selecionados
                }
            } else if (!empty($_POST['num_processo'])) {
                // Utilizando o filtro Por número do processo.
                $numero_processo = $_POST['num_processo'];
                $Result = $objSmap->select_filtro_processos($situ, $numero_processo);
                $arProcesso = Array();
            

                // Mostrando mensagem de sub-título dos filtros selecionados
                @$msg = "Por nº do processo / nº do documento SEI: " . $numero_processo;
                // FIM Mostrando mensagem de sub-título dos filtros selecionados
            } else {
                if (empty($_POST['situacao'])) {

                    $Result = $objSmap->selectjoin3($situ, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();
                    @$msg = "Todos - DPGU e DPU </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br";
                } else {

                    $Result = $objSmap->selectjoin3($situ, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();
                    $_SESSION['situ'] = 1;
                    if ($situ == 2) {
                        @$msg = "Todos - DPGU e DPU Em andamento </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br";
                    } else if ($situ == 3) {
                        @$msg = "Todos - DPGU e DPU Concluídos </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br";
                    } else if ($situ == 1) {
                        @$msg = "Todos - DPGU e DPU Aberto </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br";
                    } else if ($situ == 4) {
                        @$msg = "Todos - DPGU e DPU Ciente </br> Com período de despacho de : $dt_despacho_inicial_br à $dt_despacho_final_br";
                    }
                }
            }
        }
    } else {

        $resultD = $objSei->buscaDocumento_sei();
        $idacompanhamento = Array('0');
        while ($array = mssql_fetch_array($resultD)) {
            //   $idacompanhamento[] = $array[0];
        }

        //Busca de Filtros na consulta SEI
        /*       if (!empty($_POST['dt_final']) && !empty($_POST['dt_ini']) && !empty($_POST['dt_fin'])) {
          $dt_ini = $_POST['dt_ini'];
          $dt_ini2 = date('Y-m-d', strtotime((str_replace('/', '-', $dt_ini))));

          $dt_fin = $_POST['dt_fin'];
          $dt_fin2 = date('Y-m-d', strtotime((str_replace('/', '-', $dt_fin))));

          $AND = "AND p.dta_geracao BETWEEN '$dt_ini2' AND '$dt_fin2'";
          $msg = "Período: " . $dt_ini . " à " . $dt_fin;
          } else {
          $dt_final = '2018-07-23';
          }
         */
        /* if (!empty($_POST['num_processo_sei'])) {
          $num_processo_sei = $_POST['num_processo_sei'];
          $AND = @$AND . " AND p.protocolo_formatado = '$num_processo_sei'";
          @$msg = "Processo: " . $num_processo . '<br>' . $msg;
          }
          $filtrosei = 1;
          $Result = $objSei->selectseifiltro($AND);

          $Resultacomp = $objSmap->selectcamp('id_documento', 'tb_acompanhamento');
          $idacompanhamento = Array('0');
          while ($array = mssql_fetch_array($Resultacomp)) {
          $idacompanhamento[] = $array[0];
          };
         */
    }
}

$_SESSION['MSG'] = @$msg;

if (!empty($_SESSION['MSG'])) {
    $mensagem = $_SESSION['MSG'];
    //$mensagem = 'Com Filtros : <br>' . $_SESSION['MSG'];
} else {
    $mensagem = 'Todos - DPGU e DPU';
}
unset($_SESSION['MSG']);
?>



