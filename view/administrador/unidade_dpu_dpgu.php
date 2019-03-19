<?php
    require_once INCLUDES . 'validaLogin.php';
    require_once 'controller/administrador/Cunidade_dpu_dpgu.php';
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
                                                <h3 style="margin-top: 10px;"><b>Unidade DPU / Secretaria DPGU</b></h3>
                                                <h4><span class="font-blue-sharp">Cadastrar, editar e excluir</span></h4>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="portlet light ">

                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase"> Unidade DPU</span>
                                            </div>
                                            <div class="tools"> 
                                                 <?php if ($cadastrar == 1) { ?>
                                                <button type="button" class="btn btn-success" data-toggle="modal"  data-target='#add_dpu'>
                                                    Cadastrar nova Unidade DPU
                                                </button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table id="sample_5" class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;" class="text-center">Ação</th>
                                                        <th class="text-center">Região</th>
                                                        <th class="text-center">UF</th>
                                                        <th class="text-center">Unidade</th>
                                                        <th class="text-center">Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($dpu_r = mssql_fetch_array($dpu)) { ?>
                                                        <tr>
                                                            <td>
                                                                <div class="btn-toolbar">
                                                                    <div class="btn-group" >
                                                                          <?php if ($alterar == 1) { ?>
                                                                        <button type="button" class="btn blue-madison btn-xs mod popovers" data-toggle="modal" data-doc="<?php echo $dpu_r['id_unidade']; ?>" data-target='#visualizaranexo_dpu_editar' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                                            <i class="glyphicon glyphicon-edit"></i>
                                                                        </button>
                                                                          <?php }?>
                                                                    </div>
                                                                    <div style="float: right !important;" class="">
                                                                        <?php 
                                                                            if($excluir==1){
                                                                                if( $dpu_r["str_situacao"] == 'D' ){ //Desativado
                                                                                    $classIcon = 'fa fa-remove'; 
                                                                                    $msgAcao = 'Ativar unidade?';
                                                                                    $corBtn = 'btn btn-danger';
                                                                                 } else{ // Ativado
                                                                                     $classIcon = 'fa fa-check-square'; 
                                                                                     $msgAcao = 'Desativar unidade?';
                                                                                     $corBtn = 'btn btn-success';
                                                                                 }
                                                                        ?>
                                                                        <form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
                                                                            <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                                                <input type='hidden' name='delete_unidade_dpu' value='4000000' />
                                                                                <input type='hidden' name='status' value='<?php echo $dpu_r["str_situacao"]; ?>' />
                                                                                <input type='hidden' name='id_unidade' value="<?php echo $dpu_r['id_unidade']; ?>" />
                                                                                <i class="<?php echo $classIcon; ?>"></i>
                                                                            </button>
                                                                        </form>
                                                                         <?php }?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $dpu_r['str_regiao']; ?></td>
                                                            <td><?php echo $dpu_r['str_uf']; ?></td>
                                                            <td><?php echo utf8_encode($dpu_r['str_descricao']); ?></td>
                                                            <td><?php echo utf8_encode($dpu_r['str_email']); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                           
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="portlet light ">

                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase"> Secretaria DPGU</span>
                                            </div>
                                            <div class="tools"> 
                                                     <?php if ($cadastrar == 1) { ?>
                                                <button type="button" class="btn btn-success" data-toggle="modal"  data-target='#add_dpgu'>
                                                    Cadastrar nova Secretaria DPGU
                                                </button>
                                                     <?php }?>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table id="sample_4" class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;" class="text-center">Ação</th>
                                                        <th class="text-center">Sigla</th>
                                                        <th class="text-center">Nome do setor</th>
                                                        <th class="text-center">Email</th>
                                                    </tr> 
                                                </thead>
                                                <tbody>

                                                    <?php while ($dpgu_r = mssql_fetch_array($dpgu)) { ?>
                                                        <tr>
                                                            <td>
                                                                
                                                                <div class="btn-toolbar">
                                                                    <div class="btn-group" >
                                                                             <?php if ($alterar == 1) { ?>
                                                                        <button type="button" class="btn blue-madison btn-xs mod popovers" data-toggle="modal" data-doc="<?php echo $dpgu_r['id_secretaria']; ?>" data-target='#visualizaranexo_dpgu_editar' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                                            <i class="glyphicon glyphicon-edit"></i>
                                                                             </button> <?php }?>
                                                                    </div>
                                                                    <div style="float: right !important;" class="">
                                                                            <?php 
                                                                                if ($excluir == 1) { 
                                                                                    if( $dpgu_r["str_situacao"] == 'D' ){ //Desativado
                                                                                       $classIcon = 'fa fa-remove'; 
                                                                                       $msgAcao = 'Ativar secretaria?';
                                                                                       $corBtn = 'btn btn-danger';
                                                                                    } else{ // Ativado
                                                                                        $classIcon = 'fa fa-check-square'; 
                                                                                        $msgAcao = 'Desativar secretaria?';
                                                                                        $corBtn = 'btn btn-success';
                                                                                    }
                                                                            ?>
                                                                        <form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
                                                                            <button type="submit" class="<?php echo $corBtn; ?> btn-xs" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                                                <input type='hidden' name='delete_setor_dpgu' value='3000000' />
                                                                                <input type='hidden' name='status' value='<?php echo $dpgu_r["str_situacao"]; ?>' />
                                                                                <input type='hidden' name='id_secretaria' value="<?php echo $dpgu_r['id_secretaria']; ?>" />
                                                                                <i class="<?php echo $classIcon; ?>"></i>
                                                                            </button>
                                                                             <?php }?>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                
                                                            </td>
                                                            <!-- (nome das colunas no banco) -->
                                                            <td><?php echo utf8_encode($dpgu_r['str_sigla']); ?></td>
                                                            <td><?php echo utf8_encode($dpgu_r['str_descricao']); ?></td>
                                                            <td><?php echo utf8_encode($dpgu_r['str_email']); ?></td>
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

<!-- MODAL ADD DPU -->
<div class="modal fade bs-modal-lg " id="add_dpu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <form action="<?php echo CONTROLLER.'administrador/Coperacoes.php';?>" method="POST">
            
                <div class="modal-header">
                    <div class="page-title" align="center">
                        <span class="caption-subject font-dark bold uppercase">
                            <div class="m-heading-1 border-blue m-bordered">
                                <h4><b>Cadastrar Unidade DPU</b>
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
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Região:</label>
                                                <select id="opcao_regiao" class="form-control" name ="opcao_regiao" required="">
                                                    <option value="">Selecione</option>
                                                    <option value="1">Centro-Oeste</option>
                                                    <option value="2">Nordeste</option>
                                                    <option value="3">Norte</option>
                                                    <option value="4">Sudeste</option>
                                                    <option value="5">Sul</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div id="estado_uf">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Nome da unidade:</label>
                                                <input type="text" name="descricao" class="form-control" maxlength="255" placeholder="Nome da unidade" required=""> 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Email da unidade:</label>
                                                <input type="email" name="email" class="form-control" maxlength="255" placeholder="Email" required=""> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    
                    <input type="hidden" name="insert_unidade_dpu" value="200000000"/>
                    
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                    
            </form>
            
        </div>
    </div>
</div>
<!-- FIM MODAL ADD DPU --> 

<!-- MODAL ADD DPGU -->
<div class="modal fade bs-modal-lg " id="add_dpgu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <form action="<?php echo CONTROLLER.'administrador/Coperacoes.php';?>" method="post">
            
                <div class="modal-header">
                    <div class="page-title" align="center">
                        <span class="caption-subject font-dark bold uppercase">
                            <div class="m-heading-1 border-blue m-bordered">
                                <h4><b>Cadastrar Secretaria DPGU</b>
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
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Sigla:</label>
                                                <input type="text" name="sigla" class="form-control" maxlength="50" placeholder="Sigla" required=""> 
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Novo setor é subordinado a quem?</label>
                                                <?php echo $objSmap->consultacombo_DPGU('id_secretaria');  ?> 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Nome do setor:</label>
                                                <input type="text" name="descricao" class="form-control" maxlength="255" placeholder="Nome do setor" required=""> 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Email do setor:</label>
                                                <input type="email" name="email" class="form-control" maxlength="255" placeholder="Email" required=""> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    
                    <input type="hidden" name="insert_setor_dpgu" value="500000" />
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                    
            </form>
            
        </div>
    </div>
</div>
<!-- FIM MODAL ADD DPGU --> 

<!-- MODAL Editar DPU -->
<div class="modal fade bs-modal-lg " id="visualizaranexo_dpu_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar registro da Unidade DPU</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="fetched-data_dpu">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL Editar DPU--> 

<!-- MODAL Editar DPGU -->
<div class="modal fade bs-modal-lg " id="visualizaranexo_dpgu_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar registro da Área DPGU</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="fetched-data_dpgu">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL Editar DPGU -->




<!-- Ajax para editar Unidade DPU e Área DPGU -->
<?php $caminho2 = CONTROLLER . 'administrador/Cform_edit.php'; ?>
<script>
    var caminho2;
    caminho2 = '<?php echo $caminho2 ?>';

    $(document).ready(function () {
        $('#visualizaranexo_dpgu_editar').on('show.bs.modal', function (e) {
            var id_secretaria = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho2,
                data: 'id_secretaria=' + id_secretaria,
                success: function (data) {
                    $('.fetched-data_dpgu').html(data);
                }
            });
        });
        
        $('#visualizaranexo_dpu_editar').on('show.bs.modal', function (e) {
            var id_unidade = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho2,
                data: 'id_unidade=' + id_unidade,
                success: function (data) {
                    $('.fetched-data_dpu').html(data);
                }
            });
        });
        
    });
</script>


<!-- 
    Envia o 'id_unidade' OU 'id_secretaria' para o Cunidade_dpu_dpgu
-->
<?php $caminho = CONTROLLER . 'administrador/Cunidade_dpu_dpgu.php'; ?>

<script>
    var caminho;
    caminho = '<?php echo $caminho ?>';

    $(document).ready(function () {
        $('#visualizaranexo_dpu').on('show.bs.modal', function (e) {
            var id_unidade = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho,
                data: 'id_unidade=' + id_unidade,
                success: function (data) {
                    $('.fetched-data_dpu').html(data);
                }
            });
        });
        $('#visualizaranexo_dpgu').on('show.bs.modal', function (e) {
            var id_secretaria = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho,
                data: 'id_secretaria=' + id_secretaria,
                success: function (data) {
                    $('.fetched-data_dpgu').html(data);
                }
            });
        });
    });
</script>



    
<?php $caminho1 = CONTROLLER . 'administrador/Cregiao_uf.php'; ?>
<script>

    var caminho1;
    caminho1 = '<?php echo $caminho1 ?>';

    $(document).ready(function () {
        $('#opcao_regiao').change(function () {
            $('#estado_uf').load(caminho1 + '?regiao=' + $('#opcao_regiao').val());
        });
    });
    
</script>

    
