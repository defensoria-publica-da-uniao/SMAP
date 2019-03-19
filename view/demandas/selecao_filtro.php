<?php
/* ini_set('max_execution_time', 864000);
  ini_set('mssql.timeout', 864000); */
ini_set('memory_limit', '3024M');
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/alert.php';
if (isset($_SESSION['filtros'])) {
    if (empty($_POST)) {
        js_go('selecao_filtro2');
        exit;
    } else {
        require_once 'controller/demandas/Cselecao.php';
    }
} else {

    require_once 'controller/demandas/Cselecao.php';
}
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
                <div align='right'>
                    <span class="font-dark-sharp" ><b>Última Carga :<?php echo date("d/m/y H:i:s", ( strtotime($_SESSION['ultimo_dado_dia']))); ?></b></span> 
                </div>   
                <div id="carregando" align="center"> <img src="<?php echo IMG . 'carregando.gif'; ?>" alt="some text" width=35% height=35%> </div> 
                <div id='carregar'> 
                    <div class="page-content">
                        <div class="container">
                            <div class="page-content-inner">

                                <?php
                                // MENSAGEM DE SUCESSO


                                if (!empty($_SESSION['alerta_duplicados'])) {
                                    $msg = $_SESSION['alerta_duplicados'];
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
                                unset($_SESSION['alerta_duplicados']);
                                // FIM MENSAGEM DE SUCESSO
                                ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="page-title" align="center">
                                            <span class="caption-subject font-dark bold uppercase">
                                                <br/>
                                                <div class="m-heading-1 border-green m-bordered">

                                                    <h3 style="margin-top: 10px;"><b>Seleção do SMAP com Filtro:</b></h3>
                                                    <h4><span class="font-blue-sharp"><?php echo $mensagem ?></span></h4>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="portlet light ">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 align="center"class="panel-title">Filtros</h3>
                                                </div>
                                                <form  class="rounded" method="POST" action="<?php echo RAIZ . 'demandas/selecao_filtro' ?>" enctype="multipart/form-data" onSubmit="return valida_form()">

                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-sm-5 col-md-4 col-lg-3">
                                                                <span style="text-align: left !important;" class="help-block" > Por nº do processo / nº do documento SEI
                                                                </span>
                                                                <input type="text" name="num_processo" id="num_processo" class="form-control input-medium" >
                                                            </div>

                                                            <div class="col-sm-7 col-md-5 col-lg-4">
                                                                <span class="help-block" align="left">Data Despacho SGE:</span>
                                                                <div class="input-group input-large date-picker input-daterange " data-date-format="dd/mm/yyyy" >
                                                                    <input type="text" class="form-control"  placeholder="Data Inicial" name="dt_despacho_inicial" id="dt_despacho_inicial"  >
                                                                    <span class="input-group-addon"> até </span>
                                                                    <input type="text" class="form-control"  placeholder="Data Final"  name="dt_despacho_final" >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-7 col-md-4 col-lg-4">
                                                                <span style="text-align: left !important;" class="help-block"> Por Unidade DPU / Secretaria DPGU de <b>Destino</b> </span>
                                                                <select name="filtro_todos" id="filtro_setor" class="form-control input-large" >
                                                                    <option value=""></option>
                                                                    <option value="TODOS_DPGU_DPU">TODOS - DPGU e DPU</option>
                                                                    <option value="TODOS_DPGU">TODOS - DPGU - Administração Superior</option>
                                                                    <option value="TODOS_DPU">TODOS - DPU - Órgão de Atuação (Unidade)</option>
                                                                    <option value="DPGU">DPGU - Administração Superior</option>
                                                                    <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                                                                </select>

                                                                <div id="unidades_destinos">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-3 col-lg-2">
                                                                <span style="text-align: left !important;" class="help-block"> Por Situação </span>
                                                                <select name="situacao" class="form-control input-small" >
                                                                    <option value="0"></option>
                                                                    <option value="1">Em Aberto</option>
                                                                    <option value="2">Em Andamento</option> 
                                                                    <option value="3">Concluída</option>
                                                                    <option value="4">Ciente</option>
                                                                </select>
                                                            </div>

                                                            <div align="center" class="col-sm-3 col-md-3 col-lg-3">
                                                                <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                                <input type="submit" name="Submit"  class="btn btn-primary" value="Filtrar"  />
                                                            </div>

                                                        </div>
                                                </form>

                                            </div>



                                        </div>

                                        <hr>
                                        <div class="row">
                                            <?php if ($cadastrar == 1) { ?>

                                                <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'demandas/Cduplicados.php' ?>" enctype="multipart/form-data" onSubmit="return valida_campo()">

                                                    <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                        <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                        <input type="hidden" name="duplicados" id="duplicados"  class="btn btn-success" value=""  />
                                                        <input type="submit" name="Submit"  class="btn btn-danger" value="Remover Duplicados" data-toggle="confirmation" data-original-title="Confirmar Remoção??"   />
                                                    </div>
                                                </form>

                                            <?php } ?>
                                            <?php if ($alterar == 1) { ?>

                                                <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'demandas/Cduplicados.php' ?>" enctype="multipart/form-data" onSubmit="return valida_campo2()">

                                                    <div align="center" class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                                        <span style="text-align: left !important; color:#ffffff !important;" class="help-block">.</span>
                                                        <input type="hidden" name="confirmacao_duplicados" value="1">
                                                        <input type="hidden" name="duplicados_confirmar" id="duplicados_confirmar"  class="btn btn-success" value=""  />
                                                        <input type="submit" name="Submit" style=" color:black !important;"  class="btn btn-warning" value="Mandar para remoçao" data-toggle="confirmation" data-original-title="Confirmar Remoção??"   />
                                                    </div>
                                                </form>

                                            <?php } ?>
                                        </div>
                                        <div class="portlet-body">


                                            <table id="sample_1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" >Ação:</th>
                                                        <?php if ($cadastrar == 1) { ?>
                                                            <th class="text-center" >Duplicado:</th>
                                                            <?php
                                                        }
                                                        if ($alterar == 1) {
                                                            ?>
                                                            <th class="text-center" >Remoção:</th>
                                                        <?php } ?>
                                                        <th class="text-center" >Processo:</th>
                                                        <th class="text-center" >Nº sei:</th>
                                                        <th class="text-center" >Tipo do Processo:</th>
                                                        <th class="text-center" >Destino:</th>
                                                              <th class="text-center" >Última movimentação:</th>
                                                       
                                                        <th class="text-center" >Assunto:</th>
                                                        <th class="text-center" >Despachado<br> pela SGE em:</th>
                                                        <th class="text-center" >Assinado em:</th>
                                                        <th class="text-center" >Situação:</th>
                                                    </tr>
                                                </thead>



                                                <tbody>

                                                    <?php
                                                    //Variaveis para serem ids da exclusao e remoção
                                                    $x = 1;
                                                    $t = 10000;
                                                    while (@$arDados = mssql_fetch_array($Result)) { //echo'<pre>'; var_dump($arDados);
                                                        //echo'<pre>'; var_dump($arDados);
                                                        $chave_duplicado = $arDados['id_documento_sei'] . ';' . $arDados['str_destino_sei'];

                                                        if (!in_array($chave_duplicado, $arDuplicadoschave)) {
                                                            ?>
                                                            <tr>
                                                                <td align="center">
                                                                    <form action='<?php echo RAIZ . 'demandas/exibedemanda_filtro' ?>' method='post'>
                                                                        <input type='text' name='id_acompanhamento' value='<?php echo $arDados['id_acompanhamento']; ?>' />
                                                                        <input type='hidden' name='id_documento_sei' value='<?php echo $arDados['id_documento_sei']; ?>' />
                                                                        <input type='hidden' name='destino_sei' value='<?php echo $arDados['str_destino_sei']; ?>' />
                                                                        <a href="javascript:;" class="popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Exibição da demanda">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <i class="fa fa-search"></i>
                                                                            </button>
                                                                        </a>
                                                                    </form>
                                                                </td>
                                                                <?php
                                                                if ($cadastrar == 1) {
                                                                    ?>
                                                                    <td align="center" >


                                                                        <div class="mt-checkbox-list">
                                                                            <label class="mt-checkbox_2">
                                                                                <input type="checkbox" value="<?php echo $chave_duplicado; ?>"  id="<?php echo $x; ?>" name="test" onclick='adicionar_valor(this.value, this.id)' />
                                                                                <span></span>
                                                                            </label> 
                                                                        </div>


                                                                    </td>
                                                                    <?php
                                                                }
                                                                if ($alterar == 1) {
                                                                    ?>
                                                                    <td align="center" >
                                                                        <div class="mt-checkbox-list">
                                                                            <label class="mt-checkbox_2">
                                                                                <input type="checkbox" value="<?php echo $chave_duplicado; ?>"  id="<?php echo $t; ?>" name="test" onclick='adicionar_valor2(this.value, this.id)' />
                                                                                <span></span>
                                                                            </label> 
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                                <td width="17%" align="center" ><?php echo $arDados['str_protocol_formatado']; ?></td> 
                                                                <td align="center" ><?php echo $arDados['int_numero_sei']; ?></td> 
                                                                <td><?php echo utf8_encode($arDados['str_tipo_processo']); ?></td>  
                                                                <td>
                                                                    <?php
                                                                    // if( $arDados["str_usr_criador"]=='MIGRA BANCO'){
                                                                    //     echo $arDados['str_destino_sei'] ;
                                                                    //  }else{    
                                                                    if (!empty($arDados['secretaria_descricao'])) {
                                                                        echo $arDados['secretaria_sigla'] . ' - ' . utf8_encode($arDados['secretaria_descricao']);
                                                                    } else {
                                                                        echo $arDados['uf_destino'] . ' - ' . utf8_encode($arDados['unidade_descricao']);
                                                                    }
                                                                    //  }
                                                                    ?>
                                                                </td> 
                                                               <td><?php echo date('d/m/Y H:i:s', strtotime($arDados['dt_criacao_acomp'])); ?></td>
                                                               
                                                                <td align="center"> 
                                                                    <a href="javascript:;" class="popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="<?php echo $objSmap->trataDemandas($arDados['str_conteudo']); ?>" data-original-title="Assunto">
                                                                        <i class="glyphicon glyphicon-comment"></i>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo date('d/m/Y', strtotime($arDados['dt_despacho'])); ?></td>
                                                                 <td><?php echo date('d/m/Y', strtotime($arDados['dt_assinatura'])); ?></td>

                                                                <td><?php
                                                                    if ($arDados['int_situ'] == 1) {
                                                                        echo "Em aberto";
                                                                    } else if ($arDados['int_situ'] == 2) {
                                                                        echo "Em andamento";
                                                                    } else if ($arDados['int_situ'] == 3) {
                                                                        echo "Concluído";
                                                                    } else if ($arDados['int_situ'] == 4) {
                                                                        echo "Ciente";
                                                                    }
                                                                    ?> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            //Variaveis para serem ids da exclusao e remoção
                                                            $x++;
                                                            $t++;
                                                        }
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



<?php $caminho2 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>

    var caminho2;
    caminho2 = '<?php echo $caminho2 ?>';

    $(document).ready(function () {
        $('#filtro_setor').change(function () {
            $('#unidades_destinos').load(caminho2 + '?destino=' + $('#filtro_setor').val());
        });
    });

    function valida_form() {
        if (document.getElementById("num_processo").value.length == "") {
            if (document.getElementById("dt_despacho_inicial").value.length == "") {
                document.getElementById("dt_despacho_inicial").setAttribute("required", "true");
// document.getElementById("dt_despacho_inicial").removeAttribute("required");
                document.getElementById("dt_despacho_inicial").focus();
                return false;
            }
        } else {
            //alert('sss');
            document.getElementById("dt_despacho_inicial").removeAttribute("required");

            //document.getElementById("dt_despacho_inicial").setAttribute("required","false");
        }
    }

    function  valida_campo() {
        if (document.getElementById("duplicados").value == "" || document.getElementById("duplicados").value == "/") {
            alert('Selecione ao menos um processo para Remover');
            return false;
        }
    }
    function  valida_campo2() {
        if (document.getElementById("duplicados_confirmar").value == "" || document.getElementById("duplicados_confirmar").value == "/") {
            alert('Selecione ao menos um processo para Remover');
            return false;
        }
    }

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
    function adicionar_valor2(dados2, id) {

        var dadosatuais2 = document.getElementById("duplicados_confirmar").value;
        var check2 = document.getElementById(id);


        if (check2.checked == true) {
            document.getElementById("duplicados_confirmar").value = dados2 + '@' + dadosatuais2;
            // alert(document.getElementById("duplicados_confirmar").value);
        } else {
            var replace2;
            replace2 = document.getElementById("duplicados_confirmar").value;
            document.getElementById("duplicados_confirmar").value = replace2.replace(dados2, "");
            // alert(document.getElementById("duplicados_confirmar").value);
        }


    }

    $(document).ready(function () {
        console.log("finished");
        $('#carregar').fadeIn(1500);
        $('#carregando').fadeOut(500);

    });
</script>