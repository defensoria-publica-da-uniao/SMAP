<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/demandas/Cselecao2.php';
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
                                        if (!empty($_SESSION['alert_duplicados'])) {
                                            $msg = $_SESSION['alert_duplicados'];
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
                                        unset($_SESSION['alert_duplicados']);
                                        // FIM MENSAGEM DE SUCESSO
                                    ?>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Seleção do SEI</b></h3>
                                                <h4><span class="font-blue-sharp">Processos Despachados dia <?php echo $_SESSION['filtro_dt_despacho'];?></span></h4>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="portlet light">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 align="center"class="panel-title">Filtros</h3>
                                            </div>
                                            <div class="panel-body">
                                                    <div class="row">
              
                                                             <form  class="rounded" method="POST" action="<?php echo RAIZ . 'demandas/selecao2' ?>" enctype="multipart/form-data" onSubmit="return valida()">
                                                 
                                                        <div class="col-xs-3 col-sm-5 col-md-4 col-lg-3">
                                                            <span style="text-align: left !important;" class="help-block"> Data Despacho
                                                            </span>
                                                            <input type="date" name="dt_processo" class="form-control input-medium" required="">
                                                        </div>
                                                        <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                            <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                            <input type="submit" name="Submit"  class="btn btn-success" value="Filtrar"  />
                                                        </div>
                                                               </form>
                                                             <form  class="rounded" method="POST" action="<?php echo RAIZ . 'demandas/selecao2' ?>" enctype="multipart/form-data" onSubmit="return valida()">
                                     
                                                        <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                            <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                             <input type="hidden" name="reiniciar" class="form-control input-medium" valuer="1">
                                                            <input type="submit" name="Submit"  class="btn btn-default" value="Limpar Filtro"  />
                                                        </div>
                                                               </form>
                                                             <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'demandas/Cduplicados.php' ?>" enctype="multipart/form-data" onSubmit="return valida_campo()">

                                                        <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                            <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                            <input type="hidden" name="duplicados" id="duplicados"  class="btn btn-success" value=""  />
                                                            <input type="submit" name="Submit"  class="btn btn-danger" value="Remover Duplicados" data-toggle="confirmation" data-original-title="Confirmar Remoção??"   />
                                                        </div>
                                                    </form>
                                                    </div>
                                             
                                            </div>



                                        </div>

                                        <hr>

                                        <div class="portlet-body">
                                            <table id="sample_1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" >Ação:</th>
                                                        <th class="text-center" >Duplicado:</th>
                                                        <th class="text-center" >Processo:</th>
                                                        <th class="text-center" >Nº Sei:</th>
                                                        <th class="text-center" >Destino SEI:</th>
                                                        <th class="text-center" >Tipo do Processo:</th>
                                                        <th class="text-center" >Assinado em:</th>
                                                        <th class="text-center" >Assunto:</th>
                                                        <th class="text-center" >Despachado pela SGE em:</th>

                                                        <th class="text-center" >Tipo Documento:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $x = 0;
                                                        for ($i = 1; $i <= count($arDespachos); $i++) {
                                                            $chave = $arDespachos[$i]['id_documento_sei'] . $arDespachos[$i]['sigla_unidade'];
                                                            if (!in_array($chave, $idacompanhamento)) {
                                                                if(!in_array($chave, $idDuplicados)){
                                                                ?> <tr>
                                                                    <td align="center">
                                                                        <form action='<?php echo RAIZ . 'demandas/exibedemanda' ?>' method='post'>
                                                                            <input type="hidden" name="id_documento_sei" value='<?php echo $arDespachos[$i]['id_documento_sei']; ?>' />
                                                                            <input type="hidden" name="id_protocolo" value='<?php echo $arDespachos[$i]['id_protocolo']; ?>' />
                                                                            <input type="hidden" name="protocolo_formatado" value='<?php echo $arDespachos[$i]['protocolo_formatado']; ?>' />
                                                                            <input type="hidden" name="tipo_processo" value='<?php echo $arDespachos[$i]['tipo_processo']; ?>' />
                                                                            <input type="hidden" name="conteudo" value='<?php echo $arDespachos[$i]['conteudo']; ?>' />
                                                                            <input type="hidden" name="dta_assinatura" value='<?php echo $arDespachos[$i]['dt_assinatura_documento']; ?>' />
                                                                            <input type="hidden" name="dta_despacho" value='<?php echo $arDespachos[$i]['dt_despacho']; ?>' />
                                                                            <input type="hidden" name="sigla_unidade" value='<?php echo $arDespachos[$i]['sigla_unidade']; ?>' />
                                                                            <input type="hidden" name="numero_sei" value='<?php echo $arDespachos[$i]['numero_sei']; ?>' />
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <i class="fa fa-search"></i>
                                                                            </button>
                                                                        </form> 
                                                                    </td>
                                                                     <td align="center" >
                                                                        
                                                                            
                                                                                                      <div class="mt-checkbox-list">
                                                                                    <label class="mt-checkbox_2">
                                                                                        <input type="checkbox" id="<?php echo $x; ?>" value="<?php echo utf8_encode($chave); ?>" name="test" onclick='adicionar_valor(this.value, this.id)' />
                                                                                        <span></span>
                                                                                    </label> 
                                                                                </div>
                                                                            
                                                                      
                                                                    </td>
                                                                    <td><?php echo $arDespachos[$i]['protocolo_formatado'] ?></td>
                                                                    <td><?php echo $arDespachos[$i]['numero_sei'] ?></td>  
                                                                    <td align='center'><?php echo utf8_encode($arDespachos[$i]['sigla_unidade']); ?></td>	
                                                                    <td><?php echo $arDespachos[$i]['tipo_processo'] ?></td>
                                                                    <td><?php echo $arDespachos[$i]['dt_assinatura_documento'] ?></td>
                                                                    <td align='center'> <a href="javascript:;" class="popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="<?php echo $objSmap->trataDemandas($arDespachos[$i]['conteudo']); ?>" data-original-title="Assunto">
                                                                            <i class="glyphicon glyphicon-comment" ></i>
                                                                        </a>
                                                                    </td>
                                                                    <td align='center'><?php echo $arDespachos[$i]['dt_despacho'] ?></td>									
                                                                    <td><?php echo $arDespachos[$i]['tipo_documento'] ?></td>  
                                                                </tr>
                                                            <?php
                                                        }}
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
    
    function  valida_campo(){
        if(document.getElementById("duplicados").value=="" || document.getElementById("duplicados").value=="/" ){
            alert('Selecione ao menos um processo para Remover');
            return false;
        }
    }
    
    function adicionar_valor(dados, id) {
        var dadosatuais = document.getElementById("duplicados").value;
        var check = document.getElementById(id);

        if (check.checked == true) {
            document.getElementById("duplicados").value = dados + '/' + dadosatuais;
        } else {
            var replace;
            replace = document.getElementById("duplicados").value;
            document.getElementById("duplicados").value = replace.replace(dados, "");
            //alert(document.getElementById("duplicados").value);
        }
       
    }
    
    </script>