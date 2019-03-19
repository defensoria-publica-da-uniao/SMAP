<?php

    if (empty($_POST)) {
        $alertas = $objSmap->select_alertas();
    } else {
        // var_dump($_POST);     OU     var_dump($_GET);
        include '../../application/ajax/editar_alertas.php';
    }

?>