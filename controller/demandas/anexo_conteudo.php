<?php 
require_once 'anexo.php';
?>

<style>
    .main iframe {
    border: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
    
</style>
<div class="main">
<iframe src="<?php echo $destino; ?>" ></iframe>
</div>

