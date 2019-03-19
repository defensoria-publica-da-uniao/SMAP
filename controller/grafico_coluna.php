<?php
if (empty($_POST)) {
    require_once INCLUDES . 'validaLogin.php';
//require_once 'controller/dadosini.php';

    require_once 'model/cSmap.php';
    require_once 'model/cSei.php';
    $oSmap = new cSmap();
    $oSei = new cSei();


//INICIO PEGAR ACOMPANHAMENTO EM ANDAMENTO

    $sql = $oSmap->selectcampgrafico('2', '30');
    $andamento = mssql_num_rows($sql);
    $andamentoid = Array();
    while ($arDados = mssql_fetch_array($sql)) {
        $andamentoid[] = $arDados['id_documento_sei'] . $arDados['str_destino_sei'];
    };

//INICIO PEGAR ACOMPANHAMENTO CONClUIDO

    $sql1 = $oSmap->selectcampgrafico('3', '30');
    $concluido = mssql_num_rows($sql1);
    $concluidoid = Array();
    while ($arDados1 = mssql_fetch_array($sql1)) {
        $concluidoid[] = $arDados1['id_documento_sei'] . $arDados1['str_destino_sei'];
    };


//INICIO PEGAR ACOMPANHAMENTO ABERTO

    $sql2 = $oSmap->selectcampgrafico('1', '30');
    $aberto = mssql_num_rows($sql2);
    $abertoid = Array();
    while ($arDados1 = mssql_fetch_array($sql2)) {
        $abertoid[] = $arDados1['id_documento_sei'] . $arDados1['str_destino_sei'];
    };


//INICIO PEGAR ACOMPANHAMENTO Ciente

    $sql3 = $oSmap->selectcampgrafico('4', '30');
    $ciente = mssql_num_rows($sql3);
    $cienteid = Array();
    while ($arDados1 = mssql_fetch_array($sql3)) {
        $cienteid[] = $arDados1['id_documento_sei'] . $arDados1['str_destino_sei'];
    };


//Inicio pegar acompanhamento sei 
//$chavesSei vem da consulta da Busca Demandas SGE no Controller Cpainel
    $sei = 0;
    for ($i = 0; $i < count($chavesSei); $i++) {
        $sei++;
        if (!in_array($chavesSei[$i], $andamentoid)) {
            if (!in_array($chavesSei[$i], $abertoid)) {
                if (!in_array($chavesSei[$i], $concluidoid)) {
                    if (!in_array($chavesSei[$i], $cienteid)) {
                      //  $sei++;
                    }
                }
            }
        }
    }
} else {

    session_start();
    require_once 'alert.php';
    require_once '../application/configs/config.php';
    require_once '../model/cGeral.php';
    require_once MODELS . 'cBanco.php';
    require_once MODELS . 'cSmap.php';
    $oGeral = new cGeral();
    $oBanco = new cBanco();
    $oSmap = new cSmap();



//INICIO PEGAR ACOMPANHAMENTO EM ANDAMENTO

    $sql = $oSmap->selectcampgrafico('2', '30');
    $andamento = mssql_num_rows($sql);


//INICIO PEGAR ACOMPANHAMENTO CONClUIDO

    $sql1 = $oSmap->selectcampgrafico('3', '30');
    $concluido = mssql_num_rows($sql1);


//INICIO PEGAR ACOMPANHAMENTO ABERTO

    $sql2 = $oSmap->selectcampgrafico('1', '30');
    $aberto = mssql_num_rows($sql2);



//INICIO PEGAR ACOMPANHAMENTO Ciente

    $sql3 = $oSmap->selectcampgrafico('4', '30');
    $ciente = mssql_num_rows($sql3);

    $sei = 0;
    ?>
    <script src="<?php echo PUBLICO . 'graficos/js1.js'; ?> "></script>
    <script src="<?php echo PUBLICO . 'graficos/js2.js'; ?> "></script>
    <script src="<?php echo PUBLICO . 'graficos/js3.js'; ?> "></script>
    <script src="<?php echo PUBLICO . 'graficos/js4.js'; ?> "></script>
    <script src="<?php echo PUBLICO . 'graficos/js5.js'; ?> "></script>

    <link rel="stylesheet" href="<?php echo PUBLICO . 'graficos/estilografico.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/> <?php } ?>
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    .amcharts-export-menu-top-right {
        top: 10px;
        right: 0;
    }
</style>



<!-- Chart code -->
<script>
        var aberto, andamento, concluido, sei, ciente;
    //recebe a string com elementos separados, vindos do PHP
    aberto = "<?php echo $aberto; ?>";
    andamento = "<?php echo $andamento; ?>";
    concluido = "<?php echo $concluido; ?>";
    sei = "<?php echo $sei; ?>";
    ciente = "<?php echo $ciente; ?>";
    
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": [{
                "country": "SEI",
                "visits": sei,
                "color": "#1E90FF"
            }, {
                "country": "Em Andamento",
                "visits": andamento,
                "color": "#FFD700"
            }, {
                "country": "Em Aberto",
                "visits": aberto,
                "color": "#F08080"
            }, {
                "country": "Concluidos",
                "visits": concluido,
                "color": "#008000"
            }, {
                "country": "Ciente",
                "visits": ciente,
                "color": "#4B0082"
            }, ],
        "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
                "title": ""
            }],
        "startDuration": 1,
        "graphs": [{
                "balloonText": "<b>[[category]]: [[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "export": {
            "enabled": true
        }

    });
</script>