<?php

    if (empty($_POST)) {
        $dpgu = $objSmap->select_consultacombo_DPGU(1);
        $dpu = $objSmap->select_consultacombo_DPU(1);
    } else {
        include '../../application/ajax/editar_destino_dpu_dpgu.php';
    }

?>