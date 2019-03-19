<?php 
    require_once INCLUDES . 'validaLogin.php';

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

if ($dpu_dpgu == 'DPGU') {
    $nome_setor = 'TODOS | DPGU - Administração Superior';
} elseif ($dpu_dpgu == 'DPU') {
    $nome_setor = 'TODOS | DPU - Órgão de Atuação (Unidades)';
}

$cabeca = "
        <table style='width:100%'>
            <thead>
                <tr>
                    <th width='25%' align='left'> <img src='http://www.dpu.def.br/templates/dpu/images/logo.png' height='80px'></th>
                    <th width='50%' align='center'> <font face='arial' color='#373736'>Relatório de Processos por Localidade e Status<br>$nome_setor</font> </th>
                    <th width='25%' align='right'> <font face='arial' color='#373736'>$data_atual_extenso<br>Horário: $horario</font> </th>
                </tr>
            </thead>
        </table>

        <br>
        <br>


        <table border='1' cellspacing='0' cellpadding='2' bordercolor='#FFFFFF' align='center' style='width:100%' >
            <thead>
                <tr bgcolor='#E8E8E8'>
                    <th colspan='2'>Total de demandas direcionados à SGE:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width='50%' align='center'>
                        <b>Total Nº:</b><font color='#355256'> $total </font>
                    </td>
                    <td width='50%' align='center'>
                        <b>Período:</b><font color='#355256'> $periodototal </font>
                    </td>                                                
                </tr>
            </tbody>
        </table>

        <br>
        <br>

        <table border='1' cellspacing='0' cellpadding='2' bordercolor='#FFFFFF' align='center' style='width:100%' >
            <thead>
                <tr bgcolor='#E8E8E8'>
                    <th align='center'>Demandas Em Andamento:</th>
                    <th align='center'>Demandas Concluídas:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align='center'><font color='#355256'> $total_andamento </font></td>   
                    <td align='center'><font color='#355256'> $total_concluido </font></td>
                </tr>
            </tbody>
        </table>

        <br>
        <br>
        ";
        $html1 = "
            <table border='1' cellspacing='0' cellpadding='2' bordercolor='#FFFFFF' align='center' style='width:100%' >
                <thead>
                    <tr bgcolor='#E8E8E8'>
                        <th align='center'>";
                            if ($dpu_dpgu == 'DPGU') {
                                $nome = 'Área DPGU';
                            } else if ($dpu_dpgu == 'DPU') {
                                $nome = 'Unidades DPU';
                            }
                        $html2 = "
                        </th>
                        <th align='center'>Andamento:</th>
                        <th align='center'>Concluído:</th>
                        <th align='center'>Total:</th>
                    </tr>
                </thead>
                <tbody> ";
                    for ($x = 0; $x < count($unidadearray); $x++) {
                        $unidade = utf8_encode($unidadearray[$x]);
                        $total = @$andamentoarray[$x] + @$resolvidosarray[$x];
                        @$html3 .= "
                            <tr>
                                <td align='center'> $unidade </td>
                                <td align='center'> $andamentoarray[$x] </td>
                                <td align='center'> $resolvidosarray[$x] </td>
                                <td align='center'> $total </td>
                            </tr>";
                    }
                    $html4 = "
                </tbody>
            </table>
            <br>
            <br>
        ";

@$html_final = $cabeca . $html1 . $nome . $html2 . $html3 . $html4;

?>