<?php
require_once INCLUDES . 'validaLogin.php';
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


                            if (!empty($_SESSION['correcao_doc_sei'])) {
                                $msg = $_SESSION['correcao_doc_sei'];
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
                            unset($_SESSION['correcao_doc_sei']);
                            // FIM MENSAGEM DE SUCESSO
                            ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">

                                                <h3 style="margin-top: 10px;"><b>Correçõs de Bug's 0 e 1:</b></h3>
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


                                                <div class="modal-body">


                                                    <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                                            <div class="form-body">
                                                                <form action='<?php echo CONTROLLER . 'administrador/correcoes.php' ?>' method='post'>
                                                                    <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                                        <div class="form-group col-md-3">
                                                                            <label style="text-align:left !important;" >Número Documento Sei:</label>
                                                                            <input class="form-control spinner" maxlength="40" name="int_numero_sei" id="str_login" type="text" placeholder="" required> 
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label style="text-align:left !important;" >.</label>
                                                                            <button type="submit" class="form-control btn btn-primary"  data-toggle="confirmation" data-original-title="Deixar Corrigir esse Documento">Corrigir</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

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
