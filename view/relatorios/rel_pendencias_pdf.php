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

	/* FIM Pegando data e horário atual quando gera o formulário. */

        $parado_deste = date('d/m/Y', strtotime($periodo));
         
	$html1 = "
            <table style='width:100%'>
                <thead>
                    <tr>
                        <th width='25%' align='left'> <img src='http://www.dpu.def.br/templates/dpu/images/logo.png' height='80px'></th>
                        <th width='50%' align='center'> <font face='arial' color='#373736'>Relatório de Processos da unidade/setor<br>Com mais de $periodopdf dias sem movimentaçãos</font> </th>
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
                        <th align='center'>Origem:</th>
                        <th align='center'>Data Despacho SGE:</th>
                        <th align='center'>Destino:</th>
                        <th align='center'>Resumo de Andamentos:</th>
                        <th align='center'>Ultima movimentação:</th>
                    </tr>
                </thead>";

        $html2 = "<tbody>";

        $html3 = '';
        for ($x = 0; $x < count($id_documento); $x++) {
            $html3 .= "<tr>
                        <td align='center'>$protocolo_formatado[$x]</td>
                        <td align='center'>$assunto[$x]</td>
                        <td align='center'>$uni_origem[$x]</td>
                        <td align='center'>$dt_despacho[$x]</td>
                        <td align='center'>$destino_final[$x]</td>
                        <td align='center'>$resumo[$x]</td>
                        <td align='center'>$vencimento[$x]</td>
                       </tr>";
        }

        $html4 = "</tbody>";
    $html5 = "</table>";

    $html_final = $html1 . $html2 . $html3 . $html4 . $html5;
    
?>