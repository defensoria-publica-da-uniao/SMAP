<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/administrador/Cgerencia_alertas.php';
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
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>

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
                                                <h3 style="margin-top: 10px;"><b>Gerenciamento de Alertas</b></h3>
                                                <h4>Controle do alertas</h4>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase"> Alertar Registrados</span>
                                            </div>
                                            <div class="tools"> 
                                                <?php if ($cadastrar == 1) { ?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" href="#cadastrar">
                                                        Cadastrar novo tipo de alerta
                                                    </button> <?php } ?>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table id="sample_1" class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;" class="text-center">Ação</th>
                                                        <th class="text-center">Tipo do Alerta</th>
                                                        <th class="text-center">Icone</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($alertas_r = mssql_fetch_array($alertas)) { ?>
                                                        <tr>
                                                            <td style="text-align: center !important;" class="text-center">



                                                                <div class="btn-toolbar">
                                                                    <div class="btn-group" >
                                                                        <?php if ($alterar == 1) { ?>
                                                                            <button type="button" class="btn blue-madison btn-xs mod popovers" data-toggle="modal" data-doc="<?php echo $alertas_r['id_alertas']; ?>" data-target='#visualizaranexo_alerta_editar' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                                                <i class="glyphicon glyphicon-edit"></i>
                                                                            </button>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div style="float: right !important;" class="">
                                                                        <?php if ($excluir == 1) { ?>
                                                                            <form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
                                                                                <button  class="btn red-sunglo btn-xs mod" data-toggle="confirmation" data-original-title="Excluir Registro?" >
                                                                                    <input type='hidden' name='delete_alertas' value='9000000' />
                                                                                    <input type='hidden' name='id_alertas' value="<?php echo $alertas_r['id_alertas']; ?>" />
                                                                                    <i class="glyphicon "></i>
                                                                                </button>
                                                                            </form>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td><?php echo utf8_encode($alertas_r ['str_nome_tipo']); ?></td>
                                                            <td align="center">
                                                                <div class="label label-md nao-parado-geral">
                                                                    <i class="<?php echo $alertas_r['str_nome_icone']; ?>"></i>
                                                                </div>
                                                            </td>
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

<!-- MODAL | id=cadastrar -->
<div class="modal fade bs-modal-lg" id="cadastrar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">

                <div class="modal-header">
                    <div class="page-title" align="center">
                        <span class="caption-subject font-dark bold uppercase">
                            <div class="m-heading-1 border-blue m-bordered">
                                <h4 ><b>Cadastrar novo tipo de alerta</b>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>      

                                </h4>
                            </div>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" >Dados gerais</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <div class="col-md-12">

                                    <div class="form-body">
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha o Tipo do Processo que vai gerar o Alerta:</label>
                                                <input class="form-control spinner" maxlength="255" name="nome" type="text" placeholder="Tipo do Processo" required="" > 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha o icone:</label>
                                                <br>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone1" value="fa fa-gavel" required=""> <i class="fa fa-gavel"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone2" value="fa fa-exclamation-circle" > <i class="fa fa-exclamation-circle"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone3" value="fa fa-contao" > <i class="fa fa-contao"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone4" value="fa fa-industry" > <i class="fa fa-industry"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone5" value="fa fa-diamond" > <i class="fa fa-diamond"></i>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone6" value="fa fa-graduation-cap" > <i class="fa fa-graduation-cap"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone7" value="fa fa-calendar-plus-o" > <i class="fa fa-calendar-plus-o"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone8" value="fa fa-heart" > <i class="fa fa-heart"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone9" value="fa fa-commenting" > <i class="fa fa-commenting"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone10" value="fa fa-fire-extinguisher" > <i class="fa fa-fire-extinguisher"></i>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone11" value="fa fa-get-pocket" > <i class="fa fa-get-pocket"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone12" value="fa fa-gg" > <i class="fa fa-gg"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone13" value="fa fa-home" > <i class="fa fa-home"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone14" value="fa fa-picture-o" > <i class="fa fa-picture-o"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone15" value="fa fa-hourglass" > <i class="fa fa-hourglass"></i>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone16" value="fa fa-cutlery" > <i class="fa fa-cutlery"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone17" value="fa fa-mouse-pointer" > <i class="fa fa-mouse-pointer"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone18" value="fa fa-dollar" > <i class="fa fa-dollar"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone19" value="fa fa-map" > <i class="fa fa-map"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone20" value="fa fa-map-pin" > <i class="fa fa-map-pin"></i>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone21" value="fa fa-phone-square" > <i class="fa fa-phone-square"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone22" value="fa fa-plane" > <i class="fa fa-plane"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone23" value="fa fa-plug" > <i class="fa fa-plug"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone24" value="fa fa-share-alt" > <i class="fa fa-share-alt"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone25" value="fa fa-university" > <i class="fa fa-university"></i>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone26" value="fa fa-unlock" > <i class="fa fa-unlock"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone27" value="fa fa-trophy" > <i class="fa fa-trophy"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone28" value="fa fa-tree" > <i class="fa fa-tree"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone29" value="fa fa-thumbs-up" > <i class="fa fa-thumbs-up"></i>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="icone" id="icone30" value="fa fa-refresh" > <i class="fa fa-refresh"></i>
                                                            <span></span>
                                                        </label>
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

                <div class="modal-footer">

                    <input type="hidden" name="insert_alertas" value="500000000"/>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- FIM MODAL | id=cadastrar -->

<!-- MODAL Editar Tipo de Alerta -->
<div class="modal fade bs-modal-lg " id="visualizaranexo_alerta_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar Tipo do Alerta</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="fetched-data_alertas">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL Editar Tipo de Alerta -->

<!-- Ajax para editar Unidade DPU e Área DPGU -->
<?php $caminho2 = CONTROLLER . 'administrador/Cform_edit.php'; ?>
<script>
    var caminho2;
    caminho2 = '<?php echo $caminho2 ?>';

    $(document).ready(function () {
        $('#visualizaranexo_alerta_editar').on('show.bs.modal', function (e) {
            var id_alertas = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho2,
                data: 'id_alertas=' + id_alertas,
                success: function (data) {
                    $('.fetched-data_alertas').html(data);
                }
            });
        });

    });
</script>