
<?php
if (!empty($_POST)) {
    
    @$dt_de1 = $_POST['dt_de'];
    @$dt_de = date('Y-m-d', strtotime((str_replace('/', '-', $dt_de1))));
    @$dt_ate1 = $_POST['dt_ate'];
    @$dt_ate = date('Y-m-d', strtotime((str_replace('/', '-', $dt_ate1))));
    @$dpgu = $_POST['dpgu'];
    @$dpu_dpgu = $_POST['destino_sel'];
    $periodototal = "$dt_de1 - $dt_ate1";

    $unidadearray = ARRAY();
    $andamentoarray = ARRAY();
    $resolvidosarray = ARRAY();
    $totalarray = ARRAY();

    if ($dpu_dpgu == 'DPGU') {
        //Secretaria
        $consult = $objSmap->selectrel_geral_DPGU($dt_de, $dt_ate);
        $_SESSION['DPGU'] = 1;
    } else {
        //Unidade
        $consult = $objSmap->selectrel_geral_DPU($dt_de, $dt_ate);
        $_SESSION['DPU'] = 1;
    }

    while ($result = mssql_fetch_array($consult)) {
        //echo '<pre>';
        //var_dump($result['int_situ']);
        //echo '</pre>';
        if (empty($unidadearray)) {
            if ($dpu_dpgu == 'DPGU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                $unidadearray[] = $result['str_sigla'];
            } else if ($dpu_dpgu == 'DPU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                $unidadearray[] = "{$result['str_uf']} - {$result['str_descricao']}";
            }
            switch ($result['int_situ']) {
                case 2:
                    $andamentoarray[] ++;
                    $resolvidosarray[] = 0;
                    break;
                case 3:
                    $resolvidosarray[] ++;
                    $andamentoarray[] = 0;
                    break;
                default :
                    $totalarray[] ++;
                    break;
            }
        } else {
            if ($dpu_dpgu == 'DPGU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                $unidade_verifica = $result['str_sigla'];
                
                
            } else if ($dpu_dpgu == 'DPU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                $unidade_verifica = "{$result['str_uf']} - {$result['str_descricao']}";
                
            } else {
                $unidade_verifica = "";
            }
            if (in_array($unidade_verifica, $unidadearray)) {

                for ($i = 0; $i < count($unidadearray); $i++) {
                    if ($unidade_verifica == $unidadearray[$i]) {
                        switch ($result['int_situ']) {
                            case 2:
                                @$andamentoarray[$i] ++;
                                break;
                            case 3:
                                @$resolvidosarray[$i] ++;
                                break;
                            default :
                                $totalarray[] ++;
                                break;
                        }
                    }
                }
            } else {

                if ($dpu_dpgu == 'DPGU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                    $unidadearray[] = $result['str_sigla'];
                } else if ($dpu_dpgu == 'DPU' && ($result['int_situ'] == 2 || $result['int_situ'] == 3)) {
                    $unidadearray[] = "{$result['str_uf']} - {$result['str_descricao']}";
                }
                switch ($result['int_situ']) {
                    case 2:
                        $andamentoarray[] ++;
                        $resolvidosarray[] = 0;
                        break;
                    case 3:
                        $resolvidosarray[] ++;
                        $andamentoarray[] = 0;
                        break;
                    default :
                        $totalarray[] ++;
                        break;
                }
            }
        }
    }

    //echo '<pre>';
    //var_dump($unidadearray);
    //var_dump($andamentoarray);
    //echo '</pre>';


    $unidadearray2 = implode("+", $unidadearray);
    $andamentoarray2 = implode("+", $andamentoarray);
    $resolvidosarray2 = implode("+", $resolvidosarray);

    if (@$dpu_dpgu == 'DPU') {
        $locais = ARRAY();
        $total = ARRAY();
        for ($x = 0; $x < count($unidadearray); $x++) {
            $ex = explode('-', $unidadearray[$x]);
            $locais[] = $ex[0];
            $total[] = $andamentoarray[$x] + $resolvidosarray[$x];
        }
        /* Condição para Estados repetidos;
          for($y=0; $y<count($locais); $y++){

          }
         * 
         */

        $locais = implode("+", $locais);
        $total = implode("+", $total);
    }

    $norte = ARRAY('regiao'      => 'Norte', 
                   'concluido'   => 0, 
                   'total'       => 0, 
                   'porcentagem' => 0);
    
    $nordeste = ARRAY('regiao'      => 'Nordeste', 
                      'concluido'   => 0, 
                      'total'       => 0, 
                      'porcentagem' => 0);
    
    $sul = ARRAY('regiao'      => 'Sul', 
                 'concluido'   => 0, 
                 'total'       => 0, 
                 'porcentagem' => 0);
    
    $sudeste = ARRAY('regiao'      => 'Sudeste', 
                     'concluido'   => 0, 
                     'total'       => 0, 
                     'porcentagem' => 0);
    
    $c_oeste = ARRAY('regiao'      => 'Centro-Oeste', 
                     'concluido'   => 0, 
                     'total'       => 0, 
                     'porcentagem' => 0);

    $consult = $objSmap->select_graf($dt_de, $dt_ate);
    
    while ($result = mssql_fetch_array($consult)) {
        switch ($result['str_regiao']) {
            case 'Norte':
                $norte['total'] ++;
                if ($result['int_situ'] == 3) {
                    $norte['concluido'] ++;
                }
                break;
            case 'Nordeste':
                $nordeste['total'] ++;
                if ($result['int_situ'] == 3) {
                    $nordeste['concluido'] ++;
                }
                break;
            case 'Sul':
                $sul['total'] ++;
                if ($result['int_situ'] == 3) {
                    $sul['concluido'] ++;
                }
                break;
            case 'Sudeste':
                $sudeste['total'] ++;
                if ($result['int_situ'] == 3) {
                    $sudeste['concluido'] ++;
                }
                break;
            case 'Centro-oeste':
                $c_oeste['total'] ++;
                if ($result['int_situ'] == 3) {
                    $c_oeste['concluido'] ++;
                }
                break;
        }
    }

    if ($norte['total'] != 0) {
        $norte['porcentagem'] = number_format(($norte['concluido'] * 100) / $norte['total'], 2);
    }
    if ($nordeste['total'] != 0) {
        $nordeste['porcentagem'] = number_format(($nordeste['concluido'] * 100) / $nordeste['total'], 2);
    }
    if ($sul['total'] != 0) {
        $sul['porcentagem'] = number_format(($sul['concluido'] * 100) / $sul['total'], 2);
    }
    if ($sudeste['total'] != 0) {
        $sudeste['porcentagem'] = number_format(($sudeste['concluido'] * 100) / $sudeste['total'], 2);
    }
    if ($c_oeste['total'] != 0) {
        $c_oeste['porcentagem'] = number_format(($c_oeste['concluido'] * 100) / $c_oeste['total'], 2);
    }

    $norte    = implode("+", $norte);
    $nordeste = implode("+", $nordeste);
    $sul      = implode("+", $sul);
    $sudeste  = implode("+", $sudeste);
    $c_oeste  = implode("+", $c_oeste);

    //Gerando TAbela para gravar em variavel para depois exporta-la
    $total = array_sum($totalarray);
    $total_andamento = array_sum($andamentoarray);
    $total_concluido = array_sum($resolvidosarray);

    // HTML da página que vai gerar o PDF
    include_once 'view/relatorios/rel_geral_pdf.php';
    // FIM HTML da página que vai gerar o PDF
}







if (@$dpu_dpgu == 'DPGU') {
    ?>

    <!-- Styles -->
    <style>
        #chartdiv1Porc {
            width: 100%;
            height: 1000px;
        }												
    </style>

    <style>
        #chartdiv2Porc {
            width: 100%;
            height: 1000px;
        }												
    </style>
     <style>
        #chartdiv1Quant {
            width: 100%;
            height: 1000px;
        }												
    </style>

    <style>
        #chartdiv2Quant {
            width: 100%;
            height: 1000px;
        }												
    </style>

    <!-- Resources -->


    <!-- Chart code -->
    <script>

        var secretaria, andamento;
        //recebe a string com elementos separados, vindos do PHP
        secretaria = "<?php echo $unidadearray2; ?>";
        andamento = "<?php echo $andamentoarray2; ?>";
        resolvido = "<?php echo $resolvidosarray2; ?>";
        //Dividir Variável para variar array
        secretaria = secretaria.split("+");
        andamento = andamento.split("+");
        resolvido = resolvido.split("+");
        //Porcentagem
        var chart = AmCharts.makeChart("chartdiv1Porc", {
            "type": "pie",
            "theme": "light",
              "titles": [{
                "text": "Em Andamento",
                "size": 16
            }],
            "dataProvider":
                    (function () {
                        var dadosArray = [];
                        for (i in andamento) {
                            dadosArray.push({
                                "country": secretaria[i],
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
        
        var chart2 = AmCharts.makeChart("chartdiv2Porc", {
            "type": "pie",
            "theme": "light",
               "titles": [{
                "text": "Concluídos",
                "size": 16
            }],
            "dataProvider":
                    (function () {
                        var dadosArray = [];
                        for (i in resolvido) {
                            dadosArray.push({
                                "country": secretaria[i],
                                "value": resolvido[i]
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
 //Quantitativo
      var chart3 = AmCharts.makeChart("chartdiv1Quant", {
            "type": "pie",
            "theme": "light",
              "titles": [{
                "text": "Em Andamento",
                "size": 16
            }],
            "dataProvider":
                    (function () {
                        var dadosArray = [];
                        for (i in andamento) {
                            dadosArray.push({
                                "country": secretaria[i],
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
            }  ,
                    "labelRadius": -35,
                       "labelText": "[[litres]]",
                                   "legend":{
   	"position":"bottom",
   "marginLeft":50,
    "marginRight":50,
   
    "autoMargins":false
  }
                    
        });
         var chart4 = AmCharts.makeChart("chartdiv2Quant", {
            "type": "pie",
            "theme": "light",
               "titles": [{
                "text": "Concluídos",
                "size": 16
            }],
            "dataProvider":
                    (function () {
                        var dadosArray = [];
                        for (i in resolvido) {
                            dadosArray.push({
                                "country": secretaria[i],
                                "value": resolvido[i]
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
            },
                               "labelRadius": -35,
             "labelText": "[[litres]]",
                     "legend":{
   	"position":"bottom",
   "marginLeft":50,
    "marginRight":50,
   
    "autoMargins":false
  }
 });
    </script>


<?php } else if (@$dpu_dpgu == 'DPU') {
    ?>

    <script type="text/javascript" src="<?php echo JS; ?>ammap.js"></script>

    <script type="text/javascript" src="<?php echo JS; ?>brazilLow.js"></script>

    <!-- 
     "color":"#101E5A",
                "colorSolid":"#D31200"
    //background: #3f3f4f;
    "color":"#FFFFFF",
                "colorSolid":"#000000"-->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;

        }
    </style>

    <script>
        //variáveis
        var i, arraylocais, arraytotal;
        //recebe a string com elementos separados, vindos do PHP
        arraylocais = "<?php echo $locais; ?>";
        arraytotal = "<?php echo $total; ?>";
        //transforma esta string em um array próprio do Javascript
        arraylocais = arraylocais.split("+");
        arraytotal = arraytotal.split("+");
        //alert( arraytotal);

        var map = AmCharts.makeChart("chartdiv4", {
            "type": "map",
            "theme": "light",
            "colorSteps": 35,
            "dataProvider": {
                "map": "brazilLow",
                "getAreasFromMap": true,
                "zoomLevel": 0.9,
                //Posso usar id,value,description,percent
                "areas": function () {
                    var dadosArray = [];
                    for (i in arraylocais) {

                        dadosArray.push({
                            "id": "BR-" + arraylocais[i],
                            "value": arraytotal[i],
                        })
                    }
                    return dadosArray;
                }()

            },
            "areasSettings": {
                "autoZoom": true,
                "balloonText": "[[title]]:<strong>[[value]]</strong>",
                "color": "#ADD8E6",
                "colorSolid": "#000000"

            },
            "legend": {
                "width": 240,
                "marginRight": 20,
                "marginLeft": 20,
                "equalWidths": true,
                "maxColumns": 2,
                "backgroundAlpha": 0.5,
                "backgroundColor": "#FFFFFF",
                "borderColor": "#ffffff",
                "borderAlpha": 1,
                "right": 0,
                "horizontalGap": 10,
                "switchable": true,
                "data": (function () {
                    var dadosArray = [];
                    for (i in arraylocais) {
                        dadosArray.push({
                            "id": "BR-" + arraylocais[i],
                            "title": arraylocais[i] + ' - ' + arraytotal[i],
                            "color": "#83c2ba"

                        })
                    }
                    return dadosArray;
                }())
            },
            "valueLegend": {
                "right": 10,
                "minValue": "Pouco",
                "maxValue": "Muito!"
            },
            "zoomControl": {
                "minZoomLevel": 0.9
            },
            "titles": 'titles',
            "listeners": [{
                    "event": "clickMapObject",
                }]


        });
        map.addListener('init', function () {
            //map.legend.switchable = true;
            map.legend.addListener("clickMarker", AmCharts.myHandleLegendClick);
            map.legend.addListener("clickLabel", AmCharts.myHandleLegendClick);
        });
        AmCharts.myHandleLegendClick = function (event) {
            var id = event.dataItem.id;
            if (undefined !== event.dataItem.hidden && event.dataItem.hidden) {
                event.dataItem.hidden = false;
                map.showGroup(id);
            } else {
                event.dataItem.hidden = true;
                map.hideGroup(id);
            }
            map.legend.validateNow();
        };
        function updateHeatmap(event) {
            var map = event.chart;
            if (map.dataGenerated)
                return;
            if (map.dataProvider.areas.length === 0) {
                setTimeout(updateHeatmap, 100);
                return;
            }

            /*
             for ( var i = 0; i < map.dataProvider.areas.length; i++ ) {
             map.dataProvider.areas[ i ].value = Math.round( i * 1 );
             }*/
            map.dataGenerated = true;
            map.validateNow();
        }
        ;
    </script>

    <style>
        #chartdivu {
            width		: 100%;
            height		: 500px;
            font-size	: 11px;
        }						
    </style>


    <script>











        var norte, nordeste, sul, sudeste, c_oeste;
        //recebe a string com elementos separados, vindos do PHP
        norte = "<?php echo $norte; ?>";
        nordeste = "<?php echo $nordeste; ?>";
        sul = "<?php echo $sul; ?>";
        sudeste = "<?php echo $sudeste; ?>";
        c_oeste = "<?php echo $c_oeste; ?>";
        //Dividir Variável para variar array
        norte = norte.split("+");
        nordeste = nordeste.split("+");
        sul = sul.split("+");
        sudeste = sudeste.split("+");
        c_oeste = c_oeste.split("+");

        var chart = AmCharts.makeChart("chartdivu", {
            "type": "serial",
            "theme": "light",
            "categoryField": "regiao",
            "rotate": true,
            "startDuration": 1,
            "categoryAxis": {
                "gridPosition": "start",
                "position": "left"
            },
            "graphs": [
                {
                    "balloonText": "Concluídos: [[value]]",
                    "fillAlphas": 0.8,
                    "id": "AmGraph-1",
                    "lineAlpha": 0.2,
                    "title": "Concluídos",
                    "type": "column",
                    "valueField": "Concluídos"
                },
                {
                    "balloonText": "Total: [[value]]",
                    "fillAlphas": 0.8,
                    "id": "AmGraph-2",
                    "lineAlpha": 0.2,
                    "title": "Total",
                    "type": "column",
                    "valueField": "Total"
                },
                {
                    "balloonText": "Porcentagem: [[value]]%",
                    "fillAlphas": 0.8,
                    "id": "AmGraph-3",
                    "lineAlpha": 0.2,
                    "title": "Porcentagem",
                    "type": "column",
                    "valueField": "Porcentagem"
                }
            ],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "position": "bottom",
                    "axisAlpha": 0
                }
            ],
            "dataProvider": [
                {
                    "regiao": norte[0],
                    "Concluídos": norte[1],
                    "Total": norte[2],
                    "Porcentagem": norte[3]
                },
                {
                    "regiao": sul[0],
                    "Concluídos": sul[1],
                    "Total": sul[2],
                    "Porcentagem": sul[3]
                },
                {
                    "regiao": sudeste[0],
                    "Concluídos": sudeste[1],
                    "Total": sudeste[2],
                    "Porcentagem": sudeste[3]
                },
                {
                    "regiao": c_oeste[0],
                    "Concluídos": c_oeste[1],
                    "Total": c_oeste[2],
                    "Porcentagem": c_oeste[3]
                },
                {
                    "regiao": nordeste[0],
                    "Concluídos": nordeste[1],
                    "Total": nordeste[2],
                    "Porcentagem": nordeste[3]
                }
            ],
            "export": {
                "enabled": true
            }

        });
    </script>
<?php } ?>

