<?php

require_once 'cBanco.php';

class cGeral extends cBanco {
    /*
     * Listando registros
     */

    public function select($tabela, $condicao = null, $order = null) {
       $this->sql = " SELECT * FROM {$tabela}";
        if (!empty($condicao))
            $this->sql .= ' ' . $condicao;
        if (!empty($order))
            $this->sql .= " ORDER BY $order";
        //echo'<pre>';                var_dump($this->sql); exit;
        return $this->query();
    }

    /*
     * Inserindo registros
     */

    public function insert($tabela, $campos, $valores) {
      $this->sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
       // var_dump(  $this->sql);
        return $this->query() OR DIE(mysql_error());
    }
    
    /*
     * Deleta registro de um id especifico
     */

 public function delete($tabela, $campo, $id) {
      $this->sql = " DELETE FROM $tabela WHERE $campo = '$id'";
        //var_dump(  $this->sql); exit;
        return $this->query();
    }
    
    /*
     * Deleta registro de um id especifico
     */

    public function updateUniSec($tabela, $status, $id) {
        (($status == 'A') ? $situacao = 'D' : $situacao = 'A');
        $campo = str_replace ('tb_','',$tabela);
        $this->sql = " UPDATE $tabela SET str_situacao = '{$situacao}' WHERE id_{$campo} = '$id'";
        return $this->query();
    }

    /*
     * Update
     */

    public function update($tabela, $campos, $condicao, $resucondicao) {
        $this->sql = "UPDATE $tabela SET $campos WHERE $condicao = $resucondicao";
        //var_dump($this->sql);
        return $this->query() OR DIE(mysql_error());
    }
    
      /*
     * Inserindo registros de dados temporários
     */

    public function insert_dados_temp($d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11) {
     $this->sql = "insert_dados_temp $d1,$d2,'$d3','$d4','$d5','$d6','$d7','$d8',$d9,'$d10','$d11'";
        return $this->query2();
    }
    
     /*
     * Deletando dados temporários
     */
    
    public function delete_dados_ultima_carga() {
     $this->sql = "delete_dados_ultima_carga";
        return $this->query2();
    }
    
    public function select_acompanhamento_especifico($parametro1,$parametro2){
        $this->sql = "select_acompanhamento_especifico $parametro1,'$parametro2'";

        return $this->query();
    }


    function redirect($msg, $url) {
        $_SESSION['MSG'] = $msg;
        $URL = RAIZ . $url;
        header("location: $URL");
    }

    function redirect2($url, $param1, $param2) {

        $URL = CONTROLLER . $url;
        header("location: $URL");
        $_SESSION['param1'] = $param1;
        $_SESSION['param2'] = $param2;
    }
    
      function redirectx($url) {
      
        header("location: $url");
    }
    
    function calculaTempo($hora_inicial, $hora_final) {
$i = 1;
$tempo_total;

$tempos = array($hora_final, $hora_inicial);

foreach($tempos as $tempo) {
$segundos = 0;

list($h, $m, $s) = explode(':', $tempo);

$segundos += $h * 3600;
$segundos += $m * 60;
$segundos += $s;

$tempo_total[$i] = $segundos;

$i++;
}
$segundos = $tempo_total[1] - $tempo_total[2];

$horas = floor($segundos / 3600);
$segundos -= $horas * 3600;
$minutos = str_pad((floor($segundos / 60)), 2, '0', STR_PAD_LEFT);
$segundos -= $minutos * 60;
$segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);

return "$horas:$minutos:$segundos";
}

 
      /*
     * Buscando modulo
     */

    public function modulo($modulo) {
        $this->sql = "Select * from gr_modulo where str_modulo = '$modulo' ";
       // var_dump(  $this->sql);
        return $this->query(); 
    }
    
      /*
     * Buscando view
     */

    public function view($view,$idmodulo) {
        $this->sql = "Select * from gr_view where str_view = '$view' AND id_modulo='$idmodulo' ";
       // var_dump(  $this->sql);
        return $this->query(); 
    }

}

?>