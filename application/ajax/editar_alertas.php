<form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" >Dados gerais</h3>
            </div>
            <div class="panel-body">
                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                    <div class="col-md-12">

                        <div class="form-body">
                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <div class="form-group col-md-12">
                                    <label style="text-align:left !important;" >Escolha o tipo do Processo que vai gerar o Alerta:</label>
                                    <input type="text" name="nome" value="<?php echo utf8_encode($str_nome_tipo); ?>" class="form-control" maxlength="255" placeholder="Tipo do Processo" required=""> 
                                </div>
                            </div>
                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <div class="form-group col-md-12">
                                    <label style="text-align:left !important;" >Escolha o icone:</label>
                                    <br>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone1" value="fa fa-gavel" required="" <?php echo @$situ1; ?>> <i class="fa fa-gavel"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone2" value="fa fa-exclamation-circle" <?php echo @$situ2; ?>> <i class="fa fa-exclamation-circle"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone3" value="fa fa-contao" <?php echo @$situ3; ?>> <i class="fa fa-contao"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone4" value="fa fa-industry" <?php echo @$situ4; ?>> <i class="fa fa-industry"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone5" value="fa fa-diamond" <?php echo @$situ5; ?>> <i class="fa fa-diamond"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone6" value="fa fa-graduation-cap" <?php echo @$situ6; ?>> <i class="fa fa-graduation-cap"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone7" value="fa fa-calendar-plus-o" <?php echo @$situ7; ?>> <i class="fa fa-calendar-plus-o"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone8" value="fa fa-heart" <?php echo @$situ8; ?>> <i class="fa fa-heart"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone9" value="fa fa-commenting" <?php echo @$situ9; ?>> <i class="fa fa-commenting"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone10" value="fa fa-fire-extinguisher" <?php echo @$situ10; ?>> <i class="fa fa-fire-extinguisher"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone11" value="fa fa-get-pocket" <?php echo @$situ11; ?>> <i class="fa fa-get-pocket"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone12" value="fa fa-gg" <?php echo @$situ12; ?>> <i class="fa fa-gg"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone13" value="fa fa-home" <?php echo @$situ13; ?>> <i class="fa fa-home"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone14" value="fa fa-picture-o" <?php echo @$situ14; ?>> <i class="fa fa-picture-o"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone15" value="fa fa-hourglass" <?php echo @$situ15; ?>> <i class="fa fa-hourglass"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone16" value="fa fa-cutlery" <?php echo @$situ16; ?>> <i class="fa fa-cutlery"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone17" value="fa fa-mouse-pointer" <?php echo @$situ17; ?>> <i class="fa fa-mouse-pointer"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone18" value="fa fa-dollar" <?php echo @$situ18; ?>> <i class="fa fa-dollar"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone19" value="fa fa-map" <?php echo @$situ19; ?>> <i class="fa fa-map"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone20" value="fa fa-map-pin" <?php echo @$situ20; ?>> <i class="fa fa-map-pin"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone21" value="fa fa-phone-square" <?php echo @$situ21; ?>> <i class="fa fa-phone-square"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone22" value="fa fa-plane" <?php echo @$situ22; ?>> <i class="fa fa-plane"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone23" value="fa fa-plug" <?php echo @$situ23; ?>> <i class="fa fa-plug"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone24" value="fa fa-share-alt" <?php echo @$situ24; ?>> <i class="fa fa-share-alt"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone25" value="fa fa-university" <?php echo @$situ25; ?>> <i class="fa fa-university"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone26" value="fa fa-unlock" <?php echo @$situ26; ?>> <i class="fa fa-unlock"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone27" value="fa fa-trophy" <?php echo @$situ27; ?>> <i class="fa fa-trophy"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone28" value="fa fa-tree" <?php echo @$situ28; ?>> <i class="fa fa-tree"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone29" value="fa fa-thumbs-up" <?php echo @$situ29; ?>> <i class="fa fa-thumbs-up"></i>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="icone" id="icone30" value="fa fa-refresh" <?php echo @$situ30; ?>> <i class="fa fa-refresh"></i>
                                                <span></span>
                                            </label>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
    
    
        <div class="modal-footer">
            <input type="hidden" name="update_alertas" value='100000'/>
            <input type="hidden" name="id_alertas" value="<?php echo $id_alertas; ?>" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    

</form>

