<script>
    function abrir(link) {
        window.open(link, '_blank');
    }
   

</script>    

<?php

    require_once INCLUDES . 'validaLogin.php';
    
ini_set('max_execution_time', 864000);
ini_set('mssql.timeout', 864000);
ini_set('memory_limit', '3024M');



//referenciar o DomPDF com namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// include autoloader
require_once("controller/dompdf/autoload.inc.php");



$options = new Options();
$options -> set ( 'isRemoteEnabled' , TRUE );
$dompdf = new DOMPDF($options);
$contxt  = stream_context_create ([
    'ssl'  => [
        'verify_peer'  => FALSE ,
        'verify_peer_name'  => FALSE ,
        'allow_self_signed' => TRUE
    ] 
]);
$dompdf -> setHttpContext ( $contxt );


//Recebendo a variavel html e o tipo de relatorio
$html = str_replace('?', '', $_POST['html_final']);
$tipo_relatorio = $_POST['tipo'];
//Recebendo variavel para email
$_SESSION['destinatario'] = $_POST['email'];
$_SESSION['assunto'] = $_POST['assunto'];
$_SESSION['corpoEmail'] = $_POST['corpo_email'];
$_SESSION['tipo'] = $_POST['tipo'];


if ( $_FILES['anexo']["error"] != 4) {
    $total = count($_FILES['anexo']['name']);
    for ($i = 0; $i < $total; $i++) {
        $uploaddir = 'public/anexos/';
        $uploadfile = $uploaddir . $_FILES['anexo']['name'][$i];
        $caminho_anexos[] = $uploadfile;
        move_uploaded_file($_FILES['anexo']['tmp_name'][$i], $uploadfile);
    }
    $_SESSION['caminho_anexos'] = $caminho_anexos;
}

// Carrega seu HTML
$dompdf->load_html($html);

$dompdf->setPaper('A4', 'landscape');


//Renderizar o html
$dompdf->render();

/* 	
  //Exibibir a página
  $dompdf->stream(
  "relatorio_celke.pdf",
  array(
  "Attachment" => true //Para realizar o download somente alterar para true
  )
  );
 */

$pdf = $dompdf->output(); // Cria o pdf


$caminho = 'public/pdf/' . $tipo_relatorio . '.pdf';
//Guardando o caminho para o email pegar
$_SESSION['caminho'] = $caminho;



if (file_put_contents($caminho, $pdf)) { //Tenta salvar o pdf gerado
   // js_alert('Email enviado');
    js_go(CONTROLLER . 'email/EnviaEmail.php');
    return true; // Salvo com sucesso.
} else {
 js_alert('Erro no envio do Email');
    return false; // Erro ao salvar o arquivo
}

?>




