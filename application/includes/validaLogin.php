<?php

require_once 'model/cUsuarios.php';
require_once 'controller/alert.php';
$oUsuario = new cUsuarios();

@session_start();
// seta configurações fusuhorario e tempo limite de inatividade//
date_default_timezone_set("Brazil/East");
$tempolimite = 7200;
//fim das configurações de fusu horario e limite de inatividade//
// aqui ta o seu script de autenticação no momento em que ele for validado você seta as configurações abaixo.//
// seta as configurações de tempo permitido para inatividade//
$_SESSION['registro'] = time(); // armazena o momento em que autenticado //
$_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade //
$_SESSION['ultimo_acesso']= date('d/m/Y H:i:s');
// fim das configurações de tempo inativo//

if (@!$_SESSION['usuario']['ok']) {
    js_alert('Logue no sistema para ter acesso');
    js_go('../login/inicio');
    exit;
} else {
    $buscarAcessos = $oUsuario->buscaAcessoUsuario($_SESSION['usuario']['perfil']);
    $acessos = Array();
    $cont = 0;
    while ($resultadoAcessos = mssql_fetch_array($buscarAcessos)) {

        $acessos[$cont]['modulo'] = $resultadoAcessos['str_modulo'];
        $acessos[$cont]['view'] = $resultadoAcessos['str_view'];
        $acessos[$cont]['visualizar'] = $resultadoAcessos['visualizar'];
        $acessos[$cont]['cadastrar'] = $resultadoAcessos['cadastrar'];
        $acessos[$cont]['alterar'] = $resultadoAcessos['alterar'];
        $acessos[$cont]['excluir'] = $resultadoAcessos['excluir'];
        $cont++;
    }

    for ($i = 0; $i < count($acessos); $i++) {
        if ($modulo == $acessos[$i]['modulo'] && $pagina == $acessos[$i]['view']) {
            $visualizar = $acessos[$i]['visualizar'];
            $cadastrar = $acessos[$i]['cadastrar'];
            $alterar = $acessos[$i]['alterar'];
            $excluir = $acessos[$i]['excluir'];
        }
    }

    if(@$visualizar==0){
            js_alert('Seu perfil não tem acesso a esta página !');
  js_go('../home/index');
    exit;
    }
    
}
?>
