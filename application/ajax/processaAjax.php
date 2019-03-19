<?php $caminho2 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>
<script>
 
    var caminho2 = '<?php echo $caminho2 ?>';
    
    function exibeUnidades (vlr){     
        $('#unidades_origem3').load(caminho2 + '?origem=' + $('#opcao3').val());
    }
      function exibeUnidades2 (vlr){
        $('#unidades_destinos4').load(caminho2 + '?destino=' + $('#opcao4').val());      
    }
</script>

<form action="<?php echo CONTROLLER . 'demandas/Coperacoes.php'; ?>" method="POST">

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
                        <textarea rows="11" class="wysihtml5 form-control" name="resumo" maxlength="7000" required=""><?php echo utf8_encode($arDados['2']); ?></textarea>
                        <!-- <  ?php echo utf8_encode($arDados['str_resumo']); ?> -->
                    </div>
                </div>
            </div>
            <br>
            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <span class="help-block" align="left">Unidade DPU / Área DPGU:</span>
                     <select onchange="exibeUnidades(this.value)"  id="opcao3" class=form-control>
                        <option value="">Selecione</option>
                        <option value="DPGU">DPGU - Administração Superior</option>
                        <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                    </select>

                    <div id="unidades_origem3" >                                     
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <span class="help-block" align="left">Destino da demanda:</span>  
                    <select onchange="exibeUnidades2(this.value)"  id="opcao4" class=form-control>
                        <option value="">Selecione</option>
                        <option value="DPGU">DPGU - Administração Superior</option>
                        <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                    </select>

                    <div id="unidades_destinos4" >
                    </div>

                </div>
               
            </div>
             <div class="col-xs-12 col-sm-12 col-md-4">
                    <span class="help-block" align="left">Prazo:</span>
                    <input class="form-control form-control-inline input-medium " type="date" name="dt_prazo" placeholder="Prazo Final" value="<?php echo $dt_prazo; ?>" />
                </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                    <span class="help-block" align="left">Data Vencimento:</span>
               
                    <input class="form-control form-control-inline input-medium " type="date" name="dt_vencimento" value="<?php echo $dt_vencimento; ?>" />
                </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type='hidden' name='updatehistorico' value='1'/>
        <input type='hidden' name='id_acompanhamento' value='<?php echo $id_acompanhamento; ?>' />
        <input type='hidden' name='id_documento' value='<?php echo $id_documento; ?>' />
        <input type='hidden' name='destino_sei' value='<?php echo  $destino_sei; ?>' />
        <input type='hidden' name='usr_criador' value='<?php echo $_SESSION['usuario']['login']; ?>' />
        <input type='hidden' name='id_historico_acompanhamento' value='<?php echo $arDados['id_historico_acompanhamento']; ?>' />
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Incluir</button>
    </div>

</form>
<?php $caminho2 = CONTROLLER . 'demandas/Cexibedemanda.php'; ?>

