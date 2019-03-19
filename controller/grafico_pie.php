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


//INICIO PEGAR ACOMPANHAMENTO CONClUIDO

    $sql1 = $oSmap->selectcampgrafico('3', '30');
    $concluido = mssql_num_rows($sql1);
 


//INICIO PEGAR ACOMPANHAMENTO ABERTO

    $sql2 = $oSmap->selectcampgrafico('1', '30');
    $aberto = mssql_num_rows($sql2);



//INICIO PEGAR ACOMPANHAMENTO Ciente

    $sql3 = $oSmap->selectcampgrafico('4', '30');
    $ciente = mssql_num_rows($sql3);


/*
//Inicio pegar acompanhamento sei 
//$chavesSei vem da consulta da Busca Demandas SGE no Controller Cpainel
    $sei=0;
    for ($i = 0; $i < count($chavesSei); $i++) {
        $sei++;
        if (!in_array($chavesSei[$i], $andamentoid)) {
            if (!in_array($chavesSei[$i], $abertoid)) {
                if (!in_array($chavesSei[$i], $concluidoid)) {
                    if (!in_array($chavesSei[$i], $cienteid)) {
                     //   $sei++;
                    }
                }
            }
        }
    }
 * 
 */
    
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

    <link rel="stylesheet" href="<?php echo PUBLICO.'graficos/estilografico.css';?>" type="text/css" media="all" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
    <?php
}
?>


<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }												
</style>

<!-- Resources -->


<!-- Chart code -->
<script>
    var aberto, andamento, concluido, ciente;
    //recebe a string com elementos separados, vindos do PHP
    aberto = "<?php echo $aberto; ?>";
    andamento = "<?php echo $andamento; ?>";
    concluido = "<?php echo $concluido; ?>";

    ciente = "<?php echo $ciente; ?>";

    var chart = AmCharts.makeChart("chartdiv", {
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
            }, {
                "country": "Ciente",
                "value": ciente
            }],
        "valueField": "value",
        "titleField": "country",
        "outlineAlpha": 0.4,
        "depth3D": 30,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
            "enabled": true
        }
    });
</script>