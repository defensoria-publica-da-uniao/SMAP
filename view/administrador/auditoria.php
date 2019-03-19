<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/administrador/Cauditoria.php';
?>
<style>
    #carregar
    {
        display: none;  
    }
</style>


<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <div id="carregando" align="center"> <img src="<?php echo IMG . 'carregando.gif'; ?>" alt="some text" width=35% height=35%> </div> 
                        <div id='carregar'>
                            <div class="page-content-inner">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="page-title" align="center">
                                            <span class="caption-subject font-dark bold uppercase">
                                                <br/>
                                                <div class="m-heading-1 border-green m-bordered">
                                                    <h3 style="margin-top: 10px;"><b>Auditoria</b></h3>

                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>





                                <div class="portlet light portlet-fit portlet-datatable ">                   
                                    <div class="portlet-body">
                                        <div class="portlet-body">
                                            <div class="tabbable-line">
                                                <ul class="nav nav-tabs nav-tabs-lg">
                                                    <li class="active">
                                                        <a href="#tab_1" data-toggle="tab"> Exclusões </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_2" data-toggle="tab"> Geral
                                                          
                                                        </a>
                                                    </li>
                                                   
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1">


                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <div>
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i></i></div>
                                                                        <div class="actions">

                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="table-responsive">
                                                                            <table id="sample_4_exp" class="table table-striped table-bordered table-hover" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">Data e Hora</th>
                                                                                        <th class="text-center">Usuário</th>
                                                                                        <th class="text-center">Número do Processo</th>
                                                                                        <th class="text-center">Número do Documento Sei</th>
                                                                                        <th class="text-center">Ação Realizada</th>
                                                                                        <th class="text-center">Situação</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    while ($arDados2 = mssql_fetch_array($Result2)) {
                                                                                        $data_hora = date('d/m/Y H:i:s', strtotime($arDados2['dt_registro']));
                                                                                        ?>      <tr>
                                                                                            <td><?php echo $data_hora; ?></td>
                                                                                            <td><?php echo $arDados2['str_usr_criador']; ?></td>
                                                                                            <td><?php echo $arDados2['str_protocol_formatado']; ?></td>
                                                                                            <td><?php echo $arDados2['int_numero_sei']; ?></td>
                                                                                            <td><?php echo utf8_encode($arDados2['str_descricao']); ?></td>
                                                                                            <td><?php
                                                                                                if (@$arDados2['int_situacao'] == 1) {
                                                                                                    echo 'Aberto';
                                                                                                } else if (@$arDados2['int_situacao'] == 2) {
                                                                                                    echo 'Em Andamento';
                                                                                                } else if (@$arDados2['int_situacao'] == 3) {
                                                                                                    echo 'Concluído';
                                                                                                }
                                                                                                ?></td>
                                                                                        </tr> <?php
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="tab_2">


                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <div>
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i></i></div>
                                                                        <div class="actions">

                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="table-responsive">
                                                                            <table id="sample_3_exp" class="table table-striped table-bordered table-hover" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">Data e Hora</th>
                                                                                        <th class="text-center">Usuário</th>
                                                                                        <th class="text-center">Número do Processo</th>
                                                                                        <th class="text-center">Número do Documento Sei</th>
                                                                                        <th class="text-center">Ação Realizada</th>
                                                                                        <th class="text-center">Situação</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    while ($arDados = mssql_fetch_array($Result)) {
                                                                                        $data_hora = date('d/m/Y H:i:s', strtotime($arDados['dt_registro']));
                                                                                        ?>      <tr>
                                                                                            <td><?php echo $data_hora; ?></td>
                                                                                            <td><?php echo $arDados['str_usr_criador']; ?></td>
                                                                                            <td><?php echo $arDados['str_protocol_formatado']; ?></td>
                                                                                            <td><?php echo $arDados['int_numero_sei']; ?></td>
                                                                                            <td><?php echo utf8_encode($arDados['str_descricao']); ?></td>
                                                                                            <td><?php
                                                                                                if (@$arDados['int_situacao'] == 1) {
                                                                                                    echo 'Aberto';
                                                                                                } else if (@$arDados['int_situacao'] == 2) {
                                                                                                    echo 'Em Andamento';
                                                                                                } else if (@$arDados['int_situacao'] == 3) {
                                                                                                    echo 'Concluído';
                                                                                                }
                                                                                                ?></td>
                                                                                        </tr> <?php
                                                                                    }
                                                                                    ?>
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
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                console.log("finished");
                $('#carregar').fadeIn(1500);
                $('#carregando').fadeOut(500);

            });
            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "date-br-pre": function (a) {
                    if (a == null || a == "") {
                        return 0;
                    }
                    var brDatea = a.split('/');
                    return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
                },

                "date-br-asc": function (a, b) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },

                "date-br-desc": function (a, b) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            });
            $("#sample_5_exp").DataTable({
                columnDefs: [
                    {
                        type: 'date-br',
                        targets: 0
                    }
                ],
            })



        </script>