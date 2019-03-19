<?php

if (empty($_POST)) {
    /*
     * Montagem depende do Controller Cpainel
     */
//for para alertas especificos
    $html_session = Array();
    $contagem = 0;
    $tipos_session = Array();
    for ($c = 0; $c < count($dados_processos_tipos); $c++) {
        $caminho = RAIZ . 'demandas/exibedemanda_filtro/alerta/' . $dados_processos_tipos[$c]['id_acompanhamento'] . '/' . $dados_processos_tipos[$c]['id_documento_sei'] . '/' . $dados_processos_tipos[$c]['str_destino_sei'];

        //Definindo a mensagem e a cor do icone
        if ($dados_processos_tipos[$c]['dt_prazo'] == 0) {
            $informacao = 'Último dia';
            $tipo = 'parado-60';
        } else if ($dados_processos_tipos[$c]['dt_prazo'] > 0 && $dados_processos_tipos[$c]['dt_prazo'] < 4) {
            $informacao = 'Falta ' . $dados_processos_tipos[$c]['dt_prazo'];
            $tipo = 'parado-15';
        } else if ($dados_processos_tipos[$c]['dt_prazo'] >= 4 and $dados_processos_tipos[$c]['dt_prazo'] != 1999) {
            $informacao = 'Falta ' . $dados_processos_tipos[$c]['dt_prazo'];
            $tipo = 'falta';
        } else if ($dados_processos_tipos[$c]['dt_prazo'] < 0) {
            $informacao = 'Expirado à ' . $dados_processos_tipos[$c]['dt_prazo'];
            $tipo = 'parado-60';
        } else {
            $dados_processos_tipos[$c]['dt_prazo'];
            $informacao = 'Parado há ' . $dados_processos_tipos[$c]['diferenca'];
            $tipo = 'nao-parado';
        }

        //Definindo o icone do alerta
        for ($w = 0; $w < count($tipos); $w++) {
            if ($dados_processos_tipos[$c]['tipo'] == $tipos[$w]['nome']) {
                $icone = $tipos[$w]['icone'];
                $nome = utf8_encode($tipos[$w]['nome']);
                //Pegando o tipo para a session dos filtros
                if (@!in_array($nome, $tipos_session)) {
                    $tipos_session[] = utf8_encode($tipos[$w]['nome']);
                    $html_session[$contagem]['tipo'] = utf8_encode($tipos[$w]['nome']);
                    $contagem++;
                }
            }
        }
        //Definindo o protocolo
        $protocolo = $dados_processos_tipos[$c]['protocolo'];
        //Html do alerta
        @$html_alerta .= "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'> 
                    <div class='label label-sm $tipo'>
                    <i class='$icone'></i>     </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'> <a href='$caminho'>   $protocolo </a></div>
         </div>
    </div>
   </div>
     <div class='col2'>
<div class='date'> <span class='label label-sm $tipo'>$informacao dias</span> </div>
  </div>
      </li>";

        //Html para gravar na session dos filtros
        $html_temporario = "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'> 
                    <div class='label label-sm $tipo'>
                    <i class='$icone'></i>     </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'> <a  href='$caminho'>   $protocolo </a></div>
         </div>
    </div>
   </div>
     <div class='col2'>
<div class='date'> <span class='label label-sm $tipo'>$informacao dias</span> </div>
  </div>
      </li>";
        //Gravando o html 
        for ($h = 0; $h < count($html_session); $h++) {
            if ($html_session[$h]['tipo'] == $nome) {
                @$html_session[$h]['html'] .= $html_temporario;
            }
        }
    }
//Gravando html para session
    $_SESSION['alertas'] = $html_session;
    $_SESSION['alertas_total'] = @$html_alerta;
//Parte dos Filtros Alertas 

    $filtrar_esp1 = " <li>
                        <a id='total' class='processoAlertas' href='javascript:;'>Total<span class='badge badge-default'> $soma_total_alertas </span></a>
                       </li>
                       <li class='divider'> </li>";

    for ($h = 0; $h < count($tipos); $h++) {
        $nome_filtro = utf8_encode($tipos[$h]['nome']);
        @$filtrar_esp2 .= "  <li>
                               <a id='$nome_filtro' class='processoAlertas' href='javascript:;'><i class='" . $tipos[$h]['icone'] . "'></i> " . utf8_encode($tipos[$h]['nome']) . "<span class='badge nao-parado'>$cont2[$h]</span></a>
                             </li>";
    }
    $filtro_esp = $filtrar_esp1 . $filtrar_esp2;
} else {
    session_start();
    $tipo = $_POST['processoAlertas'];
    //var_dump($_SESSION['alertas']);
    if ($tipo == 'total') {
        echo $_SESSION['alertas_total'];
    } else
        for ($j = 0; $j < count($_SESSION['alertas']); $j++) {
            $tipo_session = $_SESSION['alertas'][$j]['tipo'];
            if ($tipo_session == $tipo) {
                echo $_SESSION['alertas'][$j]['html'];
                break;
            }
        }
}
