<?php

if (empty($_POST)) {
    $gerencia_usuario = $objSmap->select_usuario();
    $gerencia_usuario2 = $objSmap->select_usuario();

    $ativos = 0;
    $inativos = 0;
    $consultantes = 0;
    $colaboradores = 0;
    $administradores = 0;

    while ($dadosUsuario = mssql_fetch_array($gerencia_usuario2)) {
        if ($dadosUsuario['int_estatus'] == 1) {
            $ativos++;
        } else {
            $inativos++;
        }
        if ($dadosUsuario['id_perfil'] == 1 && $dadosUsuario['int_estatus'] == 1) {
            $administradores++;
        } else if ($dadosUsuario['id_perfil'] == 2 && $dadosUsuario['int_estatus'] == 1) {
            $colaboradores++;
        } else if ($dadosUsuario['id_perfil'] == 3 && $dadosUsuario['int_estatus'] == 1) {
            $consultantes++;
        }
    }
} else {
    // var_dump($_POST);     OU     var_dump($_GET);
    include '../../application/ajax/editar_usuario.php';
}
?>