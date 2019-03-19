<?php
    require_once INCLUDES . 'validaLogin.php';
    require_once 'controller/demandas/Cconteudo.php';
?>

<script>
    function abrir(link) {
        window.open(link, '_blank');
    }
</script>

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
                                            <div class="m-heading-1 border-green m-bordered">
                                                <?php
                                                    echo '<h3 style="margin-top: 10px;" ><b>Número doc: ' . $result['valor'] . '</b></h3>';
                                                ?>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-xs-12 col-sm-12">
                                    <div class="portlet light ">

                                        <div align="center" class="portlet-body">
                                            <?php
                                                if (@$result['conteudo'] == NULL) {
                                                    echo 'PDF/Word OU imagem';
                                               
                                                    ?>
                                            <script> abrir('<?php echo $caminho; ?>');</script>
                                                    <?php
                                                } else {
                                                    echo $result['conteudo'];
                                                };
                                            ?>
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