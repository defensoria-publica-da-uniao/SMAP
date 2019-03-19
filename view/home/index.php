<?php
require_once INCLUDES . 'validaLogin.php';

ini_set('max_execution_time', 864000);
ini_set('mssql.timeout', 864000);
ini_set('memory_limit', '3024M');

require_once 'controller/painel/Cpainel.php';
require_once 'controller/painel/Calertas_especificos.php';
require_once 'controller/painel/Cprocessos_parados.php';
require_once 'controller/grafico_pie.php';
//require_once 'controller/grafico_coluna.php';

$caminho_parado = CONTROLLER . 'painel/Cprocessos_parados.php';
$caminho_alertas = CONTROLLER . 'painel/Calertas_especificos.php';
$caminho_grafico = CONTROLLER . 'grafico_pie.php';
?>

<script>
    var caminho;
    caminho = '<?php echo $caminho_parado ?>';
    $(document).ready(function () {
        $('.processoParado').click(function () {
            var dias = this.id;
            $.ajax({
                type: 'post',
                url: caminho,
                data: 'processoParado=' + dias,
                success: function (data) {
                    $('.fetched-data3').html(data);
                },
                error: function (data) {

                    alert('eeee');
                }
            });

        });
    });

    var caminho2;
    caminho2 = '<?php echo $caminho_alertas ?>';
    $(document).ready(function () {
        $('.processoAlertas').click(function () {
            var nome = this.id;
            $.ajax({
                type: 'post',
                url: caminho2,
                data: 'processoAlertas=' + nome,
                success: function (data) {
                    $('.fetched-data2').html(data);
                },
                error: function (data) {

                    alert('eeee');
                }
            });

        });
    });

    var caminho3;
    caminho3 = '<?php echo $caminho_grafico ?>';
    $(document).ready(function () {
        $('.grafico').click(function () {
            var nome = this.id;
            $.ajax({
                type: 'post',
                url: caminho3,
                data: 'grafico=' + nome,
                success: function (data) {
                    $('.fetched-data3').html(data);
                },
                error: function (data) {
                    alert('eeee');
                }
            });

        });
    });


</script>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                             <div class="row">    
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-red m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Área de alertas</b></h3>
                                               
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <!-- ALERTAS ESPECIFICOS -->
                                <div class="col-lg-4 col-xs-12 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-globe font-dark hide"></i>
                                                <span class="caption-subject bold  font-dark">Alertas</span>
                                                <span class="caption-helper">Específicos</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class='dropdown-menu pull-right'>
                                                        <?php echo $filtro_esp; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!--BEGIN TABS-->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1_1">
                                                    <div class="scroller" style="height: 235px;" data-always-visible="1" data-rail-visible="0">
                                                        <ul class="feeds">

                                                            <!-- Ordem decresente (menor para o maior). Quando chegar ao último dia mostrar a mensagem em vermelho.
                                                            
                                                                Parados a mais de 15 30 e 60 dias será mostrado o TOTAL de DIAS que estão parados.
                                                            -->

                                                            <div class="fetched-data2">
                                                                <?php
                                                                echo @$html_alerta;
                                                                ?> 
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END TABS-->
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                  <!-- FIM ALERTAS ESPECIFICOS -->
                                  
                                    <!-- Processos Parados/Com Prazo -->
                                <div class="col-lg-4 col-xs-12 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">                                
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-globe font-dark hide"></i>
                                                <span class="caption-subject bold font-dark">Processos Com Prazo</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    
                                                    <ul class="dropdown-menu pull-right">
                                                        <?php echo $filtrar_prazo; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!--BEGIN TABS-->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1_2">
                                                    <div class="scroller" style="height: 235px;" data-always-visible="1" data-rail-visible="0">
                                                        
                                                        <ul class="feeds">
                                                            <!-- Ordem decresente (menor para o maior). Quando chegar ao último dia mostrar a mensagem em vermelho.
                                                            
                                                                Parados a mais de 15 30 e 60 dias será mostrado o TOTAL de DIAS que estão parados.
                                                            -->
                                                            <!-- Vai abrir aqui o conteudo do arquivo ajax -->
                                                            <div class="fetched-data4">
                                                                <?php
                                                                echo @$html_final2;
                                                                ?>

                                                            </div>

                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END TABS-->
                                        </div>
                                        



                                    </div>
                                    <!-- END PORTLET-->
                                 </div>
                                   <!-- FIM Processos Parados/Com Prazo -->
                                    <!-- Processos Parados -->
                                <div class="col-lg-4 col-xs-12 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-globe font-dark hide"></i>
                                                <span class="caption-subject bold font-dark">Processos Sem Resposta</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <?php echo $filtrar_parado; ?>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!--BEGIN TABS-->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1_2222222">
                                                    <div class="scroller" style="height: 235px;" data-always-visible="1" data-rail-visible="0">
                                                        <ul class="feeds">
                                                            <!-- Ordem decresente (menor para o maior). Quando chegar ao último dia mostrar a mensagem em vermelho.
                                                            
                                                                Parados a mais de 15 30 e 60 dias será mostrado o TOTAL de DIAS que estão parados.
                                                            -->
                                                            <!-- Vai abrir aqui o conteudo do arquivo ajax -->
                                                            <div class="fetched-data3">
                                                                <?php
                                                                echo @$html_final3;
                                                                ?>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </div>
                                            <!--END TABS-->
                                        </div>
                                        
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                       <!-- FIM Processos Parados -->
                                   
                              
                            </div>

                            <div class="row">    
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Painel Geral (Últimos 30 dias)</b></h3>
                                                <h4><span class="font-blue-sharp"><?php echo $data_final_painel; ?> </span></h4>
                                               

                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-blue-sharp">
                                                    <span data-counter="counterup" data-value="<?php echo $aberto_total; ?>"></span>
                                                </h3>
                                                <small>Demandas do <span class="font-blue-sharp">SMAP</span> com status <span class="font-blue-sharp">Em Aberto</span></small>
                                            </div>
                                            <div class="icon">
                                                <i class="icon-envelope-letter"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-green-sharp">
                                                    <span data-counter="counterup" data-value="<?php echo $DpguR; ?>"></span>
                                                </h3>
                                                <small>Demandas Concluídas<br><span class="font-green-steel">DPGU</span></small>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                                <span style="width: <?php echo $ProdpguR; ?>%;" class="progress-bar progress-bar-success green-sharp">
                                                    <span class="sr-only"><?php echo $ProdpguR; ?>% progresso</span>
                                                </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title"> progresso </div>
                                                <div class="status-number"> <?php echo $ProdpguR; ?>% </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-red-haze">
                                                    <span data-counter="counterup" data-value="<?php echo $DpguA; ?>"></span>
                                                </h3>
                                                <small>Demandas Em Andamento<br><span class="font-red-haze">DPGU</span></small>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                                <span style="width: <?php echo $ProdpguA; ?>%;" class="progress-bar progress-bar-success red-haze">
                                                    <span class="sr-only"><?php echo $ProdpguA; ?>% progresso</span>
                                                </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title"> progresso </div>
                                                <div class="status-number"> <?php echo $ProdpguA; ?>% </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-green-sharp">
                                                    <span data-counter="counterup" data-value="<?php echo $unidadeR; ?>"></span>
                                                </h3>
                                                <small>Demandas Concluídas<br><span class="font-green-steel">Unidade</span></small>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                                <span style="width: <?php echo $ProunidadeR; ?>%;" class="progress-bar progress-bar-success green-sharp">
                                                    <span class="sr-only"><?php echo $ProunidadeR; ?>% progresso</span>
                                                </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title"> progresso </div>
                                                <div class="status-number"> <?php echo $ProunidadeR; ?>% </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-red-haze">
                                                    <span data-counter="counterup" data-value="<?php echo $unidadeA; ?>"></span>
                                                </h3>
                                                <small>Demandas em Andamento<br><span class="font-red-haze">Unidade</span></small>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                                <span style="width: <?php echo $ProunidadeA; ?>%;" class="progress-bar progress-bar-success red-haze">
                                                    <span class="sr-only"><?php echo $ProunidadeA; ?>% progresso</span>
                                                </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title"> progresso </div>
                                                <div class="status-number"> <?php echo $ProunidadeA; ?>% </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-lg-12 col-xs-12 col-sm-12">
                                    <div style="min-height: 645px;" class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject bold uppercase font-dark">Acompanhamento</span>
                                                <span class="caption-helper">Todas as demandas</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <!--
                                                    <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a id='15' class='grafico'  href="javascript:;">Última Quinzena</a>
                                                        </li>
                                                        <li>
                                                            <a  id='30' class='grafico'  href="javascript:;">Acumulado Mensal</a>
                                                        </li>
                                                        <li>
                                                            <a id='anual' class='grafico'  href="javascript:;">Acumulado Anual</a>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="fetched-data4">
                                                <div  id="chartdiv"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           


                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
    </div>
</div>

<!--
<script src="<?php echo JS; ?>graficos/charts-amcharts.min.js "></script>
<script src="<?php echo JS; ?>graficos/charts-flotcharts.min.js "></script>
-->