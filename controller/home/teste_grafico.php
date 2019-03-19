<script>
    <!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    </script>

<?php
$idunidades_destinos = $_GET['opcao'];

require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';
require_once '../' . MODELS . 'cSmap.php';
require_once '../' . MODELS . 'cSei.php';

$oSei = new cSei();
$oSmap = new cSmap();

    if ($idunidades_destinos == 'DPU') {
        $result = $oSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');
        while ($row = mysql_fetch_array($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['str_sigla'] . "</option>";
        }
        echo "<option value='" . $row['id'] . "'>OPA  DPU</option>";
    } else if ($idunidades_destinos == 'DPGU') {
        echo "<option value='" . $row['id'] . "'>OPA DPGU</option>";
    }
    
    
//INICIO PEGAR ACOMPANHAMENTO EM ANDAMENTO

$sql = $oSmap->selectcampgrafico('2', '15');
$andamento = mssql_num_rows($sql);
$andamentoid = Array();
while ($arDados = mssql_fetch_array($sql)) {
    $andamentoid[] = $arDados['id_documento_sei'];
};

//INICIO PEGAR ACOMPANHAMENTO CONClUIDO

$sql1 = $oSmap->selectcampgrafico('3', '15');
$concluido = mssql_num_rows($sql1);
$concluidoid = Array();
while ($arDados1 = mssql_fetch_array($sql1)) {
    $concluidoid[] = $arDados1['id_documento_sei'];
};


//INICIO PEGAR ACOMPANHAMENTO ABERTO

$arid_documento = array();
$sql2 = $oSei->selectsei2();

while ($arDados2 = mssql_fetch_array($sql2)) {
  
    if (!in_array($arDados2['id_documento_sei'], $andamentoid)) {
        if (!in_array($arDados2['id_documento_sei'], $concluidoid)) {
            if (!in_array($arDados2['id_documento_sei'], $arid_documento)) {
                @$aberto++;
                $arid_documento[] = $arDados2['id_documento_sei'];
            }
        }
    }
}
?>



<!-- Styles -->
<style>
    #chartdiv2 {
        width: 100%;
        height: 500px;
    }												
</style>

<!-- Resources -->


<!-- Chart code -->
<script>
    var aberto, andamento, concluido;
    //recebe a string com elementos separados, vindos do PHP
    aberto = "<?php echo $aberto; ?>";
    andamento = "<?php echo $andamento; ?>";
    concluido = "<?php echo $concluido; ?>";

    var chart = AmCharts.makeChart("chartdiv2", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [{
                "country": "Em andamento",
                "value": andamento
            }, {
                "country": "Resolvidos",
                "value": concluido
            }, {
                "country": "Em aberto",
                "value": aberto
            }, ],
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