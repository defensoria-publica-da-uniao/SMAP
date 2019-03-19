<?php
session_start();
require 'application/configs/config.php';
require "application/includes/cRoteadorUrl.php";
require "application/includes/capturaUrl.php";
require 'model/cBanco.php';
require 'model/cGeral.php';
require 'model/cSql.php';
require 'model/cSei.php';
require_once 'model/cUsuarios.php';
require_once 'model/cSmap.php';
require 'controller/alert.php';


$objBanco = new cBanco();
$objGeral = new cGeral();
$objSql = new cSql();
$objSei = new cSei();
$objSmap = new cSmap();
$oUsuario = new cUsuarios();


?>	    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

        <title> ::.. SMAP ..:: </title>
        <meta name="description" content="Descrição do Sistema"/>
        <meta name="author" content="Coordenação de Sistemas - STI"/>

        <!-- BEGIN GLOBAL MANDATORY STYLES 
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        -->
        <link href="<?php echo CSS; ?>mandatory/font-awesome.min.css" rel="stylesheet" type="text/css" />       <!-- Icones -->
        <link href="<?php echo CSS; ?>mandatory/simple-line-icons.min.css" rel="stylesheet" type="text/css" />  <!-- Icones -->

        <link href="<?php echo CSS; ?>mandatory/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>mandatory/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END BEGIN GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo CSS; ?>datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>datatables/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo CSS; ?>datepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />       <!-- datapicker -->
        <link href="<?php echo CSS; ?>datepicker/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>datepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>datepicker/clockface.css" rel="stylesheet" type="text/css" />                 <!-- Fim datapicker -->

        <link href="<?php echo CSS; ?>global/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>global/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo CSS; ?>global/stree/jstree.css" rel="stylesheet" type="text/css" />
        
        
        <link href="<?php echo JS; ?>wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />  <!-- Recursos de envio de e-mail - negrito, sublinhado -->
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo CSS; ?>global/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo CSS; ?>global/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>global/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />   <!-- Anexar arquivos formulário -->
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo CSS; ?>layouts/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>layouts/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo CSS; ?>layouts/modificacao.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo CSS; ?>login/login-4.css" rel="stylesheet" type="text/css"/>     <!-- Login -->
        <!-- END PAGE LEVEL STYLES -->






        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo JS; ?>plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>plugins/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>plugins/jquery.slimscroll.min.js" type="text/javascript"></script>    <!-- Barra de rolagem vertical - Alertas -->
        <script src="<?php echo JS; ?>plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>plugins/bootstrap-switch.min.js" type="text/javascript"></script>     <!-- Botão duplo: components_bootstrap_switch -->
        <script src="<?php echo JS; ?>dataTableMetronic/jquery.dataTables.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo JS; ?>counterup/jquery.waypoints.min.js" type="text/javascript"></script>   <!-- Efeito número -->
        <script src="<?php echo JS; ?>counterup/jquery.counterup.min.js" type="text/javascript"></script>   <!-- FIM Efeito número -->
        <script src="<?php echo JS; ?>jquery.validate.js" type="text/javascript"></script>                  <!-- Login -->

        <script src="<?php echo JS; ?>dataTableMetronic/datatable.js" type="text/javascript"></script>             <!-- Tabela -->
        <script src="<?php echo JS; ?>dataTableMetronic/datatables.min.js" type="text/javascript"></script>             <!-- PDF, Excel -->
        <script src="<?php echo JS; ?>dataTableMetronic/datatables.bootstrap.js" type="text/javascript"></script>   
        <script src="<?php echo JS; ?>dataTableMetronic/table-datatables-buttons.min.js" type="text/javascript"></script>  <!-- FIM Tabela | PDF, Excel-->
        <script src="<?php echo JS; ?>plugins/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>plugins/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script src="<?php echo JS; ?>plugins/select2.full.js" type="text/javascript"></script>

        <script src="<?php echo JS; ?>plugins/jstree.js" type="text/javascript"></script>
        
        <script src="<?php echo JS; ?>plugins/bootstrap-confirmation.min.js" type="text/javascript"></script>           <!-- Confirmação de Exclusão de dado do banco -->
        
        <script src="<?php echo JS; ?>wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>      <!-- Recursos de envio de e-mail - negrito, sublinhado -->
        <script src="<?php echo JS; ?>wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>  <!-- Recursos de envio de e-mail - negrito, sublinhado -->
        <script src="<?php echo JS; ?>wysihtml5/form-validation.js" type="text/javascript"></script>  <!-- Recursos de envio de e-mail - negrito, sublinhado -->
        
        <script src="<?php echo JS; ?>plugins/bootstrap-fileinput.js" type="text/javascript"></script>  <!--Anexar arquivos formulário -->
        <!-- END BEGIN PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo JS; ?>scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo JS; ?>scripts/table-datatables-managed.min.js" type="text/javascript"></script>  <!-- Tabela -->
        <script src="<?php echo JS; ?>scripts/components-bootstrap-maxlength.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

        <script src="<?php echo JS; ?>scripts/ui-tree.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo JS; ?>layouts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>layouts/demo.min.js" type="text/javascript"></script>
      
        <script src="<?php echo JS; ?>scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->





        <!-- VERIFICAR -->
        <!-- GRAFICOS -->
        <script src="<?php echo PUBLICO; ?>graficos/js1.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js2.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js3.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js4.js "></script>
        <script src="<?php echo PUBLICO; ?>graficos/js5.js "></script>

        <link rel="stylesheet" href="<?php echo PUBLICO; ?>graficos/estilografico.css" type="text/css" media="all" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
        <!-- Para baixar graficos  
        "export": {
  "enabled": true
}
        -->
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>

        <!-- FIM GRAFICOS -->

             

    </head>

    <body class="page-container-bg-solid">
        <div class="page-wrapper">

            <?php
            if ($modulo <> 'login') {
                //require_once 'application/layouts/topo.php';
                ?>

                <?php // echo'<pre>';var_dump($_SESSION['usuario'])   ?>

                <?php
                if (isset($_SESSION['usuario']['ok'])) {
                    @$registro = $_SESSION['registro'];
                    @$limite = $_SESSION['limite'];
                    if ($registro) {// verifica se a session  registro esta ativa
                         @$segundos = time() - @$registro;
                    }
                  
                    // fim da verificação da session registro

                    /* verifica o tempo de inatividade 
                      se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
                      se não ele renova o tempo e ai é contado mais 900 segundos */
                    if (@$segundos > @$limite) {
                        session_destroy();
                        $ultima_entrada=$_SESSION['ultimo_acesso'];
                        die(js_junto("Sua seção expirou 2h, Faça o login novamente. Último acesso: $ultima_entrada", RAIZ . 'login/inicio'));
                    } else {
                        $_SESSION['registro'] = time();                      
                            require_once 'application/layouts/menuHorizontalAdmin.php';
                    }
                }
               
                ?>

                <style> 
                    #carregar
                    {
                        display: none;  
                    }
                </style>


                <?php require_once $urlRedirect; ?>  


                <?php require_once 'application/layouts/rodape.php'; ?>

                <script type="text/javascript">


                    /*
                     $(document).ready(function () {
                     $('#sample_1').dataTable({
                     responsive: 'true',
                     "ordering": false
                     });
                         
                     $('#sample_2').dataTable({
                     responsive: 'true',
                     "ordering": false
                     });
                     $('#sample_3').dataTable({
                     responsive: 'true',
                     "ordering": false
                     });
                     });
                     */

                    $(function () {
                        $("#datepicker").datepicker({
                            language: "pt-BR",

                            changeMonth: true,
                            numberOfMonths: 1

                        });
                        $("#datepicker2").datepicker({
                            language: "pt-BR",

                            changeMonth: true,
                            numberOfMonths: 1

                        });
                        $("#datepicker3").datepicker({
                            language: "pt-BR",

                            changeMonth: true,
                            numberOfMonths: 1

                        });
                        $("#datepicker4").datepicker({
                            language: "pt-BR",

                            changeMonth: true,
                            numberOfMonths: 1

                        });

                    });
                    $(function () {
                        var dateFormat = "dd/mm/yy",
                                from = $("#from")

                                .datepicker({
                                    language: "pt-BR",

                                    changeMonth: true,
                                    numberOfMonths: 1

                                })

                                .on("change", function () {
                                    to.datepicker("option", "minDate", getDate(this));
                                }),
                                to = $("#to").datepicker({

                            changeMonth: true,
                            numberOfMonths: 1,
                            language: "pt-BR"
                        })
                                .on("change", function () {
                                    from.datepicker("option", "maxDate", getDate(this));
                                }
                                );

                        function getDate(element) {
                            var date;
                            try {
                                date = $.datepicker.parseDate(dateFormat, element.value);
                            } catch (error) {
                                date = null;
                            }

                            return date;
                        }
                    });
                    $(document).ready(function () {
                        $('[data-toggle="tooltip"]').tooltip();
                        console.log("finished");
                    });
                    
                </script>


                <?php
            } else {
                require_once $urlRedirect;
            }
            ?>
        </div>

    </body>	
</html>
