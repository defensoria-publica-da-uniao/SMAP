<?php
require '../../application/configs/config.php';
require '../../model/cGeral.php';
require '../../model/cSmap.php';

$objGeral = new cGeral();
$objSmap = new cSmap();

$regiao = $_GET['regiao'];

$dt_de = $_GET['dt_de'];
$dt_ate = $_GET['dt_ate'];


$consult = $objSmap->selectrel_geral_DPU_regiao($dt_de, $dt_ate, $regiao);

$unidadearray = ARRAY();
$andamentoarray = ARRAY();
$resolvidosarray = ARRAY();


while ($dados = mssql_fetch_array($consult)) {
    if (!in_array($dados['str_uf'], $unidadearray)) {
        $unidadearray[] = $dados['str_uf'];

        if ($dados['int_situ'] == 2) {
            $andamentoarray[] = 1;
            $resolvidosarray[] = 0;
        } else {
            $resolvidosarray[] = 1;
            $andamentoarray[] = 0;
        }
    } else {
        for ($i = 0; $i < count($unidadearray); $i++) {

            if ($unidadearray[$i] == $dados['str_uf']) {
                if ($dados['int_situ'] == 2) {
                    $andamentoarray[$i] ++;
                } else {
                    $resolvidosarray[$i] ++;
                }
            }
        }
    }
}
/*
var_dump($unidadearray);
echo'<br>';
var_dump($andamentoarray);
echo'<br>';
var_dump($resolvidosarray);

*/
$unidadearray2 = implode("+", $unidadearray);
$andamentoarray2 = implode("+", $andamentoarray);
$resolvidosarray2 = implode("+", $resolvidosarray);
?>
      <script src="<?php echo PUBLICO; ?>graficos/js1.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js2.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js3.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js4.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js5.js "></script>
        <link rel="stylesheet" href="<?php echo PUBLICO; ?>graficos/estilografico.css" type="text/css" media="all" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<!-- Styles -->
<style>
    #chartdiv5 {
        width: 100%;
        height: 500px;
    }												
</style>

<style>
    #chartdiv6 {
        width: 100%;
        height: 500px;
    }												
</style>

<script>

    var unidade, andamento, resolvido,regiao;
    //recebe a string com elementos separados, vindos do PHP
    unidade = "<?php echo $unidadearray2; ?>";
    andamento = "<?php echo $andamentoarray2; ?>";
    resolvido = "<?php echo $resolvidosarray2; ?>";
    regiao="<?php echo $regiao?>";
    //Dividir Variável para variar array
    unidade = unidade.split("+");
    andamento = andamento.split("+");
    resolvido = resolvido.split("+");
   



    var chart = AmCharts.makeChart("chartdiv5", {
        "type": "pie",
        "theme": "light",
         "titles": [ {
    "text": regiao+' - Andamento',
    "size": 16
  } ],
        "dataProvider":
                (function () {
                    var dadosArray = [];
                    for (i in andamento) {
                        dadosArray.push({
                            "country": unidade[i],
                            "value": andamento[i]
                        });
                    }
                    return dadosArray;
                }()),
        "valueField": "value",
        "titleField": "country",
        "outlineAlpha": 0.4,
        "depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
            "enabled": true
        }
    });
    var chart2 = AmCharts.makeChart("chartdiv6", {
        "type": "pie",
        "theme": "light",
                        "titles": [ {
    "text": regiao+' - Concluídos',
    "size": 16
  } ],
        "dataProvider":
                (function () {
                    var dadosArray = [];
                    for (k in resolvido) {
                        dadosArray.push({
                            "country": unidade[k],
                            "value": resolvido[k]
                        });
                    }
                    return dadosArray;
                }()),
        "valueField": "value",
        "titleField": "country",
        "outlineAlpha": 0.4,
        "depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
            "enabled": true
        }
    });
</script>




<table style="width:100%">

  <tr>
    <td style="width:50%"><div id="chartdiv5"></div></td>
    <td style="width:50%"><div id="chartdiv6"></div></td>
  </tr>

</table>