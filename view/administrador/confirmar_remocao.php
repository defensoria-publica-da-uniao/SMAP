<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/administrador/Cadm_duplicados.php';
?>

<div class="page-wrapper-row full-height">

    <div class="page-wrapper-middle">
        <div class="page-container">
            <div class="page-content-wrapper">
                                       
                <div class="page-content">
                    <div class="container">
                        <div class="page-content-inner">

                            <?php
                            // MENSAGEM DE SUCESSO


                            if (!empty($_SESSION['alerta_duplicados_confirmacao'])) {
                                $msg = $_SESSION['alerta_duplicados_confirmacao'];
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
                            unset($_SESSION['alerta_duplicados_confirmacao']);
                            // FIM MENSAGEM DE SUCESSO
                            ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">

                                                <h3 style="margin-top: 10px;"><b>Processos Duplicados:</b></h3>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="portlet light ">


                                        <div class="portlet-body">
                                            <div class="row">


                                                <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'demandas/Cduplicados.php' ?>" enctype="multipart/form-data" onSubmit="return valida_campo()">

                                                    <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                        <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                        <input type="hidden" name="confirmar_remocao" value="1">
                                                        <input type="hidden" name="duplicados" id="duplicados"  class="btn btn-success" value=""  />
                                                        <input type="submit" name="Submit"  class="btn btn-primary" value="Remover Duplicados" data-toggle="confirmation" data-original-title="Confirmar Remoção??"   />
                                                    </div>
                                                </form>


                                            </div>
                                            <table id="sample_1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" >Ação:</th>
                                                        <th class="text-center" >Remover da lista:</th>
                                                        <th class="text-center" >Data/Hora:</th>
                                                        <th class="text-center" >Responsável Criador:</th>
                                                    <th class="text-center" >Processo:</th>
                                                    <th class="text-center" >Nº sei:</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //Variaveis para serem ids da exclusao e remoção
                                                    $x = 1;
                                                    while (@$arDados = mssql_fetch_array($consultarSql)) {
                                                        ?>
                                                        <tr>                                                        <?php
                                                        $chave_duplicado = $arDados['id_documento_sei'] . ';' . $arDados['str_destino_sei'];
                                                            ?>
                                                            <td align="center">
                                                                <form action='<?php echo RAIZ . 'demandas/exibedemanda_filtro' ?>' method='post'>

                                                                    <div class="mt-checkbox-list">
                                                                        <label class="mt-checkbox_2">
                                                                            <input type="checkbox" value="<?php echo $chave_duplicado; ?>"  id="<?php echo $x; ?>" name="test" onclick='adicionar_valor(this.value, this.id)' />
                                                                            <span></span>
                                                                        </label> 
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td align="center">
                                                                <form action='<?php echo CONTROLLER . 'administrador/Cadm_duplicados.php' ?>' method='post'>
                                                                    <input type='hidden' name='id_duplicados_confirmar' value='<?php echo $arDados['id_duplicados_confirmar']; ?>' />                                                   
                                                                    <button type="submit" class="btn red-sunglo btn-xs mod" data-toggle="confirmation" data-original-title="Retirar registro de processos duplicados??">
                                                                        <input type='hidden' name='id_duplicados_confirmar' value='<?php echo $arDados['id_duplicados_confirmar']; ?>' />                                                   
                                                                           <i class="fa fa-remove"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td><?php echo date('d/m/Y H:i:s', strtotime($arDados['dt_acao'])); ?></td> 
                                                            <td><?php echo $arDados['str_usr_criador']; ?></td>  
                                                             <td><?php echo $arDados['str_protocol_formatado']; ?></td>  
                                                              <td><?php echo $arDados['int_numero_sei']; ?></td>  

                                                        </tr>
                                                        <?php
                                                        $x++;
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
<script>
    function adicionar_valor(dados, id) {

        var dadosatuais = document.getElementById("duplicados").value;
        var check = document.getElementById(id);

        if (check.checked == true) {
            document.getElementById("duplicados").value = dados + '@' + dadosatuais;
            // alert(document.getElementById("duplicados").value);
        } else {
            var replace;
            replace = document.getElementById("duplicados").value;
            document.getElementById("duplicados").value = replace.replace(dados, "");
            //  alert(document.getElementById("duplicados").value);
        }


    }
</script>