<?php

$id_documento = $p1;

$pegardado = $objSei->selecthistoricodocumento_esp($id_documento);
$contagem = mssql_num_rows($pegardado);

$result = mssql_fetch_array($pegardado);




$data=$result['data_abertura'];

//Dados para pdf
$dt_ex = explode('/', $data);
 $data_explode = "$dt_ex[2]/$dt_ex[1]/$dt_ex[0]/";


$id_anexo_sei = $result['id_anexo'];

$link = ANEXO.$data_explode . $id_anexo_sei;
$_SESSION['link']=$link;
 $caminho=CONTROLLER.'demandas/anexo_conteudo.php';



?>

