<?php

require_once 'cSmap.php';

class cSei extends cSmap {
    /*
     * Listando registros sei
     */

    public function selectsei() {
        $data = $this->diminuiDias(4);
        $this->sql = "selectsei '$data' ";
        return $this->query2();
    }

    public function selectsei2() {
        $data = $this->diminuiDias(30);
        $this->sql = "selectsei '$data' ";
        return $this->query();
    }

    /*
     * Listando registros sei
     */

    public function selectseifiltro($AND) {
        $this->sqlSei = " SELECT DISTINCT d.id_documento, p.id_protocolo, p.protocolo_formatado, an.descricao as anotacao, tp.nome as tipo_processo, d.conteudo, 
				a.dth_abertura as dta_despacho, p.dta_geracao as dta_criacao_processo
FROM dbo.documento AS d
INNER JOIN dbo.protocolo AS p ON p.id_protocolo = d.id_procedimento
INNER JOIN dbo.serie AS s ON s.id_serie = d.id_serie
INNER JOIN dbo.atributo_andamento AS aa ON aa.id_origem  = CONVERT(varchar, d.id_documento )
INNER JOIN dbo.atividade AS a ON a.id_atividade = aa.id_atividade
LEFT JOIN dbo.anotacao AS an ON an.id_protocolo = p.id_protocolo
INNER JOIN dbo.procedimento AS pr ON pr.id_procedimento =  p.id_protocolo
INNER JOIN dbo.tipo_procedimento AS tp ON tp.id_tipo_procedimento = pr.id_tipo_procedimento
WHERE d.id_procedimento in (
	 SELECT a.id_protocolo
			FROM atividade a
			WHERE a.id_unidade_origem = '110000863' -- UNIDADE REMETENTE 
			AND a.id_unidade <> '110000863' -- UNIDADE ATUAL 
			AND a.id_tarefa = 32
	)
AND s.nome collate sql_latin1_general_cp1_ci_as like '%Despacho%'
$AND
ORDER BY p.dta_geracao, p.id_protocolo DESC
";
        echo'<pre>';                var_dump($this->sqlSei); exit;
        //return $arDados = mssql_fetch_array($Result);
        return $this->querySei();
    }

    /*
     * Listando registros historico sei
     */

    public function selecthistoricosei($id_protocolo) {
        $this->sql = "selecthistoricosei '$id_protocolo'";
        return $this->query2();
    }

    /*
     * Listando documentos historico sei
     */

    public function selecthistoricodocumento($id_protocolo) {
      $this->sql = "selecthistoricodocumento '$id_protocolo'";
        return $this->query2();
    }

    /*
     * Listando documentos especifico historico sei
     */

    public function selecthistoricodocumento_esp($id_documento) {
   $this->sql = "selecthistoricodocumento_esp '$id_documento'";
        return $this->query2();
    }

    /*
     * Listando unidade sei
     */

    public function selectunidasei() {
        $this->sql = "selectunidasei";
        return $this->query2();
    }

    /*
     * Listando unidade sei
     */

    public function selectunidasei2($sigla_unidade_auto) {
        $this->sql = " selectunidasei2 '$sigla_unidade_auto'";
        return $this->query();
    }

    /*
     * Listando unidade origem do relatorio de demandas
     */

    public function acompanhamento_origem($id_acompanhamento) {
        $this->sql = " acompanhamento_origem '$id_acompanhamento'";
        return $this->query();
    }

    //trata o nome da atividade
    function trataAtividade($nome) {

        $explode = explode("@", $nome);

        for ($i = 0; $i < count($explode); $i++) {
            if (!ctype_upper($explode[$i])) {
                if (!strripos($explode[$i], '_'))
                    @$string = $string . ' ' . $explode[$i];
            }
        }
        return @$string;
    }

    /*
     * Buscando documentos sei
     */

    public function buscaDocumento_sei() {        
       // $data = $this->diminuiDias(30); 
       $data =date('Y-m-d');
       $this->sql = "buscaDocumento_sei '$data'";
        return $this->query2();
        
    }
      /*
     * Buscando documentos sei data especifica
     */

    public function buscaDocumento_sei_esp($data) {        
        
   $this->sql = "buscaDocumento_sei_esp '$data'";
        return $this->query2();
    }
    
    public function busca_id_processos($numero_processo) { 
        $this->sql = "busca_id_processos '$numero_processo' ";
        return $this->query();
    }
    
     public function select_documento_sei($numero_processo) {        
       /* if (!empty($numero_processo) and ( strstr($numero_processo, '/') OR strstr($numero_processo, '.'))) {            
            $result = $this->busca_id_processos($numero_processo);
            if (mssql_num_rows($result) > 0) {
                $arResult = mssql_fetch_assoc($result);
                $numero_processo = $arResult['id_processo_sei'];
            } 
        } */
        // die($numero_processo);
         
        $this->sql = "select_documento_sei '$numero_processo' ";
        return $this->query2();
    }

    public function buscaAtividade_sei($idProtocolo, $dtAssinaturaDocumento) {
       // $data = $this->diminuiDias(30);
       $data =date('Y-m-d');
    $this->sql = "buscaAtividade_sei $idProtocolo,'2019-02-08','$dtAssinaturaDocumento'";
        return $this->query2();
    }
    
        public function buscaAtividade_sei_esp($idProtocolo,$data, $dtAssinaturaDocumento) {
       
    $this->sql = "buscaAtividade_sei_esp $idProtocolo,'$data','$dtAssinaturaDocumento'";
        return $this->query2();
    }

    function SomarData($data, $dias, $meses = 0, $ano = 0) {
        $data = explode(".", $data);
        $newData = date("Y.m.d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano));
        return $newData;
    }

    function buscaDestinoDocumento_sei($idProtocolo, $dtAssinaturaDocumento) {
        $result = $this->buscaAtividade_sei($idProtocolo, $dtAssinaturaDocumento);
        $rows = mssql_num_rows($result);
        if ($rows > 0) {
            return $result;
        } else {
            $dias = 15;
            for ($i = 1; $i <= $dias; $i++) {
                $dtNew = $this->SomarData($dtAssinaturaDocumento, $i);
                $result = $this->buscaAtividade_sei($idProtocolo, $dtNew);
                $rows = mssql_num_rows($result);
                if ($rows > 0) {
                    return $result;
                    exit;
                }
            }
        }
    }
        function buscaDestinoDocumento_sei_esp($idProtocolo,$data ,$dtAssinaturaDocumento) {
        $result = $this->buscaAtividade_sei_esp($idProtocolo, $data,$dtAssinaturaDocumento);
        $rows = mssql_num_rows($result);
        if ($rows > 0) {
            return $result;
        } else {
            $dias = 15;
            for ($i = 1; $i <= $dias; $i++) {
                $dtNew = $this->SomarData($dtAssinaturaDocumento, $i);
                $result = $this->buscaAtividade_sei_esp($idProtocolo,$data, $dtNew);
                $rows = mssql_num_rows($result);
                if ($rows > 0) {
                    return $result;
                    exit;
                }
            }
        }
    }
    
    public function buscaDocumentoCancelado_sei() {
        //$data = $this->diminuiDias(30);
         $data =date('Y-m-d');
       $this->sql = "buscaDocumentoCancelado_sei '$data'";
        return $this->query2();
    }
       public function buscaDocumentoCancelado_sei_esp($data) {
    
       $this->sql = "buscaDocumentoCancelado_sei_esp '$data'";
        return $this->query2();
    }
    
    
  public function ultimo_dado_carga() {
       $this->sql = "ultimo_dado_carga";
        return $this->query2();
    }
}
