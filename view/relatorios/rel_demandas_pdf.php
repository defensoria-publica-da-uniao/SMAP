<?php

/* Pegando data e horário atual quando gera o formulário  */
$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');

$semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
);

$mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
);

//$data_atual_extenso = $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";
$data_atual_extenso = $semana["$data"] . ", " . date('d/m/y');
$horario = date('H:i');
/* FIM Pegando data e horário atual quando gera o formulário  */

$html3 = '';

$html1 = "
       <table style='width:100%'>
                <thead>
                    <tr>
                        <th width='25%' align='left'> <img src='http://www.dpu.def.br/templates/dpu/images/logo.png' height='80px'></th>
                        <th width='50%' align='center'> <font face='arial' color='#373736'>Relatório de Processos da unidade/setor<br></font> </th>
                        <th width='25%' align='right'> <font face='arial' color='#373736'>$data_atual_extenso<br>Horário: $horario</font> </th>
                    </tr>
                </thead>
            </table>

            <br>
            <br>

        <table border='1' cellspacing='0' cellpadding='2' bordercolor='#FFFFFF' align='center' style='width:100%' >
            <thead>
                <tr bgcolor='#E8E8E8'>
                    <th align='center'>Número do Processo:</th>
                    <th align='center'>Assunto do Encaminhamento:</th>
                    <th align='center'>Unidade Origem:</th>
                    <th align='center'>Data Despacho SGE:</th>
                    <th align='center'>Destino:</th>
                    <th align='center'>Resumo de Andamentos:</th>
                    <th align='center'>Situação:</th>
                </tr>
            </thead>";
$html2 = "<tbody>";

for ($x = 0; $x < count($id_documento); $x++) {
    if ($situ_final[$x] == 1) {
        $situacao = 'Em Aberto';
    } else if ($situ_final[$x] == 2) {
        $situacao = 'Em Andamento';
    } else if ($situ_final[$x] == 3) {
        $situacao = 'Concluído';
    } else if ($situ_final[$x] == 4) {
        $situacao = 'Ciente';
    };
    //Ver quantos [(Data de resumos) existem no resumo
    $contagem_especial = substr_count($resumo[$x], '[');
    $resumo_corrigido = '';

    $explode = explode("[", $resumo[$x]);
//pulando linha a cada resumo novo
    for ($h = 0; $h <= $contagem_especial; $h++) {
        if (empty($resumo_corrigido)) {  
            //Colocando -8 pois estava acrescentenado [ a mais (Bug?)
            $resumo_corrigido = "-/*".$explode[$h];
        } else {
            $resumo_corrigido=$resumo_corrigido.'<br>'.'['.$explode[$h];
        }
    }
    //limpando -8;
  $resumo_corrigido= ltrim(str_replace('-/*','', $resumo_corrigido));

//limpando ? do assunto
 $assunto_corrigido=str_replace('&#8203;', '', $assunto[$x]);
  $assunto_corrigido=str_replace('.', '', $assunto_corrigido);

    $html3 .= "<tr>
                    <td align='center'>$protocolo_formatado[$x]</td>
                    <td align='center'>$assunto_corrigido</td>
                    <td align='center'>$uni_origem[$x]</td>
                    <td align='center'>$dt_despacho[$x]</td>
                    <td align='center'>$destino_final[$x]</td>
                    <td align='center'>$resumo_corrigido</td>
                    <td align='center'>$situacao</td>
                   </tr> ";
}


$html4 = "</tbody>";
$html5 = "</table>";

$html_final = $html1 . $html2 . $html3 . $html4 . $html5;
?>