<?php

require_once 'cBanco.php';

class cSmap extends cBanco {
    /*
     * Diminuir Dias
     */

    function diminuiDias($dias) {
        $data = date("Y-m-d");
        $data = explode("-", $data);
        $nova_data = mktime(0, 0, 0, $data[1], $data[2] - $dias, $data[0]);
        return strftime("%Y-%m-%d", $nova_data);
    }

    /*
     * Listando registros do historico fixo
     */

    public function selecthist($id) {
        $this->sql = "selecthist $id ";
        return $this->query2();
    }

    /*
     * Listando registros com join especifico
     */

    public function selectjoin($status) {
        $this->sql = "selectjoin $status ";
        return $this->query2();
    }

    /*
     * Listando registros com join especifico com parametros especificos
     */

    public function selectjoin2($id_acompanhamento, $id_documento) {
      $this->sql = "selectjoin2 $id_acompanhamento,$id_documento";
        return $this->query2();
    }

    public function selectjoin3($status = null, $dt_despacho_inicial, $dt_despacho_final) {
        $this->sql = "selectjoin3 $status,'$dt_despacho_inicial','$dt_despacho_final' ";
        return $this->query2();
    }

    /*
     * Listando registros com campo especifico
     */

    public function selectcamp($camp, $tabela, $condicao = null, $order = null) {
        $this->sql = " SELECT $camp FROM {$tabela}";

        if (!empty($condicao))
            $this->sql .= ' ' . $condicao;
        if (!empty($order))
            $this->sql .= " ORDER BY $order";
//echo'<pre>';                var_dump($this->sql); exit;

        return $this->query();
    }

    /*
     * Listando registros com campo especifico
     */

    public function selectcampgrafico($situacao, $dias) {
        $dataverificar = $this->diminuiDias($dias);

        $this->sql = "selectcampgrafico $situacao,'$dataverificar'";
        return $this->query2();
    }

    /*
     * Listando registros com campo especifico
     */

    public function selectcamp2($id_documento, $destino_sei) {
        echo$this->sql = "selectcamp2 $id_documento,'$destino_sei'";
        return $this->query2();
    }

    /*
     * Listando relatorio de demandas
     */

    public function selectrel_demandas($dt_ini, $dt_fin, $situ1, $situ2) {
        $this->sql = "selectrel_demandas  '$dt_ini', '$dt_fin', $situ1, $situ2";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de demandas das unidades
     */

    public function selectrel_demandas_unidades_id($id_secretaria, $dt_ini, $dt_fin, $situ1, $situ2) {
        $this->sql = "selectrel_demandas_unidades_id '$id_secretaria', '$dt_ini','$dt_fin',$situ1,$situ2";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de demandas das secretarias 
     */

    public function selectrel_demandas_secretaria_id($id_secretaria, $dt_ini, $dt_fin, $situ1, $situ2) {
        $this->sql = "selectrel_demandas_secretaria_id '$id_secretaria', '$dt_ini','$dt_fin',$situ1,$situ2";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de pendencias das secretarias 
     */

    public function selectrel_pendencias_secretaria_id($id_secretaria, $periodo) {
        $this->sql = "selectrel_pendencias_secretaria_id '$id_secretaria', '$periodo'";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de pendencias das secretarias 
     */

    public function selectrel_pendencias_secretaria_id2($id_secretaria, $periodo, $periodo2) {
        $this->sql = "selectrel_pendencias_secretaria_id2 '$id_secretaria', '$periodo', '$periodo2'";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de pendencias das secretarias 
     */

    public function selectrel_pendencias_unidades_id($id_secretaria, $periodo) {
        $this->sql = "selectrel_pendencias_unidades_id '$id_secretaria', '$periodo'";
        return $this->query2();
    }

    /*
     * Listando id dos relatorios de pendencias das secretarias 
     */

    public function selectrel_pendencias_unidades_id2($id_secretaria, $periodo, $periodo2) {
        $this->sql = "selectrel_pendencias_unidades_id2 '$id_secretaria', '$periodo', '$periodo2'";
        return $this->query2();
    }

    /*
     * Listando os relatorios de pendencias 
     */

    public function selectrel_pendencias($id_acompanhamento) {
        $this->sql = "selectrel_pendencias '$id_acompanhamento'";
        return $this->query();
    }

    /*
     * Listando relatorio de pendencias para alerta 60 dias
     */

    public function selectrel_pendencias_alerta_pendencia($periodo) {
        $this->sql = "selectrel_pendencias_alerta_pendencia '$periodo'";

        //echo'<pre>';                var_dump($this->sql); 
        return $this->query();
    }

    /*
     * Listando relatorio de pendencias para alerta de 15 e 30 dias 
     */

    public function selectrel_pendencias_alerta_pendencia_periodo($periodo1, $periodo2) {
        $this->sql = "selectrel_pendencias_alerta_pendencia_periodo '$periodo1', '$periodo2'";

        //echo'<pre>';                var_dump($this->sql);
        return $this->query();
    }

    /*
     * Listando relatorio de pendencias para alerta
     */

    public function selectrel_pendencias_alerta_tipos($tipo) {
        $this->sql = "selectrel_pendencias_alerta_tipos '$tipo'";
        return $this->query();
    }

    /*
     * Listando rdespachos com dt de prazo
     */

    public function select_dt_prazo() {
        $this->sql = "select_dt_prazo ";

        //echo'<pre>';                var_dump($this->sql); 
        return $this->query();
    }

    /*
     * Listando unidade  relatorio geral
     */

    public function selectrel_geral_DPGU($dt_ini, $dt_fin) {
        $this->sql = "selectrel_geral_DPGU  '$dt_ini', '$dt_fin'";
        return $this->query2();
    }
        /*
     * Listando unidade  relatorio geral por regiao
     */

    public function selectrel_geral_DPU_regiao($dt_ini, $dt_fin,$regiao) {
        $this->sql = "selectrel_geral_DPU_regiao  '$dt_ini', '$dt_fin','$regiao'";
        return $this->query2();
    }

    /*
     * Listando unidade  relatorio geral 
     */

    public function selectrel_geral_DPU($dt_ini, $dt_fin) {
        $this->sql = "selectrel_geral_DPU '$dt_ini', '$dt_fin'";
        return $this->query2();
    }

    /*
     * Listando unidade  relatorio geral DPGU TODOS
     */

    public function selectrel_geral_todos($dt_ini, $dt_fin) {
        $this->sql = " 
 select * from tb_acompanhamento as ta
INNER JOIN tb_unidade as tu ON ta.id_unidade = tu.id_unidade
INNER JOIN  tb_documento as tdoc ON ta.id_documento = tdoc.id_documento
WHERE tdoc.dt_despacho BETWEEN '$dt_ini' AND '$dt_fin'";
        //echo'<pre>';                var_dump($Sql);

        return $this->query(); // or die('Ocorreu o erro: ' . mysql_error());
        //return $arDados = mssql_fetch_array($Result);
        // mssql_close();
    }

    /*
     * Listando unidade  relatorio geral DPGU TODOS + 1 unidade
     */

    public function selectrel_geral_todos_espec($sigla, $dt_ini, $dt_fin) {
        $this->sql = " 
 select * from tb_acompanhamento as ta
INNER JOIN tb_unidade as tu ON ta.id_unidade = tu.id_unidade
INNER JOIN  tb_documento as tdoc ON ta.id_documento = tdoc.id_documento
WHERE tu.str_sigla_uni like '%AFC DPGU%' 
OR tu.str_sigla_uni like '%CMAP DPGU%'
OR tu.str_sigla_uni like '%CSEG DPGU%'
OR tu.str_sigla_uni like '%SGC DPGU%'
OR tu.str_sigla_uni like '%SGP DPGU%'
OR tu.str_sigla_uni like '%CGPL DPGU%'
OR tu.str_sigla_uni like '%SLP DPGU%'
OR tu.str_sigla_uni like '%CCOT DPGU%'
OR tu.str_sigla_uni like '%ASERG DPGU%'
OR tu.str_sigla_uni like '%CEAM DPGU%'
OR tu.str_sigla_uni like '%SOF DPGU%'
OR tu.str_sigla_uni like '%SEDIP DPGU%'
OR tu.str_sigla_uni like '%SEOF DPGU%'
OR tu.str_sigla_uni like '%STI DPGU%'
OR tu.str_sigla_uni like '%SAJ DPGU%'
OR tu.str_sigla_uni like '%SGE DPGU%'
OR tu.str_sigla_uni like '%$sigla%' 
AND tdoc.dt_despacho BETWEEN '$dt_ini' AND '$dt_fin'";
        //echo'<pre>';                var_dump($Sql);

        return $consulta = $this->query(); // or die('Ocorreu o erro: ' . mysql_error());
        //return $arDados = mssql_fetch_array($Result);
        // mssql_close();
    }

    /*
     * Listando unidade  relatorio geral DPGU TODOS + 1 unidade
     */

    public function select_demandas_dpgu($situacao, $dias) {
        $dataverificar = $this->diminuiDias($dias);

        $this->sql = "select_demandas_dpgu $situacao,'$dataverificar'";
        return $this->query2();
    }

    /*
     * Listando despachos abertos
     */

    public function select_demandas_geral($situacao, $dias) {
       $dataverificar = $this->diminuiDias($dias);
        $this->sql = "select_demandas_geral $situacao,'$dataverificar'";
        return $this->query2();
    }

    /*
     * Listando registros da tabela auditoria
     */

    public function select_auditoria() {

        $this->sql = "select_auditoria";
        return $this->query();
    }
    
     public function select_auditoria2() {

        $this->sql = "select_auditoria2";
        return $this->query();
    }

    /*
     * Listando registros com campo especifico
     */

    public function select_damandas_unidades2($int_situ, $dias) {
        $dataverificar = $this->diminuiDias($dias);
        $this->sql = "select_damandas_unidades2 $int_situ,'$dataverificar'";
        return $this->query();
    }

    /*
     * Selecionar Option
     */

    function consultacombo($tabela, $nomecampo) {

//Selecione tudo de nomedatabela em ordem crescente pelo nome 
        $this->sql = "SELECT * FROM " . $tabela;
        $consulta = $this->query();
//Fazendo o looping para exibição de todos registros que contiverem em nomedatabela
        print "<SELECT NAME=\"$nomecampo\"  class=form-control required>";
        $vazio = 0;
        while ($dados = mssql_fetch_array($consulta)) {
            /*
              if ($vazio == 0) {
              print("<option value=''>Selecione o Destino</option>");
              $vazio = 1;
              }
             * 
             */
            print("<option value='" . $dados['id_unidade_sgrh_destino'] . "'>" . utf8_encode($dados['str_sigla']) . "</option>");
        }

        print "</SELECT>";

        //return $this->query();
    }

    /*
     * Select Secretarias DPGU
     */

    function select_consultacombo_DPGU($listagem) {
        $this->sql = "consultacombo_DPGU $listagem";
        return $this->query();
    }

    /*
     * Select Unidades DPGU
     */

    function select_consultacombo_DPU($listagem) {

        $this->sql = "consultacombo_DPU $listagem";
        return $this->query();
    }

    /*
     * Selecionar os ESTADOS por Região
     */

    function consultacombo_estados($regiao) {

        $this->sql = "consultacombo_estados '$regiao'";
        $consulta = $this->query();

        // SAMUEL SAMUEL SAMUEL SAMUEL SAMUEL eu substituir no <select name> o campo $nomecampo pelo $regiao vai prejudicar?????

        print "<label style='text-align:left !important;' >Unidade federativa:</label>";
        print "<SELECT NAME=id_unidade class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . $dados['id_estado'] . "'>" . $dados['str_uf'] . "</option>");
        }

        print "</SELECT>";

        //return $this->query();
    }

    /*
     * Selecionar  DPGU
     */

    function consultacombo_DPGU($nomecampo, $listagem=0) {

        $this->sql = "consultacombo_DPGU $listagem";
        $consulta = $this->query();

        print "<SELECT NAME=\"$nomecampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . $dados['id_secretaria'] . "'>" . utf8_encode($dados['str_sigla']) . ' - ' . utf8_encode($dados['str_descricao']) . "</option>");
        }

        print "</SELECT>";

        //return $this->query();
    } 

    /*
     * Selecionar DPU
     */

    function consultacombo_DPU($nomecampo, $listagem=null) {

        $this->sql = "consultacombo_DPU $listagem";
        $consulta = $this->query();

        print "<SELECT NAME=\"$nomecampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . $dados['id_unidade'] . "'>" . $dados['str_uf'] . ' - ' . utf8_encode($dados['str_descricao']) . "</option>");
        }

        print "</SELECT>";

        //return $this->query();
    }

    function consultacombo_DPU_email($nomecampo,$listagem=0) {

        $this->sql = "consultacombo_DPU $listagem";
        $consulta = $this->query();

        print "<label style='text-align:left !important;' >Setor e seu e-mail</label>";
        print "<div class='input-group'>";
        print "<span class='input-group-addon'><i class='fa fa-envelope'></i></span>";
        print "<SELECT NAME=\"$nomecampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . $dados['str_email'] . "'>" . $dados['str_uf'] . ' - ' . utf8_encode($dados['str_descricao']) . ' --- ( ' . utf8_encode($dados['str_email']) . ' ) ' . "</option>");
        }
        print "</SELECT>";
        print "</div>";
        //return $this->query();
    }

    function consultacombo_DPGU_email($nomecampo, $listagem=0) {

        $this->sql = "consultacombo_DPGU $listagem";
        $consulta = $this->query();


        print "<label style='text-align:left !important;' >Setor e seu e-mail</label>";
        print "<div class='input-group'>";
        print "<span class='input-group-addon'><i class='fa fa-envelope'></i></span>";
        print "<SELECT NAME=\"$nomecampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . $dados['str_email'] . "'>" . utf8_encode($dados['str_sigla']) . ' - ' . utf8_encode($dados['str_descricao']) . ' --- ( ' . utf8_encode($dados['str_email']) . ' ) ' . "</option>");
        }
        print "</SELECT>";
        print "</div>";
        //return $this->query();
    }

    function consultacombo_DPU_select() {
        $this->sql = "consultacombo_DPU";
        return $this->query();
    }

  function trataDemandas($assunto) {

        //tratamento do id da demanda - remove os 7 primeiros dígitos
        //$id_demanda = substr($demanda['id_documento'], 7, 7);
        
        //Para documenos de decisao
 $assuntodecisao = explode('Decis&atilde;o</p>', $assunto);

        if (stristr($assunto, 'assunto') === FALSE) {

             $assunto = 'SEM ASSUNTO';
        } else if(array_key_exists(1, $assuntodecisao)) {
             $assunto = 'DECISÂO';
        }
        else {

            $assunto = explode('Assunto:', $assunto);

            if (array_key_exists(1, $assunto)) {

                $assunto = $assunto[1];
            } else {

                $assunto = $assunto[0];
                $assunto = explode('ASSUNTO:', $assunto);

                if (!array_key_exists(1, $assunto)) {

                    $assunto = $assunto[0];
                } else {

                    $assunto = $assunto[1];
                }
            }

            $assunto = explode('</p>', $assunto);
            $assunto = $assunto[0];

            while (strpos($assunto, '<')) {

                $posicao1 = strpos($assunto, '<');
                $posicao2 = strpos($assunto, '>');
                $tamanho = $posicao2 - $posicao1 + 1;
                $assunto = substr_replace($assunto, '', $posicao1, $tamanho);
            }

            $assunto = str_replace('&ccedil;', 'ç', $assunto);
            $assunto = str_replace('&atilde;', 'ã', $assunto);
            $assunto = str_replace('&nbsp;', ' ', $assunto);
            $assunto = str_replace('&deg;', 'º', $assunto);
        }

        $assunto = trim($assunto);

        // Retirando da consulta caracteres que interferem no HTML da view
        //$pontos = array('"', "<", ">");
        //$assunto = str_replace($pontos, "", $assunto);
        return strip_tags($assunto);
    }
    /*
     * Listando registros do área DPU para editar
     */

    public function select_unidade_dpu($id_unidade) {
        $this->sql = "select_unidade_dpu $id_unidade ";
        return $this->query2();
    }

    /*
     * Listando registros do área DPGU para editar
     */

    public function select_area_dpgu($id_secretaria) {
        $this->sql = "select_area_dpgu $id_secretaria ";
        return $this->query2();
    }

    /*
     * Selecionar Área DPGU para editar
     */

    function consulta_Simples_DPGU_editar($id_secretaria, $nomedocampo, $listagem=0) {

        $this->sql = "consultacombo_DPGU $listagem";
        $consulta = $this->query();

        print "<SELECT NAME=\"$nomedocampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            if ($dados['id_secretaria'] == $id_secretaria) {
                print("<option value='" . $dados['id_secretaria'] . "' selected>" . utf8_encode($dados['str_sigla']) . ' - ' . utf8_encode($dados['str_descricao']) . "</option>");
            } else {
                print("<option value='" . $dados['id_secretaria'] . "'>" . utf8_encode($dados['str_sigla']) . ' - ' . utf8_encode($dados['str_descricao']) . "</option>");
            }
        }
        print "</SELECT>";

        //return $this->query();
    }

    /*
     * Selecionar Unidade DPU para editar
     */

    function consulta_Combo_Estado_editar($id_unidade, $nomedocampo) {

        $this->sql = "consultacombo_DPU";
        $consulta = $this->query();

        print "<SELECT NAME=\"$nomedocampo\" class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            if ($dados['id_unidade'] == $id_unidade) {
                print("<option value='" . $dados['id_unidade'] . "' selected>" . utf8_encode($dados['str_sigla']) . "</option>");
            } else {
                print("<option value='" . $dados['id_unidade'] . "'>" . utf8_encode($dados['id_unidade']) . ' - ' . utf8_encode($dados['str_descricao']) . "</option>");
            }
        }

        print "</SELECT>";

        //return $this->query();
    }

    /*
     * Listando Alertas
     */

    public function select_alertas() {
        $this->sql = "select_alertas";
        return $this->query();
    }

    /*
     * Listando Alertas
     */

    public function select_alertas_condicao($id_alertas) {
        $this->sql = "select_alertas_condicao $id_alertas";
        return $this->query();
    }

    public function select_emails() {
        $this->sql = "select_emails";
        return $this->query2();
    }

    /*
     * Listando registros da página: ( selecao_filtro ) 
     * com o filtro de Unidade DPU / Secretaria ( DPU - Órgão de Atuação [Unidade] )
     * com o filtro de Unidade DPU / Secretaria ( DPGU - Administração Superior )
     */

    public function select_filtro_unidade_secretaria($status, $id_do_setor, $dpgu_dpu, $dt_despacho_inicial, $dt_despacho_final) {

        $this->sql = "select_filtro_unidade_secretaria $status,$id_do_setor, '$dpgu_dpu','$dt_despacho_inicial','$dt_despacho_final' ";
        return $this->query2();
    }

    /*
     * Listando registros da página: ( selecao_filtro ) 
     * com o filtro de TODOS - Unidade DPU / Secretaria ( DPU - Órgão de Atuação [Unidade] )
     */

    public function select_filtro_todos_unidade($status = null, $todos = null, $dt_despacho_inicial, $dt_despacho_final) {



        if (!empty($todos)) {
            $result = mssql_fetch_assoc($this->select_filtro_todos_unidade($todos));
            return $this->query2();
        }

        $this->sql = "select_filtro_todos_unidade $status, $todos, '$dt_despacho_inicial','$dt_despacho_final'";
        return $this->query2();
    }

    /*
     * Listando registros da página: ( selecao_filtro ) 
     * com o filtro de TODOS - Unidade DPU / Secretaria ( DPGU - Administração Superior )
     */

    public function select_filtro_todos_secretaria($status = null, $todos = null, $dt_despacho_inicial, $dt_despacho_final) {

        if (!empty($todos)) {
            $result = mssql_fetch_assoc($this->select_filtro_todos_secretaria($todos));
            return $this->query2();
        }

        $this->sql = "select_filtro_todos_secretaria $status, $todos, '$dt_despacho_inicial','$dt_despacho_final'";
        return $this->query2();
    }

    /*
     * Captura id do processo pelo numero formatado
     */

    public function busca_id_processos($numero_processo) {
        $this->sql = "busca_id_processos '$numero_processo' ";
        return $this->query();
    }

    /*
     * Listando registros da página: ( selecao_filtro ) 
     * com o filtro de Processos
     */

    public function select_filtro_processos($status = null, $numero_processo = null) {

        if (!empty($numero_processo) and ( strstr($numero_processo, '/') OR strstr($numero_processo, '.'))) {
            $result = $this->busca_id_processos($numero_processo);
            if (mssql_num_rows($result) > 0) {
                $arResult = mssql_fetch_assoc($result);
                $numero_processo = $arResult['id_processo_sei'];
            } else {
                $numero_processo = 00000;
            }
        }

       echo $this->sql = "select_filtro_processos $status, $numero_processo";
        return @$this->query();
    }

    public function select_graf($dt_de, $dt_ate) {
        $this->sql = "select_graf '$dt_de', '$dt_ate'";
        return $this->query2();
    }

    public function select_cdestino_arvore() {
        $this->sql = "select_cdestino_arvore";
        return $this->query2();
    }

    /*
     * Listando usuários cadastrados / Gerencia Usuário 
     */

    public function select_usuario() {
        $this->sql = "select_usuario";
        return $this->query();
    }

    /*
     * Listando usuário selecionado para editar dados
     */

    public function select_usuario_condicao($id_usuario) {
        $this->sql = "select_usuario_condicao $id_usuario";
        return $this->query();
    }

    /*
     * Listando nível de acesso () área administrativa edição de dados do usuário
     */

    function consulta_nivel_de_acesso_editar($id_perfil) {

        $this->sql = "consulta_nivel_de_acesso_editar";
        $consulta = $this->query();


        print "<label style='text-align:left !important;' >Nível de acesso:</label>";
        print "<SELECT NAME='id_perfil' class=form-control >";
        while ($dados = mssql_fetch_array($consulta)) {
            if ($id_perfil == $dados['id_perfil']) {
                print("<option value='" . $dados['id_perfil'] . "' selected >" . utf8_encode($dados['str_perfil']) . "</option>");
            } else {
                print("<option value='" . $dados['id_perfil'] . "' >" . utf8_encode($dados['str_perfil']) . "</option>");
            }
        }
        print "</SELECT>";
        //return $this->query();
    }

    /*
     * Verificando se existem destino sei no smap
     */

    public function select_destino_sei_smap($destino_sei) {
         $this->sql = "select_destino_sei_smap  '$destino_sei'";
        $consultaSQL = $this->query();
        $destino_sei_smap = mssql_fetch_array($consultaSQL);

        if ($destino_sei_smap == true) {
            return $destino_sei_smap['id_secretaria'];
        } else {
            //Secretaria 74 significa "A definir", ou seja, usuário do sistema irá definir o destino.
             $this->sql = "select * from tb_secretaria where str_sigla='A DEFINIR'";
          $consultaSQL2 = $this->query();
        $destino_adefinir = mssql_fetch_array($consultaSQL2);
        return  $destino_adefinir['id_secretaria'];
        }
    }

    /*
     * deletando acomapanhamento
     */

    public function delete_acompanhamento($id_documento_sei,$destino_sei) {
       $this->sql = "delete_acompanhamento $id_documento_sei,'$destino_sei' ";
        return $this->query();
    }
    
        /*
     * Listando registros duplicados à confirmaro
     */

    public function dados_duplicados_confirmar() {
        $this->sql = "dados_duplicados_confirmar ";
        return $this->query2();
    }
        /*
     * Deletando dados da tabela de exclussao à confirmar
     */

    public function delete_dados_duplicados_confirmar($id_documento_sei,$str_destino_sei) {
        $this->sql = "delete_dados_duplicados_confirmar $id_documento_sei,'$str_destino_sei' ";
        return $this->query2();
    }
     /*
     * Listando id_acompanhamento e destino_sei
     */

    public function select_id_acompanhamento($id_documento_sei,$destino_sei) {
        $this->sql = "select_id_acompanhamento $id_documento_sei,'$destino_sei'";
        return $this->query2();
    }

                    /*
     * Selecionando Criador da ultima mudança ou inicio do processo
     */

    
     public function ultima_modificao_processo($acao,$id_acompanhamento) {
         //1 = Criador   2 = Ultimo
         if($acao==1){
       $this->sql = "select * from tb_historico_acompanhamento where id_acompanhamento=$id_acompanhamento order by id_historico_acompanhamento ASC" ;
         } else {
              $this->sql = " select * from tb_historico_acompanhamento where id_acompanhamento=$id_acompanhamento order by id_historico_acompanhamento DESC" ;
         }
       // var_dump(  $this->sql);
       $consulta=$this->query();
       $Result= mssql_fetch_array($consulta);
       
       return $Result;
     
    }
    
       /*
     * Listando todos os historicos acompanhamento
     */

    public function select_hitorico_acompanhamento($int_doc_sei) {
        $this->sql = "select_hitorico_acompanhamento $int_doc_sei";
        return $this->query2();
    }

         /*
     * Update estatus ultimo historico acompanhamento
     */

    public function update_hitorico_acompanhamento($id_historico_acompanhamento) {
        $this->sql = "update_hitorico_acompanhamento $id_historico_acompanhamento";
        return $this->query2();
    }

}


