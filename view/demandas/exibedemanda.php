<?php
    require_once INCLUDES . 'validaLogin.php';
    require_once 'controller/demandas/Cexibedemanda.php';
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
                                    <div style="text-align: left !important;">
                                        <a href="<?php echo RAIZ . "demandas/selecao"; ?>"><button type="button" class="btn btn-primary " ><i class="fa fa-arrow-left"></i> Voltar página anterior</button></a>
                                    </div>
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br>
                                            <div class="m-heading-1 border-green m-bordered">
                                                
                                                <?php
                                                    if (!empty($_SESSION['MSGDU'])) {
                                                        $msg = $_SESSION['Mensagem'];
                                                ?>
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-lg-offset-3 col-xl-offset-3 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="alert alert-block alert-msn-texto fade in alert-msn-borda">
                                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                                <h4 class="alert-heading bold">Sucesso!</h4>
                                                                <p style="text-transform: capitalize!important;"><?php echo $msg ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    }
                                                    unset($_SESSION['MSGDU']);
                                                    unset($_SESSION['Mensagem']);
                                                ?>
                                                
                                                <h3 style="margin-top: 10px;"><b>Exibição da demanda</b></h3>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-xs-12 col-sm-12">
                                    <div class="portlet light ">
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" >Processo:</th>
                                                    <th class="text-center" >Tipo do Processo:</th>
                                                    <th class="text-center" >Criado em:</th>
                                                    <th class="text-center" >Assunto:</th>
                                                    <th class="text-center" >Despachado pela SGE em:</th>
                                                    <th class="text-center" >Destino:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td align="center"><?php echo $protocolo_formatado; ?></td>
                                                    <td align="center"><?php echo $tipo_processo; ?></td>
                                                    <td align="center"><?php echo $dta_assinatura; ?></td>
                                                    <td align="center"><b><?php echo $objSmap->trataDemandas($conteudo); ?></b></td>
                                                    <td align="center"><?php echo $dta_despacho; ?></td>
                                                    <td align="center"><?php echo $sigla_unidade; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>

                                        <hr>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" >Número deste documento no SEI: (<?php echo $numero_sei;?>)</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <?php echo $conteudo; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="portlet-body">
                                            <div class="tabbable-custom sub-menu-customizado" >
                                                <ul class="nav nav-tabs" >
                                                    <li class="li-customizado active">
                                                        <a class="texto-customizado" href="#aco_est_dem" data-toggle="tab"><i class="fa fa-share"></i> Acompanhar esta demanda </a>
                                                    </li>
                                                    <li class="li-customizado">
                                                        <a class="texto-customizado" href="#tab_his_pro" data-toggle="tab"><i class="fa fa-history"></i> Histórico do Processo </a>
                                                    </li>
                                                    <li class="li-customizado">
                                                        <a class="texto-customizado" href="#tab_doc_pro" data-toggle="tab"><i class="fa fa-file-pdf-o"></i> Documentos do Processo </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="aco_est_dem">
 <?php if ($cadastrar == 1) { ?>
                                                        <div class="page-title" align="center">
                                                            <span class="caption-subject font-dark bold uppercase">
                                                                <br>
                                                                <div class="m-heading-1 border-green m-bordered">
                                                                    <h3 style="margin-top: 10px;"><b>Incluir acompanhamento</b></h3>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo CONTROLLER . 'demandas/Coperacoes.php'; ?>" method="post">
                                                                
                                                                
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h3 class="panel-title" >Status</h3>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                                            <div class="col-xs-12 col-sm-12 col-md-3">
                                                                                <span class="help-block"> Situação atual: </span>
                                                                                <div class="mt-radio-list">
                                                                                      <label class="mt-radio" style="text-align:left !important;"> Aberto
                                                                                        <input type="radio" value="1" name="situacao" />
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label class="mt-radio" style="text-align:left !important;"> Em andamento
                                                                                        <input type="radio" value="2" name="situacao" />
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label class="mt-radio mt-radio" style="text-align:left !important;"> Concluído
                                                                                        <input type="radio" value="3" name="situacao"/>
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label class="mt-radio" style="text-align:left !important;"> Ciente
                                                                                        <input type="radio" value="4" name="situacao" />
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-9">
                                                                                <span class="help-block"> Resumo do andamento: </span>
                                                                                <div class="row">
                                                                                    <textarea rows="11" class="form-control" name="resumo" maxlength="1000" required=""></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                                                <span class="help-block" align="left">Unidade DPU / Secretaria DPGU:</span>
                                                                                <?php //echo $objSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');  ?>   
                                                                                <select  id="opcao1" class=form-control required>
                                                                                    <option value="">Selecione</option>
                                                                                    <option value="DPGU">DPGU - Administração Superior</option>
                                                                                    <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>

                                                                                </select>

                                                                                <div id="unidades_origem"  required style="display:none">                                     
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                                                <span class="help-block" align="left">Destino da demanda:</span>  
                                                                                <select  id="opcao2" class=form-control required>
                                                                                    <option value="">Selecione</option>
                                                                                    <option value="DPGU">DPGU - Administração Superior</option>
                                                                                    <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                                                                                </select>

                                                                                <div id="unidades_destinos" required style="display:none">
                                                                                </div>

                                                                            </div>

                                                                         

                                                                        </div>
                                                                           <div class="col-xs-12 col-sm-12 col-md-4">
                                                                                <span class="help-block" align="left">Prazo de resposta:</span>
                                                                                <input class="form-control form-control-inline input-medium date-picker" name="dt_prazo" id="datepicker2" placeholder="Prazo de resposta"  data-date-format="dd/mm/yyyy">
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                                                <span class="help-block" align="left">Data Vencimento:</span>
                                                                                <input class="form-control form-control-inline input-medium date-picker" name="dt_vencimento" id="datepicker2" placeholder="Data de Vencimento"  data-date-format="dd/mm/yyyy">
                                                                            </div>
                                                                        <br>
                                                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                                            <div class="col-xs-12 col-sm-12 col-md-12" align="right">
                                                                                <br>
                                                                                <input type='hidden' name='id_documento' value='<?php echo $id_documento; ?>' />
                                                                                <input type='hidden' name='id_protocolo' value='<?php echo $id_protocolo; ?>' />
                                                                                <input type='hidden' name='protocolo_formatado' value='<?php echo $protocolo_formatado; ?>' />
                                                                                
                                                                                <input type='hidden' name='tipo_processo' value='<?php echo $tipo_processo; ?>' />
                                                                                <input type='hidden' name='conteudo' value='<?php echo $conteudo; ?>' />
                                                                                <input type='hidden' name='dta_despacho' value='<?php echo $dta_despacho; ?>' />
                                                                                <input type='hidden' name='dta_assinatura' value='<?php echo $dta_assinatura; ?>' />
                                                                                <input type='hidden' name='usr_criador' value='<?php echo $_SESSION['usuario']['login']; ?>' />
                                                                            
                                                                                <input type='hidden' name='sigla_unidade' value='<?php echo $sigla_unidade; ?>' />
                                                                                <input type='hidden' name='descricao' value='<?php echo $descricao; ?>' />
                                                                                <input type='hidden' name='numero_sei' value='<?php echo $numero_sei; ?>' />
                                                                              

                                                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-primary">Incluir</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                    <div class="tab-pane" id="tab_his_pro">

                                                        <div class="page-title" align="center">
                                                            <span class="caption-subject font-dark bold uppercase">
                                                                <br>
                                                                <div class="m-heading-1 border-green m-bordered">
                                                                    <h3 style="margin-top: 10px;"><b>Histórico do Processo</b></h3>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <table id="sample_7" class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Data/Hora:</th>
                                                                        <th>Unidade:</th>
                                                                        <th>Usuário:</th>
                                                                        <th>Descrição:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($arDados = mssql_fetch_array($result2)) { ?>
                                                                        <tr>
                                                                            <td><?php echo date('d/m/Y H:i:s', strtotime($arDados['abertura'])); ?></td>
                                                                            <td><?php echo utf8_encode($arDados['siglaunidadeorigem']); ?></td>
                                                                            <td><?php echo $arDados['siglausuarioorigem']; ?></td>
                                                                            <td><?php echo $objSei->trataAtividade(utf8_encode($arDados['nometarefa'])); ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="tab_doc_pro">

                                                        <div class="page-title" align="center">
                                                            <span class="caption-subject font-dark bold uppercase">
                                                                <br>
                                                                <div class="m-heading-1 border-green m-bordered">
                                                                    <h3 style="margin-top: 10px;"><b>Documentos do Processo</b></h3>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <table id="sample_4" class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Nome:</th>
                                                                        <th class="text-center">Data Abertura:</th>
                                                                        <th class="text-center">Documento:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php while ($arDados3 = mssql_fetch_array($resulthistoridocumento)) { ?>
                                                                        <tr>             
                                                                            <td style="width: 40%" class="text-center"><?php echo utf8_encode($arDados3['nome']) . ' ' . utf8_encode($arDados3['numero']) . '(' . $arDados3['valor'] . ')'; ?></td>              
                                                                            <td style="width: 30%" class="text-center"><?php echo $arDados3['data_abertura']; ?></td>
                                                                            <td style="width: 30%" class="text-center"> <a href="<?php echo RAIZ . 'demandas/conteudo/' . $arDados3['id_documento']; ?>" target="_blank"><button type="button" class="btn btn-primary " >Abrir Documento</button></a>  </td>
                                                                      
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $caminho = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>

    var caminho;
    caminho = '<?php echo $caminho ?>';

    $(document).ready(function () {

        $('#opcao1').change(function () {
            $('#unidades_origem').load(caminho + '?origem=' + $('#opcao1').val());
        });
        $('#opcao2').change(function () {
            $('#unidades_destinos').load(caminho + '?destino=' + $('#opcao2').val());
        });
    });

    function id(el) {
        return document.getElementById(el);
    }
    window.onload = function () {
        id('opcao1').onchange = function () {
            if (this.value == 'DPU' || this.value == 'DPGU')
                id('unidades_origem').style.display = 'block';

            else
                id('unidades_origem').style.display = 'none';
        }

        id('opcao2').onchange = function () {
            if (this.value == 'DPU' || this.value == 'DPGU')
                id('unidades_destinos').style.display = 'block';

            else
                id('unidades_destinos').style.display = 'none';
        }
    }

</script>
