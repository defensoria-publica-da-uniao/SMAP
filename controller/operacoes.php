<?php

/*
 * Função para converter data PT para data En
 */

function dataEn($data) {
    $dia = substr($data, 0, 2);
    $mes = substr($data, 3, 2);
    $ano = substr($data, 6, 4);
    if (!empty($data))
        return $ano . '-' . $mes . '-' . $dia;
    else
        return "";
}

/*
 * Passando data para formato PT 30/04/1984
 */

function dataPt($data) {
    if ($data == '--')
        return "";
    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);
    if (!empty($data))
        return $dia . '/' . $mes . '/' . $ano;
    else
        return "";
}

/*
 * Cadastrar ou Update
 */
if (!empty($_POST)) {
    session_start();
    require_once '../application/configs/config.php';
    require_once MODELS . 'cGeral.php';
    require_once MODELS . 'cBanco.php';

    $oGeral = new cGeral();
    $oBanco = new cBanco();

    $arrDadosForm = $_POST['arrDadosForm'];
    $tabela = $arrDadosForm['tabela'];
    unset($arrDadosForm['tabela']);

    $arrDadosForm['dt_inicio'] = dataEn($arrDadosForm['dt_inicio']);
    $arrDadosForm['dt_fim'] = dataEn($arrDadosForm['dt_fim']);

    if (!empty($arrDadosForm['dt_nascimento'])) {
        $arrDadosForm['dt_nascimento'] = dataEn($arrDadosForm['dt_nascimento']);
    }

    /*
     * Fazendo Update
     */

    if ($arrDadosForm['acao'] == 'update') {
        unset($arrDadosForm['acao']);
        $id = $arrDadosForm['id_estagiario'];
        unset($arrDadosForm['id_estagiario']);

        $rs = $oBanco->update($tabela, $id, $arrDadosForm, 'id_estagiario');
       
        if ($rs == true) {
            $oGeral->redirect("1", "conteudo/listar");
        } else {
            $oGeral->redirect("2", "conteudo/cadastrar");
        }
    }
    /*
     * Fazendo Cadastro
     */ else {

        $rs = $oBanco->insert($tabela, $arrDadosForm);

        if ($rs == true) {
            $oGeral->redirect("1", "conteudo/listar");
        } else {
            $oGeral->redirect("2", "conteudo/cadastrar");
        }
    }
}

/*
 * Listar
 */ else if ($_SESSION['acao'] == "listar") {
    if ($p1 == 2) {
        $rsProposto = $objBanco->select("tb_estagiario", " WHERE int_status = 1 ");
    } else if ($p1 == 3) {
        $rsProposto = $objBanco->select("tb_estagiario", "WHERE int_status = 0");
    } else {
        $rsProposto = $objBanco->select('tb_estagiario');
    }
    unset($_SESSION['acao']);
}
/*
 * Listar Editar
 */ else if ($_SESSION['acao'] == "editar") {
    $result = $objBanco->select("tb_estagiario", " WHERE id_estagiario = {$p2}");
    $arDados = mssql_fetch_array($result);
    unset($_SESSION['acao']);
}



