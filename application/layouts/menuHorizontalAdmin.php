<?php
    define('DESKTOP', 'visible-md visible-lg visible-xl hidden-xs hidden-sm');
    define('MOBILE', 'visible-xs visible-sm hidden-md hidden-lg hidden-xl');
    require_once 'controller/administrador/Cadm_duplicados.php';
?>

<div class="page-wrapper-row">
    <div class="page-wrapper-top">
        <div class="page-header" >
            
            <div class="<?php echo DESKTOP ?>">
                <div class="page-header-top" style="background: url(<?php echo IMG; ?>reader-intranet.png); background-repeat: no-repeat; background-position: right top; height: 120px;">
                    <div class="container">
                        <div class="page-logo">
                            <a href="<?php echo RAIZ . "home/index"; ?>">
                                <img src="<?php echo IMG; ?>logo/logo-desk-escura.png" class="logo-default" height="100" alt="Defensoria Pública da União" >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="<?php echo MOBILE ?>">
                <a href="<?php echo RAIZ . "home/index"; ?>">
                    <img src="<?php echo IMG; ?>logo/logo-mobile-escura.png" style="display: block; margin-left: auto; margin-right: auto;" border="0" height="170" alt="Defensoria Pública da União" >
                </a>
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"> 
                        <img class="menu-espaco" src="<?php echo IMG; ?>menu-toggler.png" align="right" style="padding-right: 20px; padding-bottom: 10px; padding-top: 10px;">
                    </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
            </div>
            
            <div class="<?php echo DESKTOP ?>">
                <div class="page-header-menu">
                    <div class="container">

                        <div class="hor-menu" >
                            <ul class="nav navbar-nav"> 
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="<?php echo RAIZ . "home/index"; ?>"><i class="glyphicon glyphicon-indent-left"></i> Painel </a>
                                </li>

                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="<?php echo RAIZ . "demandas/selecao"; ?>"><i class="glyphicon glyphicon-equalizer"></i> Demandas                                    
                                    </a>             
                                </li>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;"><i class="glyphicon glyphicon-list-alt"></i> Relatórios
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_demandas"; ?>" ><i class="glyphicon glyphicon-th"></i> Por Demanda</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_pendencias"; ?>" ><i class="glyphicon glyphicon-th-large"></i> Por Pendências</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_geral"; ?>" ><i class="glyphicon glyphicon-stop"></i> Geral</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> 
                        </div>
                        <div class="hor-menu"  style="float:right !important;" >
                            <ul  class="nav navbar-nav navbar-right">
                                
                                <?php if ($_SESSION['usuario']['perfil']==1){ ?>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;">
                                        
                                        <i class="glyphicon glyphicon-cog"></i> Área Adm
                                        <?php if($duplicados_total<>0){ ?>
                                          <span class="badge badge-danger"><?php echo $duplicados_total; ?></span>
                                        <?php }?>
                                        <i class="fa fa-caret-down"></i>
                                        
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/gerencia_usuarios"; ?>" class="nav-link"><i class="glyphicon glyphicon-user"></i> Administrar Usuários</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/auditoria"; ?>"><i class="glyphicon glyphicon-eye-open"></i> Auditoria</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/unidade_dpu_dpgu"; ?>"><i class="glyphicon glyphicon-tags"></i> Unidade DPU / Secretaria DPGU</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/gerencia_alertas"; ?>"><i class="glyphicon glyphicon-bell"></i> Gerenciamento de Alertas</a>
                                        </li>
                                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                                            <a href="<?php echo RAIZ . "administrador/confirmar_remocao"; ?>" >
                                                <i class="glyphicon glyphicon-tags"></i> Processos Duplicados
                                                <span class="badge badge-danger"><?php echo $duplicados_total; ?></span>
                                            </a>
                                        </li>
                                         <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/correcaoEstatusDocumento"; ?>"><i class="glyphicon glyphicon-pencil"></i> Correçõs de Bug's</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php $nome = explode(".", @$_SESSION['usuario']['login']); ?>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;">
                                        Bem-vindo(a) <?php echo $_SESSION['usuario']['str_perfil'].' '.ucfirst( $nome[0]) . ' ' . $nome[1]; ?>
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "home/tutorial"; ?>" class="nav-link"><i class="icon-question"></i> Manual do SMAP</a>
                                        </li>
                                    </ul>
                                </li>

                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="<?php echo CONTROLLER . 'login.php' ?>"><i class="glyphicon glyphicon-log-out"></i> Sair </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="<?php echo MOBILE ?>">
                
                <div class="page-header-menu">
                    <div class="container">

                        <div class="hor-menu" >
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="<?php echo RAIZ . "home/index"; ?>"><i class="glyphicon glyphicon-indent-left"></i> Painel </a>
                                </li>

                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;"><i class="glyphicon glyphicon-equalizer"></i> Demandas
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "demandas/selecao"; ?>" ><i class="glyphicon glyphicon-import"></i> Demandas do SEI</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "demandas/selecao_filtro"; ?>"  >
                                                <i class="glyphicon glyphicon-saved"></i> Demandas do SMAP
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;"><i class="glyphicon glyphicon-list-alt"></i> Relatórios
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_demandas"; ?>" ><i class="glyphicon glyphicon-th"></i> Por Demanda</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_pendencias"; ?>" ><i class="glyphicon glyphicon-th-large"></i> Por Pendências</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "relatorios/rel_geral"; ?>" ><i class="glyphicon glyphicon-stop"></i> Geral</a>
                                        </li>
                                    </ul>
                                </li>
                                        <?php if ($_SESSION['usuario']['perfil']==1){ ?>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;">
                                        <i class="glyphicon glyphicon-cog"></i> Área Adm
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/gerencia_usuarios"; ?>" class="nav-link"><i class="glyphicon glyphicon-user"></i> Administrar Usuários</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/auditoria"; ?>"><i class="glyphicon glyphicon-eye-open"></i> Auditoria</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/unidade_dpu_dpgu"; ?>"><i class="glyphicon glyphicon-tags"></i> Unidade DPU / Secretaria DPGU</a>
                                        </li>
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/gerencia_alertas"; ?>"><i class="glyphicon glyphicon-bell"></i> Gerenciamento de Alertas</a>
                                        </li>
                                         <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "administrador/correcaoEstatusDocumento"; ?>"><i class="glyphicon glyphicon-pencil"></i> Correções de Bug's</a>
                                        </li>
                                    </ul>
                                </li>

                                        <?php }$nome = explode(".", @$_SESSION['usuario']['login']); ?>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="javascript:;">
                                        Bem-vindo(a) <?php echo ucfirst($nome[0]) . ' ' . $nome[1]; ?>
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true" class="">
                                            <a href="<?php echo RAIZ . "home/tutorial"; ?>" class="nav-link"><i class="icon-question"></i> Manual do SMAP</a>
                                        </li>
                                    </ul>
                                </li>

                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                    <a href="<?php echo CONTROLLER . 'login.php' ?>"><i class="glyphicon glyphicon-log-out"></i> Sair </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
