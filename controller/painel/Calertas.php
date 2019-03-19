<?php
//for para alertas especificos
for ($c = 0; $c < count($dados_processos_tipos); $c++) {
$caminho=RAIZ.'demandas/exibedemanda_filtro/alerta/'.$dados_processos_tipos[$c]['id_acompanhamento'].'/'.$dados_processos_tipos[$c]['id_documento_sei'].'/'.$dados_processos_tipos[$c]['str_destino_sei'];
    echo "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'>  ";
    if ($dados_processos_tipos[$c]['diferenca'] < 15) {
        echo "<div class='label label-sm nao-parado'>";
    } else if ($dados_processos_tipos[$c]['diferenca'] >= 15 && $dados_processos_tipos[$c]['diferenca'] < 30) {
        echo "<div class='label label-sm parado-15'>";
    } else if ($dados_processos_tipos[$c]['diferenca'] >= 30 && $dados_processos_tipos[$c]['diferenca'] < 60) {
        echo "<div class='label label-sm parado-30'>";
    } else {
        echo "<div class='label label-sm parado-60'>";
    }

    for ($w = 0; $w < count($tipos); $w++) {
        if ($dados_processos_tipos[$c]['tipo'] == $tipos[$w]['nome']) {
            echo "       <i class='" . $tipos[$w]['icone'] . "'></i>";
        }
    }

    echo "      </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'> <a href='$caminho'>  " . @$dados_processos_tipos[$c]['protocolo'] . " </a></div>
         </div>
    </div>
   </div>
     <div class='col2'>
 <div class='date'> " . @$dados_processos_tipos[$c]['diferenca'] . " dias </div>
  </div>
      </li>";
}
//for para alertas parados
for ($d = 0; $d < count($dados_alertas); $d++) {
    $caminho2=RAIZ.'demandas/exibedemanda_filtro/alerta/'.$dados_alertas[$d]['id_acompanhamento'].'/'.$dados_alertas[$d]['id_documento_sei'].'/'.$dados_alertas[$d]['str_destino_sei'];

    $chave =$dados_alertas[$d]['id_chave'];
//$id_tipos vem do Cpainel os ids dos alertas especificos
    if (!in_array($chave, $id_tipos)) {
        echo "
        <li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'> ";
                        if ($dados_alertas[$d]['tempo'] == 15) {
                            echo "<div class='label label-sm parado-15'>";
                        } else if ($dados_alertas[$d]['tempo'] == 30) {
                            echo "<div class='label label-sm parado-30'>";
                        } else if ($dados_alertas[$d]['tempo'] == 60) {
                            echo "<div class='label label-sm parado-60'>";
                        }
                        echo "     
                        <i class='fa fa-bell-o'></i>
                        </div>
                    </div>
                    <div class='cont-col2'>
                        <div class='desc'><a href='$caminho2'>  " . @$dados_alertas[$d]['protocolo'] . " </a></div>
                    </div>
                </div>
            </div>
            <div class='col2'>
                <div class='date'> " . @$dados_alertas[$d]['diferenca'] . " dias </div>
            </div>
        </li>";
    }
}