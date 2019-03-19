<?php
    require_once INCLUDES . 'validaLogin.php';
    require_once 'controller/relatorios/Crel_demandas.php';
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
                                                <h3 style="margin-top: 10px;"><b>Relatório de Demandas</b></h3>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
<div id="">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="portlet light ">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 align="center"class="panel-title">Filtros</h3>
                                            </div>
                                            <form  class="rounded" method="POST" action="<?php echo RAIZ . 'relatorios/rel_demandas' ?>" enctype="multipart/form-data" onSubmit="return valida()">

                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3">

                                                            <span class="help-block" align="left">Destino:</span>
                                                            <?php //echo $objSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');  ?>   
                                                            <select name="destino_sel" id="opcao2" class=form-control required>
                                                                <option value="">Selecione</option>
                                                                <option value="DPGU">DPGU - Administração Superior</option>
                                                                <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                                                            </select>

                                                            <div id="unidades_destinos">

                                                            </div>

                                                        </div>
                                                        <div class="col-md-5 col-lg-4">
                                                            <span style="text-align: left !important;" class="help-block"> Data Despacho SGE: </span>
                                                            <div class="input-group input-large date-picker input-daterange " data-date-format="dd/mm/yyyy">
                                                                <input type="text" class="form-control"  placeholder="Data Inicial" name="dt_ini" required="" >
                                                                <span class="input-group-addon"> até </span>
                                                                <input type="text" class="form-control"  placeholder="Data Final" name="dt_fin" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-lg-2">
                                                            <span style="text-align: left !important;" class="help-block"> Por situação </span>
                                                            <select name="situacao" class="form-control input-small" >
                                                                <option value="">Selecione</option>
                                                                <option value="1">Em Aberto</option>
                                                                <option value="2">Em Andamento</option> 
                                                                <option value="3">Concluído</option>
                                                                <option value="4">Ciente</option>
                                                            </select>
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

                                        <?php if (!empty($_POST) ) { ?>

                                            <div class="portlet-title">
                                                <div class="caption font-dark">
                                                    <span class="caption-subject">
                                                        <i class="glyphicon glyphicon-th"></i> 
                                                        Por destino <span class="font-blue-sharp"><?php echo $destino_sel ?></span> 
                                                        entre <span class="font-blue-sharp"><?php echo $dt_ini ?></span> até <span class="font-blue-sharp"><?php echo $dt_fin ?></span>
                                                        na situação <span class="font-blue-sharp"><?php echo $situ_nome ?></span> 
                                                    </span>
                                                </div>
                                                <div class="tools"> </div>
                                            </div>

                                            <div class="portlet-body">

                                                <table id="sample_1_exp" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" >Número do Processo:</th>
                                                            <th class="text-center" >Assunto do<br> Encaminhamento:</th>
                                                            <th class="text-center" >Unidade <br>Origem:</th>
                                                            <th class="text-center" >Data <br>Despacho <br>SGE:</th>
                                                            <th class="text-center" >Destino:</th>
                                                            <th class="text-center" >Resumo de Andamentos:</th>
                                                            <th class="text-center" >Situação:</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        
                                                            for ($x = 0; $x < count($id_documento); $x++) {
                                                                if ($situ_final[$x] == 1) {
                                                                    $situacao = "Em Aberto";
                                                                } else if ($situ_final[$x] == 2) {
                                                                    $situacao = "Em Andamento";
                                                                } else if ($situ_final[$x] == 3) {
                                                                    $situacao = "Concluído";
                                                                } else if ($situ_final[$x] == 4) {
                                                                    $situacao = "Ciente";
                                                                };
                                                      
                                                        if (!in_array($id_documento[$x], $arDuplicadoschave) ) { 
                                                            
                                                            ?>
                                                            <tr>
                                                                <td class="text-center" ><?php echo $protocolo_formatado[$x] ?></td>
                                                                <td class="text-center" ><?php echo $assunto[$x] ?></td>
                                                                <td class="text-center" ><?php echo @$uni_origem[$x] ?></td>
                                                                <td class="text-center" ><?php echo $dt_despacho[$x] ?></td>
                                                                <td class="text-center" ><?php echo $destino_final[$x] ?></td>
                                                                <td class="text-center" style="width: 500px; display:block; text-align: left" ><?php echo $resumo[$x] ?></td>
                                                                <td class="text-center" ><?php echo $situacao ?></td>
                                                            </tr>
                                                        <?php 
                                                            }}
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php if (!empty($_POST) && $cadastrar==1) { ?>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="page-title" align="center">
                                            <span class="caption-subject font-dark bold uppercase">
                                                <br>
                                                <div class="m-heading-1 border-green m-bordered">
                                                    <h3 style="margin-top: 10px;"><b>Encaminhar relatório por e-mail </b></h3>
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
                                                    <input type="hidden" name="html_final" value="<?php echo $html_final ?>">
                                                    <div class="form-body">
                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                            <div class="form-group col-md-6">
                                                                <label style="text-align:left !important;" >Unidade DPU / Secretaria DPGU</label>
                                                                <?php //echo $objSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');  ?>   
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-sitemap"></i>
                                                                    </span>
                                                                    <select name="destino_sel" id="envia_email" class="form-control" required="">
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
                                                                    <input type="text" name="assunto" id="assunto" class="form-control" placeholder="Assunto" maxlength="255" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                            <div class="form-group col-md-12">
                                                                <label>Corpo do email</label>
                                                                <textarea name="corpo_email" id="corpo_email" class="wysihtml5 form-control" rows="15" maxlength="1000" required="">
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

                                                                <input name="tipo" type="hidden" value="demandas">
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

                        </div>
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
            $('#opcao2').change(function () {
                $('#unidades_destinos').load(caminho2 + '?destino=' + $('#opcao2').val());
            });
        });
    </script>


    
<?php $caminho5 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>

    var caminho5;
    caminho5 = '<?php echo $caminho5 ?>';

    $(document).ready(function () {
        $('#envia_email').change(function () {
            $('#destino_email').load(caminho5 + '?destino=' + $('#envia_email').val());
        });
    });
</script>
