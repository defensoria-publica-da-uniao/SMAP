<form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
                    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" >Dados gerais</h3>
        </div>
        <div class="panel-body">
            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                    <div class="form-body">
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Nome completo:</label>
                                <input class="form-control spinner" maxlength="100" name="str_nome" value="<?php echo utf8_encode($str_nome); ?>" type="text" placeholder="Nome completo" disabled=""> 
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Login:</label>
                                <input class="form-control spinner" maxlength="40" name="str_login" value="<?php echo utf8_encode($str_login); ?>"  type="text" placeholder="Login" disabled=""> 
                            </div>
                            <div class="form-group col-md-6">
                                <?php echo $oSmap->consulta_nivel_de_acesso_editar($id_perfil);  ?> 
                                <!--
                                <select class="form-control" name="id_perfil">
                                    <option value="1">Administrador</option>
                                    <option value="2">Colaborador</option>
                                    <option value="3">Consultante</option>
                                </select>
                                -->
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;" >
                            <div class="form-group col-md-6">
                                <?php //echo $oSmap->consulta_estatus_editar($int_estatus);  ?> 
                                
                                  <label style="text-align:left !important;" >Status:</label>
                                <select class="form-control" name="int_estatus" required="">
                                    <option value="1" <?php if($int_estatus==1) echo 'selected' ?>>Ativo</option>
                                    <option value="0" <?php if($int_estatus==0) echo 'selected' ?>>Inativo</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        
        <input type="hidden" name="update_usuario" value='360000'/>
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
        <input type="hidden" name="str_nome" value="<?php echo utf8_encode($str_nome) ; ?>" />
        <input type="hidden" name="str_login" value="<?php echo $str_login; ?>" />
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>

</form>
