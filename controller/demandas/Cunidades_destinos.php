<?php

require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';
require_once '../' . MODELS . 'cSmap.php';
$oSmap = new cSmap();

$idunidades_destinos = $_GET['opcao'];

if ($idunidades_destinos == 'DPU') {
    $result = $oSmap->consultacombo('tb_unidade_sgrh_destino', 'id_unidade_sgrh_destino');
    while ($row = mysql_fetch_array($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['str_sigla'] . "</option>";
    }
    echo "<option value='" . $row['id'] . "'>OPA DPU</option>";
} else if ($idunidades_destinos == 'DPGU') {
            echo "<option value='" . $row['id'] . "'>OPA DPGU</option>";

}


//echo "<option value='".$row['id']."'>".$idunidades_destinos."</option>";
?>
