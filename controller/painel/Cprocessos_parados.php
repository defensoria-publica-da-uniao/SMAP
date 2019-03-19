<?php

if (empty($_POST)) {
    /*
     * Montagem depende do Controller Cpainel
     */
//for para alertas parados
    for ($d = 0; $d < count($dados_alertas); $d++) {
        $caminho2 = RAIZ . 'demandas/exibedemanda_filtro/alerta/' . $dados_alertas[$d]['id_acompanhamento'] . '/' . $dados_alertas[$d]['id_documento_sei'] . '/' . $dados_alertas[$d]['str_destino_sei'];

        if ($dados_alertas[$d]['tempo'] == 15) {
            $tipo = 'parado-15';
            //$html_15 = '';
        } else if ($dados_alertas[$d]['tempo'] == 30) {
            $tipo = 'parado-30';
           // $html_30 = '';
        } else if ($dados_alertas[$d]['tempo'] == 60) {
            $tipo = 'parado-60';
            //$html_60 = '';
           
        }


        @$html_parado_temp= "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'>
                    <div class='label label-sm $tipo'> <i class='fa fa-bell-o'></i> 
                 </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'><a href='$caminho2'>  " . @$dados_alertas[$d]['protocolo'] . " </a></div>
         </div>
    </div>
   </div>
     <div class='col2'>
 <div class='date'> <span class='label label-sm $tipo'> Parado há " . @$dados_alertas[$d]['diferenca'] . " dias </span></div>
  </div>
      </li>";
        
        
         @$html_parado .=$html_parado_temp;
        
        

        if ($dados_alertas[$d]['tempo'] == 15) {

            @$html_15 .= $html_parado_temp;
        } else if ($dados_alertas[$d]['tempo'] == 30) {

          @$html_30 .= $html_parado_temp;
        } else if ($dados_alertas[$d]['tempo'] == 60) {

            @$html_60 .=$html_parado_temp;
        }
    }
    $total_prazo = 0;
    while ($arPrazo = mssql_fetch_array($sql_dtprazo)) {
        $data_prazo = $arPrazo['dt_prazo'];
        $diferenca = strtotime($data_prazo) - strtotime($dataatual);
        (int) $diferenca = floor($diferenca / (60 * 60 * 24));
        $caminho3 = RAIZ . 'demandas/exibedemanda_filtro/alerta/' . $arPrazo['id_acompanhamento'] . '/' . $arPrazo['id_documento_sei'] . '/' . $arPrazo['str_destino_sei'];


        if ($diferenca == 0) {
            $informacao = 'Último dia';
            $tipo = 'parado-60';
        } else if ($diferenca > 0 && $diferenca < 4) {
            $informacao = 'Falta ' . $diferenca;
            $tipo = 'parado-15';
        } else if ($diferenca >= 4 and $diferenca != 1999) {
            $informacao = 'Falta ' . $diferenca;
            $tipo = 'falta';
        } else if ($diferenca < 0) {
            $informacao = 'Expirado à ' . $diferenca;
            $tipo = 'parado-60';
        }


        $chave = $arPrazo['id_documento_sei'] . $arPrazo['str_destino_sei'];
        if (!in_array($chave, $id_tipos)) {
            $total_prazo++;

            @$html_prazo .= "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'> 
                    <div class='label label-sm $tipo'>  <i class='fa fa-book'></i>
                 </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'><a href='$caminho3'>  " . @ $arPrazo['str_protocol_formatado'] . " </a></div>
         </div>
    </div>
   </div>
     <div class='col2'>
 <div class='date'><span class='label label-sm $tipo'> $informacao dias </span> </div>
  </div>
    </li>";
        }
    }

    @$html_final2 = $html_prazo;
    @$html_final3=$html_parado;
    $_SESSION['html_final2'] = @$html_final2;
    $_SESSION['html_final3'] =  @$html_final3;
    $_SESSION['html_15'] = @$html_15;
    $_SESSION['html_30'] = @$html_30;
    $_SESSION['html_60'] = @$html_60;
    $_SESSION['html_prazo'] =  @$html_prazo;

//Parte do Filtro
    //@$soma_final = $total_prazo + $soma_total_parados;

    $filtrar_prazo = " <li>
                             <a id='total' class='processoParado' ><i class='fa fa-bell-o'></i> Total<span class='badge badge-default'>  $total_prazo </span></a>
                        </li>
           <li class='divider'> </li>
                        <li>
                            <a id='prazo' class='processoParado' >Prazo<span class='badge falta'>$total_prazo</span></a>
                        </li>                       

                    ";
     $filtrar_parado = " <li>
                             <a id='0' class='processoParado' ><i class='fa fa-bell-o'></i> Total<span class='badge badge-default'>  $soma_total_parados </span></a>
                        </li>
           <li class='divider'> </li>
                      
                         <li>
                             <a id='15' class='processoParado'>Parados (+ 15 dias)<span class='badge parado-15'>$cont[0]</span></a>
                        </li>
                        <li>
                            <a id='30' class='processoParado'  >Parados (+ 30 dias)<span class='badge parado-30'>$cont[1]</span></a>
                        </li>
                        <li>
                            <a id='60'  class='processoParado' >Parados (+ 60 dias)<span class='badge parado-60'>$cont[2]</span></a>
                        </li>
                    ";
} else if ($_POST['processoParado'] == "total") {
    session_start();
    echo $_SESSION['html_final2'];
} else {
        session_start();
    if ($_POST['processoParado'] == "15") {
         echo $_SESSION['html_15'];
    } else if ($_POST['processoParado'] == "30") {
            echo $_SESSION['html_30'];
    } else if ($_POST['processoParado'] == "60") {
            echo $_SESSION['html_60'];
    } else if ($_POST['processoParado'] == "0") {
            echo $_SESSION['html_final3'];
    }else {
       echo $_SESSION['html_prazo'];
    }
}