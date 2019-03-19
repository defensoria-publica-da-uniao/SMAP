<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/relatorios/Crel_geral.php';
?>


<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <div class="page-content-inner">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <?php
                                    // MENSAGEM DE SUCESSO
                                    if (!empty($_SESSION['msg_relatorio'])) {
                                        $msg = $_SESSION['msg_relatorio'];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-offset-3 col-lg-offset-3 col-xl-offset-3 col-md-6 col-lg-6 col-xl-6">
                                                <div class="alert alert-block alert-msn-texto fade in alert-msn-borda">
                                                    <button type="button" class="close" data-dismiss="alert"></button>
                                                    <h4 align="center" class="alert-heading bold">Sucesso!</h4>
                                                    <p align="center" style="text-transform: capitalize!important;"><?php echo $msg ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    unset($_SESSION['msg_relatorio']);
                                    // FIM MENSAGEM DE SUCESSO
                                    ?>

                                    <?php
                                    // MENSAGEM DE ERRO - EMAIL NÃO ENCONTRADO
                                    if (!empty($_SESSION['msg_relatorio_erro'])) {
                                        $msg = $_SESSION['msg_relatorio_erro'];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-offset-3 col-lg-offset-3 col-xl-offset-3 col-md-6 col-lg-6 col-xl-6">
                                                <div class="alert alert-block alert-msn-texto-erro fade in alert-msn-borda-erro">
                                                    <button type="button" class="close" data-dismiss="alert"></button>
                                                    <h4 align="center" class="alert-heading bold">Erro!</h4>
                                                    <p align="center" ><?php echo $msg ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    unset($_SESSION['msg_relatorio_erro']);
                                    // FIM MENSAGEM DE ERRO - EMAIL NÃO ENCONTRADO
                                    ?>

                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Relatório Geral da Unidade</b></h3>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="portlet light ">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 align="center"class="panel-title">Filtros</h3>
                                            </div>
                                            <form  class="rounded" method="POST" action="<?php echo RAIZ . 'relatorios/rel_geral' ?>" enctype="multipart/form-data" onSubmit="return valida()">

                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3">

                                                            <span class="help-block" align="left">Destino:</span>
                                                            <select name="destino_sel" id="opcao1" class="form-control" required>
                                                                <option value="">Selecione</option>                                        
                                                                <option value="DPGU">TODOS | DPGU - Administração Superior</option>
                                                                <option value="DPU">TODOS | DPU - Órgão de Atuação (Unidade)</option>
                                                            </select>


                                                        </div>
                                                        <div class="col-md-5 col-lg-4">
                                                            <span style="text-align: left !important;" class="help-block"> Data Despacho SGE: </span>
                                                            <div class="input-group input-large date-picker input-daterange " data-date-format="dd/mm/yyyy" >
                                                                <input type="text" class="form-control"  placeholder="Data Inicial" name="dt_de" required>
                                                                <span class="input-group-addon"> até </span>
                                                                <input type="text" class="form-control"  placeholder="Data Final" name="dt_ate" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-lg-2">
                                                            <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                            <input type="submit" name="Submit"  class="btn btn-primary" value="Filtrar"  />
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <hr>

                                        <?php if (!empty($_POST)) { ?>

                                            <div class="portlet-title">
                                                <div class="caption font-dark">
                                                    <span class="caption-subject ">
                                                        <i class="glyphicon glyphicon-stop"></i> 
                                                        Por destino <span class="font-blue-sharp"><?php echo $dpu_dpgu ?></span> 
                                                        entre <span class="font-blue-sharp"><?php echo $periodototal ?></span>
                                                    </span>
                                                </div>
                                                <div class="tools"> </div>
                                            </div>

                                            <div class="portlet-body" >
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" colspan="2">Total de demandas direcionados à SGE:</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="50%" align="center"><b>Total Nº:  </b>
                                                                <span class="font-blue-sharp">
                                                                    <?php
                                                                    echo $total = $total_andamento + $total_concluido;
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td width="50%" align="center">
                                                                <b>Período: </b>
                                                                <span class="font-blue-sharp">
                                                                    <?php
                                                                    if (!empty($_POST)) {
                                                                        echo $periodototal;
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </td>                                                
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <?php if ($dpu_dpgu == 'DPGU') { ?>
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" >Demandas Em Andamento - DPGU:</th>
                                                                <th class="text-center" >Demandas Concluídas - DPGU:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center"><?php echo $total_andamento; ?></td>   
                                                                <td class="text-center"><?php echo $total_concluido; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>

                                                <br>

                                                <?php if ($dpu_dpgu == 'DPU') { ?>
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" >Demandas Em Andamento - Unidades:</th>
                                                                <th class="text-center" >Demandas Concluídas - Unidades:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center"><?php echo $total_andamento; ?></td> 
                                                                <td class="text-center"><?php echo $total_concluido; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>

                                                <br>
                                                <br>


                                                <table class="table table-striped table-bordered table-hover"  id="sample_4_exp">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" >
                                                                <?php
                                                                if ($dpu_dpgu == 'DPGU') {
                                                                    echo'Área DPGU';
                                                                } else if ($dpu_dpgu == 'DPU') {
                                                                    echo 'Unidades DPU';
                                                                }
                                                                ?>
                                                            </th>
                                                            <th class="text-center" >Andamento:</th>
                                                            <th class="text-center" >Concluído:</th>
                                                            <th class="text-center" >Total:</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        for ($x = 0; $x < count($unidadearray); $x++) {
                                                            $unidade = utf8_encode($unidadearray[$x]);
                                                            $total = @$andamentoarray[$x] + @$resolvidosarray[$x];
                                                            ?>
                                                            <tr>
                                                                <td class="text-center" ><?php echo $unidade ?></td>
                                                                <td class="text-center" ><?php
                                                                    echo $andamentoarray[$x];
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" ><?php
                                                                    echo $resolvidosarray[$x];
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" ><?php
                                                                    echo $total;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>

                                        <?php } ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php if (!empty($_POST)) { ?>

                            <?php if ($dpu_dpgu == 'DPGU') { ?>
                                <!--   
                           <div class="row">
                                       <div class="col-lg-6 col-xs-12 col-sm-12">
                                           <div class="portlet light ">
                                          
                                               <div class="portlet-body" >
                                                   <div id="chartdiv"></div>
                                               </div>
                                           </div>
                                       </div>

                                       <div class="col-lg-6 col-xs-12 col-sm-12">
                                           <div class="portlet light ">
                                       
                                               <div class="portlet-body" >
                                                   <div id="chartdiv2"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                -->
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">

                                        <div style="height: 1200px !important;" class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject bold uppercase font-dark">Geral</span>
                                                    <span class="caption-helper"></span>
                                                </div>
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <select class="form-control"   id="filtro_grafico" name="filtro_grafico"  >
                                                            <option value="Porcentagem">Gráfico Porcentagem</option>
                                                            <option  value="Quantitativo">Gráfico Quantitativo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="fetched-data3">
                                                    <!-- INICIO Gráfico Porcentagem -->
                                                    <div id="PorcentagemDiv" >
                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                            <div class="portlet light ">

                                                                <div class="portlet-body" >
                                                                    <div id="chartdiv1Porc"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                            <div class="portlet light ">

                                                                <div class="portlet-body" >
                                                                    <div id="chartdiv2Porc"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- FIM Gráfico Porcentagem -->
                                                    <!-- INICIO Gráfico Quantitativo -->
                                                    <div id="QuantitativoDiv" >
                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                            <div class="portlet light ">

                                                                <div class="portlet-body" >
                                                                    <div id="chartdiv1Quant"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-xs-12 col-sm-12">
                                                            <div class="portlet light ">

                                                                <div class="portlet-body" >
                                                                    <div id="chartdiv2Quant"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- FMI Gráfico Quantitativo -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } else if ($dpu_dpgu == 'DPU') { ?>

                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">

                                        <div style="min-height: 645px;" class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject bold uppercase font-dark">Geral</span>
                                                    <span class="caption-helper">Demandas concluídas, total de demandas recebidas e porcetagem de demandas concluídas.</span>
                                                </div>
                                                <div class="actions">
                                                    <div class="btn-group">

                                                        <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a class='Norte'  >Norte</a>
                                                            </li>
                                                            <li>
                                                                <a class='Sul' >Sul</a>
                                                            </li>
                                                            <li>
                                                                <a class='Sudeste'  >Sudeste</a>
                                                            </li> 
                                                            <li>
                                                                <a class='Centro-Oeste'  >Centro-Oeste</a>
                                                            </li>
                                                            <li>
                                                                <a class='Nordeste'  >Nordeste</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="fetched-data3">
                                                    <div class="mudar_grafico" >

                                                        <div id="chartdivu"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php } ?>
                            <?php if ($cadastrar == 1) { ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="page-title" align="center">
                                            <span class="caption-subject font-dark bold uppercase">
                                                <br>
                                                <div class="m-heading-1 border-green m-bordered">
                                                    <h3 style="margin-top: 10px;"><b>Encaminhar relatório por e-mail</b></h3>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-body form">
                                                <form id="form_sample_3" role="form" action="<?php echo RAIZ . 'home/pdf'; ?>" method="POST" enctype="multipart/form-data">
                                                    <!-- Enviando PDF para o e-mail -->
                                                    <input type="hidden" name="html_final" value="<?php echo $html_final ?>">
                                                    <!-- FIM Enviando PDF para o e-mail -->
                                                    <div class="form-body">

                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                            <div class="form-group col-md-6">
                                                                <label style="text-align:left !important;" >Unidade DPU / Secretaria DPGU</label>
                                                                <?php //echo $objSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');   ?>   
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-sitemap"></i>
                                                                    </span>
                                                                    <select name="destino_sel" id="envia_email" class="form-control" required="true">
                                                                        <option value="">Selecione</option>
                                                                        <option value="DPGU_email">DPGU - Administração Superior</option>
                                                                        <option value="DPU_email">DPU - Órgão de Atuação (Unidade)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">

                                                                <div id="destino_email">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                            <div class="form-group col-md-12">
                                                                <label>Assunto</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-comment"></i>
                                                                    </span>
                                                                    <input type="text" name="assunto" id="assunto" class="form-control" placeholder="Assunto" maxlength="255" required="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                            <div class="form-group col-md-12 col-lg-12 col-xs-12">
                                                                <label>Corpo do email</label>
                                                                <textarea name="corpo_email" id="corpo_email" class="wysihtml5 form-control" rows="15" maxlength="1000" required="true">
                                                                                                                Prezados, <u>DESTINATÁRIOS</u> bom dia/boa tarde. 
                                                                                                                <br><blockquote><u>DESCRIÇÃO</u></blockquote>
                                                                                                                Atenciosamente.
                                                                                                                <br><b>Secretária Executiva Geral - SGE</b>
                                                                                                                <br>Unidade Urgente - UND
                                                                                                                <br>Telefone: (61) 3318-4319
                                                                </textarea>

                                                                <br>

                                                                <div class="form-group">
                                                                    <label class="control-label">Incluir Anexo (opcional)</label>
                                                                    <br>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="input-group input-small">
                                                                            <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                                <span class="fileinput fileinput-exists" multiple="multiple"> Arquivos escolhidos </span>
                                                                            </div>
                                                                            <div>
                                                                                <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Escolher arquivos </span>
                                                                                    <input type="file" name="anexo[]" multiple="multiple"> </span>
                                                                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input name="tipo" type="hidden" value="geral">
                                                                <input name="auditoria" type="hidden" value="auditoria_geral">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div align="center">
                                                        <button aling="center" type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <button aling="center" type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php $caminho2 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>

    var caminho2;
    caminho2 = '<?php echo $caminho2 ?>';

    $(document).ready(function () {
        $('#envia_email').change(function () {
            $('#destino_email').load(caminho2 + '?destino=' + $('#envia_email').val());
        });
    });
</script>

<?php
$graficos = CONTROLLER . 'relatorios/grafico_rel_geral.php?regiao=';
?>
<script>
    var graficos, dt1, dt2;

    graficos = '<?php echo $graficos; ?>'
    dt_de = '<?php echo $dt_de; ?>'
    dt_ate = '<?php echo $dt_ate; ?>'

    $(document).ready(function () {
        $('.Norte').click(function () {
            var x = document.getElementsByClassName("mudar_grafico");
            x[0].innerHTML = "<iframe src='" + graficos + "Norte&dt_de=" + dt_de + "&dt_ate=" + dt_ate + " ' style='height:600px;width:1100px' frameborder='0' marginheight='0' marginwidth='0' scrolling='no' ></iframe>";
        });
        $('.Sul').click(function () {
            var x = document.getElementsByClassName("mudar_grafico");
            x[0].innerHTML = "<iframe src='" + graficos + "Sul&dt_de=" + dt_de + "&dt_ate=" + dt_ate + "' style='height:600px;width:1100px' frameborder='0' marginheight='0' marginwidth='0' scrolling='no' ></iframe>";
        });
        $('.Sudeste').click(function () {
            var x = document.getElementsByClassName("mudar_grafico");
            x[0].innerHTML = "<iframe src='" + graficos + "Sudeste&dt_de=" + dt_de + "&dt_ate=" + dt_ate + "' style='height:600px;width:1100px' frameborder='0' marginheight='0' marginwidth='0' scrolling='no' ></iframe>";
        });
        $('.Centro-Oeste').click(function () {
            var x = document.getElementsByClassName("mudar_grafico");
            x[0].innerHTML = "<iframe src='" + graficos + "Centro-Oeste&dt_de=" + dt_de + "&dt_ate=" + dt_ate + "' style='height:600px;width:1100px' frameborder='0' marginheight='0' marginwidth='0' scrolling='no' ></iframe>";
        });
        $('.Nordeste').click(function () {
            var x = document.getElementsByClassName("mudar_grafico");
            x[0].innerHTML = "<iframe src='" + graficos + "Nordeste&dt_de=" + dt_de + "&dt_ate=" + dt_ate + "' style='height:600px;width:1100px' frameborder='0' marginheight='0' marginwidth='0' scrolling='no' ></iframe>";
        });


        $('#QuantitativoDiv').css('display', 'none');
        $('#filtro_grafico').change(function () {
            $('#cpf').css('display', 'none');
            if ($('#filtro_grafico').val() == "Quantitativo") {
                $('#PorcentagemDiv').hide(0,'slow');
                $('#QuantitativoDiv').show(0,'slow');

            } else if ($('#filtro_grafico').val() == "Porcentagem") {
                $('#QuantitativoDiv').hide(0,'slow');
                $('#PorcentagemDiv').show(0,'slow');

            }

        });

    });


</script>
