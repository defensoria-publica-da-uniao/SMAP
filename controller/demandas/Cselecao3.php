<?php
   if (!empty($_POST['situacao']) OR ! empty($_POST['num_processo']) OR ! empty($_POST['filtro_todos']) OR ! empty($_POST['id_do_setor']) OR ! empty($_POST['dt_despacho_inicial']) OR isset($_SESSION['filtros'])) {
         //listar processos que estao na lista de confirmação de exclusão
       $Consulta_duplicados=$objSmap->dados_duplicados_confirmar();
       $arDuplicadoschave=Array();
       
       while($idDados_duplicados= mssql_fetch_array($Consulta_duplicados)){
       $arDuplicadoschave[]=$idDados_duplicados['id_documento_sei'].';'.$idDados_duplicados['str_destino_sei'];
       }
             
       
       if (!isset($_SESSION['filtros'])) {
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
            }
            
    

                $situ = $_SESSION['situacao'];
                $dt_despacho_inicial_br = $_SESSION['dt_despacho_inicial'];
                $dt_despacho_final_br = $_SESSION['dt_despacho_final'];
           

            $dt_despacho_ex = explode('/', $dt_despacho_inicial_br);
            @$dt_despacho_inicial = $dt_despacho_ex[2] . '-' . $dt_despacho_ex[1] . '-' . $dt_despacho_ex[0];

            $dt_despacho_ex2 = explode('/', $dt_despacho_final_br);
            @$dt_despacho_final = $dt_despacho_ex2[2] . '-' . $dt_despacho_ex2[1] . '-' . $dt_despacho_ex2[0];


            if ($_SESSION['id_unidade_destino'] <> null) {
                
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo uma Unidade ou Secretaria (Especifica)
                    $id_do_setor = $_SESSION['id_secretaria_destino'];

                $dpgu_dpu = 'dpu';

                $Result = $objSmap->select_filtro_unidade_secretaria($situ, $id_do_setor, $dpgu_dpu, $dt_despacho_inicial, $dt_despacho_final);
                $arProcesso = Array();

                // Mostrando mensagem de sub-título dos filtros selecionados
                if ($_SESSION['situacao'] <> 0) {
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
            }
            else if ($_SESSION['id_secretaria_destino'] <> null) {
                
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo uma Unidade ou Secretaria (Especifica)
                 $id_do_setor = $_SESSION['id_secretaria_destino'];

                $dpgu_dpu = 'dpgu';

                $Result = $objSmap->select_filtro_unidade_secretaria($situ, $id_do_setor, $dpgu_dpu, $dt_despacho_inicial, $dt_despacho_final);

                $arProcesso = Array();

                // Mostrando mensagem de sub-título dos filtros selecionados
                if ($_SESSION['situacao'] <> 0) {
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
            } 
            else if ( $_SESSION['filtro_todos'] <> null) {
                // Utilizando o filtro de Unidade DPU / Secretaria DPGU. Escolhendo TODOS de uma Unidade ou Secretaria

         $confere = $_SESSION['filtro_todos'];

                $todos = 0;

                if ($confere == 'TODOS_DPGU') {
                    $Result = $objSmap->select_filtro_todos_secretaria($situ, $todos, $dt_despacho_inicial, $dt_despacho_final);
                    $arProcesso = Array();

                    // Mostrando mensagem de sub-título dos filtros selecionados
                    if ($_SESSION['situacao'] <> 0) {
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
                    if ($_SESSION['situacao'] <> 0) {
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
                    if ($_SESSION['situacao'] <> 0) {
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
            } 
            else if ( $_SESSION['num_processo'] <> null) {
                
                // Utilizando o filtro Por número do processo.
                $numero_processo =  $_SESSION['num_processo'];
                $Result = $objSmap->select_filtro_processos($situ, $numero_processo);
                $arProcesso = Array();

                // Mostrando mensagem de sub-título dos filtros selecionados
                @$msg = "Por nº do processo / nº do documento SEI: " . $numero_processo;
                // FIM Mostrando mensagem de sub-título dos filtros selecionados
            } else {
                if ($_SESSION['situacao']==0) {

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


$_SESSION['MSG'] = @$msg;

if (!empty($_SESSION['MSG'])) {
    $mensagem = $_SESSION['MSG'];
    //$mensagem = 'Com Filtros : <br>' . $_SESSION['MSG'];
} else {
    $mensagem = 'Todos - DPGU e DPU';
}
unset($_SESSION['MSG']);