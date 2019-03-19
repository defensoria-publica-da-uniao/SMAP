<?php
    define('DESKTOP_footer', 'visible-md visible-lg visible-sm hidden-xs');
    define('MOBILE_footer', 'visible-xs hidden-sm hidden-md hidden-lg');
?>

<div class="page-wrapper-row">
    <div class="page-wrapper-bottom">
        <div class="page-footer">
            <div class="container">
                <div class="row" style="color: #fff !important;">
                    <div class="<?php echo DESKTOP_footer ?>">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            &copy;  <script language=javascript type="text/javascript">
                                now = new Date
                                document.write (now.getFullYear())
                            </script> Coordenação de Sistemas - STI - DPU
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12" style="text-align: center !important;">
                            Versão: 2.7.1
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12" style="text-align: right !important;">
                            Unidade Urgente/UND
                        </div>
                    </div>
                    <div class="<?php echo MOBILE_footer ?>">
                        <div class="col-lg-4 col-xs-12 col-sm-12" style="text-align: center !important;">
                            &copy;  <script language=javascript type="text/javascript">
                                now = new Date
                                document.write (now.getFullYear() )
                            </script> Coordenação de Sistemas - STI - DPU
                            <br>
                            Versão: 2.7.1
                            Unidade Urgente/UND
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        
        <div class="scroll-to-top" style="padding-bottom: 12px !important;">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
</div>
