<?php


$consulta=$objGeral->select('tb_historico_acompanhamento');

while($dados= mssql_fetch_array($consulta)){

   $resumo=$dados['str_resumo'];
   $id=$dados['id_historico_acompanhamento'];
     
    if(preg_match('!!u',$resumo)){
        if($resumo<>'Cadastro automatico de processos Sei para SMAP') {
        echo $id;
        echo '-';
        $resumo= utf8_decode($resumo);
         $resumo=str_replace('"', '', $resumo);
        $resumo=str_replace("'", '', $resumo);
          $resumo=str_replace("?", '', $resumo);
         echo $resumo;
        echo $x++;
          echo '<br>';
          
  $objGeral->update('tb_historico_acompanhamento',"str_resumo='$resumo'",'id_historico_acompanhamento',"$id");
        }

    }
     
   /*
    echo $id;
        echo '-';
        echo utf8_encode($resumo);
    * 
    */
        
  
    
}
