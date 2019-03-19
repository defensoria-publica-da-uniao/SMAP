<?php

//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader
//require_once("dompdf/autoload.inc.php");

//Criando a Instancia
$dompdf = new DOMPDF();

$html=$_POST['html'];
// Carrega seu HTML
$dompdf->load_html($html);

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


$_SESSION['pdf']=$pdf;

$caminho='public/pdf/pdf2.pdf';

if (file_put_contents($caminho, $pdf)) { //Tenta salvar o pdf gerado
    echo'certo';
    //js_go(CONTROLLER . 'email/EnviaEmail');
    return true; // Salvo com sucesso.
} else {
  echo'errado';
    return false; // Erro ao salvar o arquivo
}
?>