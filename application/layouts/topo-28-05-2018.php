<!--


TOPO deve estar junto com o menu.
Por causa de classes do metronic







<?php
    define('DESKTOP', 'visible-md visible-lg visible-sm hidden-xs');
    define('MOBILE', 'visible-xs hidden-sm hidden-md hidden-lg');
?>

<!-- BEGIN HEADER - ->
<div class="<?php echo DESKTOP ?>">
        <div class="page-header-top" style="background: url(<?php echo IMG; ?>reader-intranet.png); background-repeat: no-repeat; background-position: right top; height: 120px;">
            <div class="container">
                <div class="page-logo">
                    <a href="javascript:;">
                        <img src="<?php echo IMG; ?>logo/logo-desk-escura.png" class="logo-default" height="100" alt="Defensoria Pública da União" >
                    </a>

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -- >
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -- >
                </div>
            </div>
        </div>
</div>
<div class="<?php echo MOBILE ?>">
    <div class="page-header" >
        <a href="javascript:;">
            <img src="<?php echo IMG; ?>logo/logo-mobile-escura.png" style="display: block; margin-left: auto; margin-right: auto;" border="0" height="170" alt="Defensoria Pública da União" >
        </a>

        <!-- BEGIN RESPONSIVE MENU TOGGLER -- >
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -- >

    </div>
</div>

-->