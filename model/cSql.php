<?php
require_once 'cBanco.php';

class cSql extends cBanco{

	public function ListaUF(){
		$this->sql = " SELECT DISTINCT uf FROM escola ORDER BY uf";
		return $this->query();
	}
	
	public function ListaEscola($idEscola=null){
		(($idEscola != null) ? $WHERE = "WHERE id_escola = {$idEscola}" : $WHERE=null);
		$this->sql = " SELECT * FROM escola {$WHERE} ORDER BY escola ";
		return $this->query();
	}
	
	public function ListaInscricoes($idEscola=null){
		(($idEscola != null) ? $WHERE = "WHERE i.id_escola = {$idEscola}" : $WHERE=null);
		$this->sql = " 
			SELECT i.*, e.escola,  ca.descricao AS categoria
			FROM inscricoes AS i
			INNER JOIN escola AS e ON e.id_escola = i.id_escola
			INNER JOIN categoria AS ca ON ca.id_categoria = i.id_categoria
			$WHERE";			
		return $this->query();
	}
	
	public function DeletaInscricoes($idEscola){
		$this->sql = " DELETE FROM inscricoes WHERE id_escola = '{$idEscola}'";
		return $this->query();
	}
	
}

?>
