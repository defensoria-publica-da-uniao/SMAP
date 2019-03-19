<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

class cBanco {

    public $sql;
    public $sql2;
    private $conexao;
    private $servidor = B_HOST;
    private $usuario = B_USUARIO;
    private $senha = B_SENHA;
    private $banco = B_BANCO;
    public $arrDataForm;

    function __construct() {

        $this->conexao = mssql_connect("$this->servidor", "$this->usuario", "$this->senha") or die('Nao foi possivel conectar ao banco. Erro = ' . mysql_error());
        mssql_select_db($this->banco) or die("Nao foi possivel selecionar o banco de dados!");

        if (!$this->conexao) {
            echo "Erro ao se conectar no o banco de dados.";
            exit;
        }
    }

    /*
     * Query SQL
     */

    public function query() {
       $rs = mssql_query($this->sql, $this->conexao);
       
       IF($rs==false){
           echo $this->sql;
       }
        return $rs;
    }

    /*
     * Query SQL
     */

    public function query2() {

       $procedure = mssql_init($this->sql, $this->conexao);
       $rs = mssql_execute($procedure);
        IF($rs==false){
           echo $this->sql;
       }
       mssql_free_statement ($procedure);
        //mssql_close($this->conexao);
        return $rs;
        
    }


    /*
     * Conexão com a base de dados do SEI
     */



    /*
     * Fechar conexao
     */

    public function fechaConexao() {
        return mysql_close($this->conexao);
    }

}

?>
