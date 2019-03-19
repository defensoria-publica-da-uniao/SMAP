<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/demandas/Cexibedemanda.php';
//$_SESSION['conteudodoido']=$conteudo;
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

                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Exibição da demanda</b></h3>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-xs-12 col-sm-12">
                                    <div class="portlet light ">

                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" >Processo:</th>
                                                            <th class="text-center" >Tipo do Processo:</th>
                                                            <th class="text-center" >Origem:</th>
                                                            <th class="text-center" >Último Destino:</th>
                                                            <th class="text-center" >Assunto:</th>
                                                            <th class="text-center" >Despachado pela SGE em:</th>
                                                             <th class="text-center" >Prazo de resposta(Alertas Específicos/Outros):</th>
                                                            <th class="text-center" >Data Vencimento Sem Resposta:</th>                                                         
                                                             <th class="text-center" >Destino Sei:</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td align="center"><?php echo $protocolo_formatado; ?></td>
                                                            <td align="center"><?php echo utf8_encode($tipo_processo); ?></td>
                                                            <td align="center"><?php echo $origem; ?></td>
                                                            <td align="center"><?php echo $destino; ?></td>
                                                            <td align="center"><b><?php echo $objSmap->trataDemandas($conteudo); ?></b></td>
                                                            <td align="center"><?php echo date('d/m/Y', strtotime($dta_despacho)); ?></td>
                                                             <td align="center"><?php echo $dta_prazo; ?></td>
                                                            <td align="center"><?php echo $dta_vencimento; ?></td>
                                                           
                                                            <td align="center"><?php echo utf8_encode($destino_sei);?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" >Número deste documento no SEI: (<?php echo $numero_sei; ?>)</h3>
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
                                                                        <h3 style="margin-top: 10px;"><b>Incluir Acompanhamento</b></h3>
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
                                                                                            <input type="radio" value="1" name="situacao" <?php echo @$situ1; ?> />
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-radio" style="text-align:left !important;"> Em andamento
                                                                                            <input type="radio" value="2" name="situacao" <?php echo @$situ2; ?> />
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-radio" style="text-align:left !important;"> Concluído
                                                                                            <input type="radio" value="3" name="situacao" <?php echo @$situ3; ?> />
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-radio" style="text-align:left !important;"> Ciente
                                                                                            <input type="radio" value="4" name="situacao" <?php echo @$situ4; ?> />
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
                                                                                    <?php //echo $objSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');   ?>   
                                                                                    <select  id="opcao1" class=form-control>
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
                                                                                <span class="help-block" align="left">Prazo de resposta(Alertas Específicos/Outros):</span>
                                                                                <input class="form-control form-control-inline input-medium date-picker" name="dt_prazo" id="datepicker2" placeholder="Prazo de resposta"  data-date-format="dd/mm/yyyy">
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                                                <span class="help-block" align="left">Data Vencimento Sem Resposta:</span>
                                                                                <input class="form-control form-control-inline input-medium date-picker" name="dt_vencimento" id="datepicker2" placeholder="Data de Vencimento"  data-date-format="dd/mm/yyyy">
                                                                            </div>
                                                                            <br>
                                                                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                                                <div class="col-xs-12 col-sm-12 col-md-12" align="right">
                                                                                    <br>
                                                                                    <input type='hidden' name='update' value='1' />
                                                                                    <input type='hidden' name='id_unidade' value='<?php echo $id_unidade; ?>' />
                                                                                    <input type='hidden' name='id_acompanhamento' value='<?php echo $id_acompanhamento; ?>' />
                                                                                    <input type='hidden' name='usr_criador' value='<?php echo $_SESSION['usuario']['login']; ?>' />
                                                                                    <input type='hidden' name='id_protocolo' value='<?php echo $id_protocolo; ?>' />
                                                                                    <input type='hidden' name='protocolo_formatado' value='<?php echo $protocolo_formatado; ?>' />
                                                                                    <input type='hidden' name='id_documento' value='<?php echo $id_documento_sei; ?>' />
                                                                                    <input type='hidden' name='destino_sei' value='<?php echo $destino_sei; ?>' />

                                                                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                    <button type="submit" class="btn btn-primary">Incluir</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        <?php } ?>
                                                        <br>
                                                        <hr>

                                                        <div class="page-title" align="center">
                                                            <span class="caption-subject font-dark bold uppercase">
                                                                <br>
                                                                <div class="m-heading-1 border-green m-bordered">
                                                                    <h3 style="margin-top: 10px;"><b>Histórico de Acompanhamento</b></h3>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        
                                                          

                                                        <div class="portlet-body">
                                                            <table id="sample_6" class="table table-striped table-bordered table-hover" >
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 10% !important;" class="text-center">Ação</th>
                                                                        <th>Acompanhado em:</th>
                                                                        <th>Por:</th>
                                                                        <th>Resumo:</th>
                                                                        <th>Situação:</th>
                                                                        <th>Destino:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($arDados = mssql_fetch_array($result2)) {?>
                                                                        <tr>
                                                                            <td>

                                                                                <div class="btn-toolbar">
                                                                                    <div class="btn-group" >
                                                                                        <?php if ($situacao <> 3 && $alterar == 1) {
                                                                                            ?>
                                                                                            <button type="button" class="btn blue-madison btn-xs mod popovers" data-toggle="modal" data-doc="<?php echo $arDados['id_historico_acompanhamento']; ?>" data-target='#visualizaranexo' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                                                                <i class="glyphicon glyphicon-edit"></i>
                                                                                            </button> 
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <div style="float: right !important;" class="">
                                                                                        <form action="<?php echo CONTROLLER . 'demandas/Coperacoes.php'; ?>" method="POST">
                                                                                            <input type='hidden' name='delete' value='1' />
                                                                                            <input type='hidden' name='int_estatus' value="<?php echo $arDados['int_estatus']; ?>" />
                                                                                            <input type='hidden' name='id_historico_acompanhamento' value="<?php echo $arDados['id_historico_acompanhamento']; ?>" />
                                                                                            <input type='hidden' name='id_acompanhamento' value='<?php echo $id_acompanhamento; ?>' />
                                                                                            <input type='hidden' name='id_protocolo' value='<?php echo $id_protocolo; ?>' />
                                                                                            <input type='hidden' name='id_documento_sei' value='<?php echo $id_documento_sei; ?>' />
                                                                                            <input type='hidden' name='destino_sei' value='<?php echo $destino_sei; ?>' />
                                                                                            <?php if ($total <> 1 && $situacao == 2 && $excluir == 1) { ?> 
                                                                                                <button type="submit" class="btn red-sunglo btn-xs mod" data-toggle="confirmation" data-original-title="Excluir Registro?">
                                                                                                    <i class="fa fa-close"></i>
                                                                                                </button> 
                                                                                            <?php } ?>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>

                                                                            </td>
                                                                            <td><?php echo date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])); ?></td>
                                                                            <td><?php echo $usr = utf8_encode($arDados['str_usr_criador']); ?></td>
                                                                            <td>
                                                                                <?php 
                                                                                    // Inserindo <br> separando os acompanhamentos 
                                                                                    $resumo = utf8_encode($arDados['str_resumo']); 
                                                                                    echo $resumo = str_replace('[','<br /><br />[',$resumo); 
                                                                                ?>
                                                                            </td>
                                                                            <td><?php
                                                                                if ($arDados['int_situ'] == 2) {
                                                                                    echo'Em andamento';
                                                                                } else if ($arDados['int_situ'] == 3) {
                                                                                    echo'Concluído';
                                                                                } else if ($arDados['int_situ'] == 1) {
                                                                                    echo 'Aberto';
                                                                                } else {
                                                                                    echo 'Ciente';
                                                                                }
                                                                                ?></td> 
                                                                            <td><?php
                                                                                if (!empty($arDados['secretaria_descricao'])) {
                                                                                    echo $arDados['secretaria_sigla'] . ' - ' . utf8_encode($arDados['secretaria_descricao']);
                                                                                } else {

                                                                                    echo $arDados['str_uf'] . ' - ' . utf8_encode($arDados['unidade_descricao']);
                                                                                }
                                                                                ?></td>

                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
 <div class="row">
                                                                <div class="col-md-12">
                                                                    <p align="right">
                                                                        <?php echo 'Criado em ' . $data_criacao . ' por <b>' . utf8_encode($criador) . '</b>' ?>
                                                                        <br>
                                                                        <?php echo 'Última modificação à(s) ' . $dt_ultima_modificao . ' por <b>' . utf8_encode($ultimo_criador) . '</b>'?>
                                                                    </p>
                                                                </div>
                                                            </div>
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



                                                            <table id="sample_7" class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Data/Hora:</th>
                                                                        <th>Unidade:</th>
                                                                        <th>Usuário:</th>
                                                                        <th>Descrição:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($arDados2 = mssql_fetch_array($resulthistorisei)) { 
                                                                        ?>
                                                                        <tr>             
                                                                            <td><?php echo date('d/m/Y H:i:s', strtotime($arDados2['abertura'])); ?></td>
                                                                            <td><?php echo $arDados2['siglaunidadeorigem']; ?></td>
                                                                            <td><?php echo $arDados2['siglausuarioorigem']; ?></td>
                                                                            <td><?php echo $objSei->trataAtividade(utf8_encode($arDados2['nometarefa'])); ?></td>
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


<!-- MODAL Editar -->
<div class="modal fade bs-modal-lg " id="visualizaranexo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar acompanhamento</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="fetched-data">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL Editar -->

<!-- Ajax para editar historico de acompanhamento -->
<?php $caminho = CONTROLLER . 'demandas/Cform_edit.php'; ?>
<script>
    var caminho;
    caminho = '<?php echo $caminho ?>';

    $(document).ready(function () {
        $('#visualizaranexo').on('show.bs.modal', function (e) {
            var id_acompanhamento_fixo = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho,
                data: 'id_acompanhamento_fixo=' + id_acompanhamento_fixo,
                success: function (data) {
                    $('.fetched-data').html(data);
                }
            });
        });
    });
</script>


<!-- Ajax para select de unidades ou secretarias -->
<?php $caminho2 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>

    var caminho2 = '<?php echo $caminho2 ?>';

    $(document).ready(function () {

        $('#opcao1').change(function () {
            $('#unidades_origem').load(caminho2 + '?origem=' + $('#opcao1').val());
        });
        $('#opcao2').change(function () {
            $('#unidades_destinos').load(caminho2 + '?destino=' + $('#opcao2').val());
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
