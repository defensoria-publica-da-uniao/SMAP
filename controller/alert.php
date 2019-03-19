

<?php


function js_alert($mensagem) {
	print "<script language=javascript> alert('".$mensagem."');</script>";
	//return $function_ret;
}  
function js_go($pagina){
	print "<script language=javascript>self.location.href='$pagina';</script>";
}

function js_junto ($mensagem,$pagina){
    	print "<script language=javascript> alert('".$mensagem."');</script>";
	print "<script language=javascript>self.location.href='$pagina';</script>";
}


?>