<form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">

    <?php
        // recebe o valor enviado no Script e realiza uma condição lógica. Se valor id_secretaria estiver VAZIO " ! " mostra formulário id_secretaria
        if (!empty($_POST['id_unidade'])){
            
            
    ?>
        
    <!-- Editar Unidade DPU-->
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
                                <select onchange="exibeRegiaoUF(this.value)" id="opcao_regiao_2" class="form-control" >
                                    <option value="">Selecione</option>
                                    <option value="1">Centro-Oeste</option>
                                    <option value="2">Nordeste</option>
                                    <option value="3">Norte</option>
                                    <option value="4">Sudeste</option>
                                    <option value="5">Sul</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <div id="estado_uf_2">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Nome da unidade:</label>
                                <input type="text" name="descricao" value="<?php echo utf8_encode($str_descricao); ?>" class="form-control" maxlength="255" placeholder="Nome da unidade" required=""> 
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Email da unidade:</label>
                                <input type="email" name="email" value="<?php echo utf8_encode($str_email); ?>" class="form-control" maxlength="255" placeholder="Email" required=""> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="update_unidade_dpu" value='90000'/>
        <input type="hidden" name="id_unidade" value="<?php echo $id_unidade; ?>" />
        <input type="hidden" name="usr_criador" value="<?php echo $_SESSION['usuario']['login']; ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
    <!-- FIM Editar Unidade DPU -->
    
    <?php } 
        else if (!empty($_POST['id_secretaria'])) { 
    ?>

    <!-- Editar Área DPGU -->
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
                                <input type="text" name="sigla" value="<?php echo utf8_encode($str_sigla); ?>" class="form-control" maxlength="50" placeholder="Sigla" required=""> 
                            </div>
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Setor é subordinado à/ao </label>
                                <?php echo $oSmap->consulta_Simples_DPGU_editar($id_secretaria_pai,'id_secretaria_pai');  ?> 
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Nome do setor:</label>
                                <input type="text" name="descricao" value="<?php echo utf8_encode($str_descricao); ?>" class="form-control" maxlength="255" placeholder="Nome do setor" required=""> 
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Email do setor:</label>
                                <input type="email" name="email" value="<?php echo utf8_encode($str_email); ?>" class="form-control" maxlength="255" placeholder="Email" required=""> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="update_setor_dpgu" value='80000'/>
        <input type="hidden" name="id_secretaria" value="<?php echo $id_secretaria; ?>" />
        <input type="hidden" name="usr_criador" value="<?php echo $_SESSION['usuario']['login']; ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
    
    <!-- FIM Editar Área DPGU -->

    <?php }
        else{
            echo 'Erro! Não encontrou nada. Contate o administrador.';
        }
     
    ?>  

</form>


<?php $caminho5 = CONTROLLER . 'administrador/Cregiao_uf.php'; ?>
<script>

    var caminho5 = '<?php echo $caminho5 ?>';

    function exibeRegiaoUF (vlr){
         $('#estado_uf_2').load(caminho5 + '?regiao=' + $('#opcao_regiao_2').val());
    }
    
</script>