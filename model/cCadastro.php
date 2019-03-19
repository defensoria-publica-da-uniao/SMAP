<?php
require_once 'cBanco.php';

class cPessoa extends cBanco{ 
	
	# Paginacao
	public $numReg;
	public $inicial;
	
/*
 * Selecionando dados da pessoa
 */
	
	function dadosPessoaListagem($idPessoa=NULL, $ativo='0', $inicial=null, $numreg=null){
		if($idPessoa > 0) $condicao = " AND p.id_pessoa = {$idPessoa}";
		else $condicao = null;
		
		$this->sql = "
			SELECT 
				p.id_pessoa, p.id_generica_pessoa, p.st_nome_pessoa, 
				po.st_matricula, po.id_unidade,
				d.nr_cpf,
				u.st_unidade
			FROM pessoa as p
			LEFT JOIN pessoa_orgao as po ON po.id_pessoa = p.id_pessoa
			LEFT JOIN documento as d ON d.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN pessoa_unidade as pu ON pu.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN unidade as u ON u.id_unidade = pu.id_unidade
			WHERE p.bo_ativo is null
			{$condicao}
			ORDER BY p.st_nome_pessoa
			LIMIT '{$numreg}' OFFSET '{$inicial}'"; 
		return $this->query();
	}
	
	function qtnPessoas(){
		$this->sql = " SELECT * FROM pessoa"; 
		return $this->query();
	}
	
	function resultTalento($left=null, $and=null, $inicial=null, $numreg=null){ var_dump($inicial); exit;
		$this->sql = "
			SELECT 
				p.id_pessoa, p.id_generica_pessoa, p.st_nome_pessoa, 
				po.st_matricula, po.id_unidade,
				d.nr_cpf,
				u.st_unidade
			FROM pessoa as p
			LEFT JOIN pessoa_orgao as po ON po.id_pessoa = p.id_pessoa
			LEFT JOIN documento as d ON d.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN unidade as u ON u.id_unidade = po.id_unidade
			{$left}
			WHERE p.bo_ativo is null
			{$and}
			ORDER BY p.st_nome_pessoa
			LIMIT '{$numreg}' OFFSET '{$inicial}'"; 
			# var_dump($this->sql); exit;
		return $this->query();
	}
	
	/*
	 * Selecionando dados da pessoa
	 */
	
	function dadosPessoa($idPessoa=NULL, $ativo='0'){
		if($idPessoa > 0) $condicao = " AND p.id_pessoa = {$idPessoa}";
		else $condicao = null;
		
		$this->sql = "
			SELECT 
				p.id_pessoa, p.id_generica_pessoa, p.st_nome_pessoa, p.st_nome_mae, p.id_generica_sexo, p.dt_nascimento, 
				po.id_pessoa_orgao, po.st_nome_pai, po.st_matricula, po.st_email, po.id_generica_estado_civil,
				po.id_generica_tipo_sanguineo, po.id_generica_nacionalidade, po.st_naturalidade, po.st_uf_naturalidade, po.id_generica_raca,
				po.dia_nomeacao, po.dia_aposentadoria, po.grupo_situacao_vinculo, po.situacao_funcional, po.situacao_vinculo, po.reg_jur, po.tempo_servico_apos,
				e.id_endereco, e.nr_cep, e.st_rua, e.nr_numero, e.st_bairro, e.st_cidade, e.st_uf, e.st_complemento, 
				pa.st_login, pa.st_senha, pa.id_pessoa_acesso,
		        d.id_documento, d.nr_rg, d.st_orgao_expedidor_rg, d.st_uf_rg, to_char(d.dt_expedicao_rg, 'DD/MM/YYYY') as dt_expedicao_rg, 
				d.nr_cpf, d.nr_pis_pasep, d.nr_titulo_eleitor, d.st_uf_titulo, d.nr_zona_titulo, d.nr_sessao_titulo, d.nr_cnh, d.uf_cnh, 
				to_char(d.dt_expedicao_titulo, 'DD/MM/YYYY') as dt_expedicao_titulo, d.nr_reservista, d.st_orgao_comprovante_militar, 
				d.st_serie_comprovante_militar, d.nr_passaporte,
				u.id_unidade, u.st_unidade,
				db.id_dados_bancarios, db.uf_resid, db.regiao_resid, db.agencia_bancaria, db.banco, 
				of.id_ocorrencia_afastamento, of.ocor_afastamento, of.ocor_exclusao,of.ocor_fim_afastamento, of.ocor_ingresso, 
				dto.id_data_ocorrencia, dto.dia_ocor_excl_serv, dto.dia_ocor_ingr_orgao, dto.dia_ocor_inic_afast, dto.dia_ocor_fim_afast,
				f.id_funcao, f.atividade_funcao, f.opcao_funcao, f.funcao, f.nivel_funcao, f.escolaridade, f.subnivel_funcao,
				pu.id_pessoa_unidade
			FROM pessoa as p
			LEFT JOIN pessoa_orgao AS po ON po.id_pessoa = p.id_pessoa
			LEFT JOIN endereco AS e ON e.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN pessoa_acesso AS pa ON pa.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN documento AS d ON d.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN pessoa_unidade_ativo as pu ON pu.id_pessoa_orgao = po.id_pessoa_orgao
			LEFT JOIN unidade AS u ON u.id_unidade = pu.id_unidade
			LEFT JOIN dados_bancarios AS db ON db.id_pessoa_orgao = p.id_pessoa
			LEFT JOIN ocorrencia_afastamento AS of ON of.id_pessoa_orgao = p.id_pessoa
			LEFT JOIN data_ocorrencia AS dto ON dto.id_pessoa_orgao = p.id_pessoa
			LEFT JOIN funcao AS f ON f.id_pessoa_orgao = p.id_pessoa
			WHERE p.bo_ativo is null
			{$condicao}
			ORDER BY p.st_nome_pessoa"; 
		return $this->query();
	}
	
	/*
	 * Busca unidade ativa(ativa=1) por id_pessoa
	 */
	
	function buscaUnidadePorPessoa($idPessoa){
		$this->sql = "
			 SELECT u.id_unidade, u.st_unidade 
			  FROM pessoa_unidade AS pu
			  INNER JOIN unidade AS u ON u.id_unidade = pu.id_unidade
			  WHERE pu.id_pessoa_orgao = {$idPessoa}
			  AND pu.bo_ativo = '1'";
		return $this->query();
	}
	
	/*
	 * Seleciona os idiomas de uma pessoa
	 */
	
	function idiomasPessoa($idPessoaOrgao){
		$this->sql = " SELECT i.*, g.st_descricao, im.st_idioma
						FROM idioma as i, generica as g, idioma_mundial as im
						WHERE g.id_generica = inr.";
		$this->query();
	}
	
	/*
	 * Busca nomes de pessoas p/ autoComplete e monta lista de nomes
	 */
	function nomesPessoas(){
		$this->sql = "SELECT id_pessoa, st_nome_pessoa FROM pessoa ORDER BY st_nome_pessoa;";
		return $this->query();
	}
	
	function buscaIdPessoa($strNome){
		$this->sql = " SELECT id_pessoa FROM pessoa WHERE  st_nome_pessoa ILIKE '%$strNome%'  ";
		return $this->query();
	}
	
	/*
	 * Busca pessoa por email para entao alterar a senha
	 */
	function buscaPessoaPorEmail($strEmail){
		$this->sql = " SELECT po.id_pessoa_orgao, po.st_email, p.st_nome_pessoa, pa.id_pessoa_acesso
						FROM pessoa_orgao AS po
						INNER JOIN pessoa_acesso AS pa ON pa.id_pessoa_orgao = po.id_pessoa_orgao
						INNER JOIN pessoa AS p ON p.id_pessoa = po.id_pessoa_orgao
						WHERE  st_email LIKE '%$strEmail%'";
		return $this->query();
	}
	
}

?>