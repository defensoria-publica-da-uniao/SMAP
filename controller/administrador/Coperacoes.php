<?php

session_start();
require_once '../alert.php';
require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';

$oGeral = new cGeral();
// Ações da página "unidade_dpu_dpgu"
// INSERT Unidade DPU
//Auditoria
$dt_registro = date("Y-m-d H:i:s");
$str_usr_criador = $_SESSION['usuario']['login'];

// INSERT Área DPU
if (!empty($_POST['insert_unidade_dpu'])) {

    // recebendo valores do formulário DPGU
    $id_estado = $_POST['id_unidade'];
    $str_email = utf8_decode($_POST['email']);
    $str_descricao = utf8_decode($_POST['descricao']);



    // Check se a unidade já foi cadastrada.
    // caso ja tenha unidade. Não cadastra.
    // caso não tenha unidade. Cadastra.
    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores
    $inserir_setor_dpu = $oGeral->insert(
            'tb_unidade', 'id_estado,str_email,str_descricao,str_situacao', "'$id_estado','$str_email','$str_descricao','A'"
    );

    // Mensagem de sucesso!
    if ($inserir_setor_dpu == 1) {

        // Auditoria nova Unidade DPU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','5'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Cadastro do nova Unidade DPGU realizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// INSERT Área DPGU
else if (!empty($_POST['insert_setor_dpgu'])) {

    // recebendo valores do formulário DPGU
    $id_secretaria_pai = ($_POST['id_secretaria']);
    $id_unidade = 1;
    $str_sigla = utf8_decode($_POST['sigla']);
    $str_email = utf8_decode($_POST['email']);
    $bo_preferencial_relatorio = 0;
    $str_descricao = utf8_decode($_POST['descricao']);



    // Check se a unidade já foi cadastrada.
    // caso ja tenha unidade. Não cadastra.
    // caso não tenha unidade. Cadastra.
    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores
    $inserir_setor_dpgu = $oGeral->insert(
            'tb_secretaria', 'id_secretaria_pai,id_unidade,str_sigla,str_email,bo_preferencial_relatorio,str_descricao,str_situacao', "'$id_secretaria_pai','$id_unidade','$str_sigla','$str_email','$bo_preferencial_relatorio','$str_descricao','A'"
    );

    // Mensagem de sucesso!
    if ($inserir_setor_dpgu == 1) {

        // Auditoria nova Secretaria DPGU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','6'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Cadastro do novo setor DPGU realizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// DELETE Unidade DPU
else if (!empty($_POST['delete_unidade_dpu'])) { 

    $id_unidade = $_POST['id_unidade'];
    $status = $_POST['status'];
    $delete = $oGeral->updateUniSec('tb_unidade', $status, $id_unidade);

    if ($delete == 1) {

        // Auditoria exclusão Unidade DPU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','9'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = 'Registro excluido com sucesso!';
        $_SESSION['deletesucesso'] = 1;

        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// DELETE Secretaria DPGU
else if (!empty($_POST['delete_setor_dpgu'])) {

    $id_secretaria = $_POST['id_secretaria'];
    $status = $_POST['status'];
    $delete = $oGeral->updateUniSec('tb_secretaria', $status, $id_secretaria);

    if ($delete == 1) {

        // Auditoria exclusão de Secretaria DPGU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','10'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = 'Registro excluido com sucesso!';
        $_SESSION['deletesucesso'] = 1;

        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// UPDATE Unidade DPU
else if (!empty($_POST['update_unidade_dpu'])) {

    $id_unidade = $_POST['id_unidade'];

    $str_descricao = utf8_decode($_POST['descricao']);
    $str_email = utf8_decode($_POST['email']);

    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores, $condicao = $recodição
    $update_unidade_dpu = $oGeral->update(
            'tb_unidade', "str_email='$str_email',str_descricao='$str_descricao'", "id_unidade", $id_unidade
    );

    // Mensagem de sucesso!
    if ($update_unidade_dpu == 1) {

        // Auditoria modificação de Unidade DPU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','7'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Registro Unidade DPU atualizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// UPDATE Secretaria DPGU
else if (!empty($_POST['update_setor_dpgu'])) {

    $id_secretaria = $_POST['id_secretaria'];

    $str_sigla = $_POST['sigla'];
    $id_secretaria_pai = $_POST['id_secretaria_pai'];
    $str_descricao = utf8_decode($_POST['descricao']);
    $str_email = utf8_decode($_POST['email']);

    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores, $condicao = $recodição
    $update_setor_dpgu = $oGeral->update(
            'tb_secretaria', "id_secretaria_pai=$id_secretaria_pai,str_sigla='$str_sigla',str_email='$str_email',str_descricao='$str_descricao'", "id_secretaria", $id_secretaria
    );

    // Mensagem de sucesso!
    if ($update_setor_dpgu == 1) {

        // Auditoria modificação de Secretaria DPGU
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','8'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Registro setor DPGU atualizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/unidade_dpu_dpgu');
    }
}
// FIM Ações da página "unidade_dpu_dpgu"
// Ações da página "gerencia_alertas"
// INSERT Alerta
else if (!empty($_POST['insert_alertas'])) {

    // recebendo valores do formulário
    $str_nome_tipo = utf8_decode($_POST['nome']);
    $str_nome_icone = utf8_decode($_POST['icone']);






    // Check se a unidade já foi cadastrada.
    // caso ja tenha unidade. Não cadastra.
    // caso não tenha unidade. Cadastra.
    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores
    $inserir_alerta = $oGeral->insert(
            'tb_alertas', 'str_nome_tipo,str_nome_icone', "'$str_nome_tipo','$str_nome_icone'"
    );

    // Mensagem de sucesso!
    if ($inserir_alerta == 1) {

        // Auditoria criação de Alerta
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','11'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Cadastro do novo Tipo de Alerta realizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/gerencia_alertas');
    }
}
// DELETE Alerta
else if (!empty($_POST['delete_alertas'])) {

    $id_alertas = $_POST['id_alertas'];

    $delete = $oGeral->delete('tb_alertas', 'id_alertas', $id_alertas);

    // Auditoria delete de Alerta
    $oGeral->insert(
            'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','13'"
    );

    if ($delete == 1) {
        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = 'Registro excluido com sucesso!';
        $_SESSION['deletesucesso'] = 1;

        js_go(RAIZ . 'administrador/gerencia_alertas');
    }
}
// UPDATE Área DPGU
else if (!empty($_POST['update_alertas'])) {

    $id_alertas = $_POST['id_alertas'];

    $str_nome_tipo = utf8_decode($_POST['nome']);
    $str_nome_icone = utf8_decode($_POST['icone']);

    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores, $condicao = $recodição
    $update_alertas = $oGeral->update(
            'tb_alertas', "str_nome_tipo='$str_nome_tipo',str_nome_icone='$str_nome_icone'", "id_alertas", $id_alertas
    );

    // Mensagem de sucesso!
    if ($update_alertas == 1) {

        // Auditoria atualização de Alerta
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','12'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Registro Alerta atualizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/gerencia_alertas');
    }
}
// FIM Ações da página "gerencia_alertas"


// Ações da página "gerencia_usuarios"
// INSERT Novo Usuário
else if (!empty($_POST['insert_usuario'])) {

    // recebendo valores do formulário
    $str_nome = utf8_decode($_POST['nome_usuario']);
    $str_login = utf8_decode($_POST['login']);
    $id_perfil = utf8_decode($_POST['id_perfil']);
    $int_estatus = utf8_decode($_POST['int_estatus']);
    // Data de criação pego da Auditoria $dt_registro
    // Usuário criador pego da Auditoria $str_usr_criador

    if(empty($str_nome)){
         js_alert('Informe o login do usuário e faça a busca para cadastrar');
        $var = "<script>javascript:history.back(-2)</script>";
        echo $var;
        exit;
    }
    if ($str_nome == utf8_decode('Usuário não encontrado')) {
        js_alert('Usuário não foi encontrado, não é possivel cadastrar');
        $var = "<script>javascript:history.back(-2)</script>";
        echo $var;
        exit;
    }

    // Verifica se o usuário está cadastrado na tabela. Se estiver não registra / Se NÃO estiver registra
    $PegaResultado = $oGeral->select('gr_usuario', "WHERE str_login='$str_login'", null);
    $ValidaResultado = mssql_fetch_array($PegaResultado);

    if($ValidaResultado == 0){
        // o usuário não existe, faça a inserção do mesmo;
       
        // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores
        $inserir_usuario = $oGeral->insert(
            'gr_usuario', 'str_nome,str_login,id_perfil,int_estatus,dt_criacao,usr_criador', "'$str_nome','$str_login','$id_perfil','$int_estatus','$dt_registro','$str_usr_criador'"
        );

        // Mensagem de sucesso!
        if ($inserir_usuario == 1) {

            // Auditoria criação de Alerta
            $oGeral->insert(
                    'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','17'"
            );


            $_SESSION['MSGDU'] = 1;
            $_SESSION['Mensagem'] = "Cadastro de novo usuário realizado!";
            $_SESSION['updatesucesso'] = 1;
            js_go(RAIZ . 'administrador/gerencia_usuarios');
        }
        
    }
    else
    {
        // o usuário existe, não irá registrar;
        
        js_alert('O login do usuario já está cadastrado. Não será possivel registra-lo novamente.');
        $var = "<script>javascript:history.back(-2)</script>";
        echo $var;
        exit;
    
    }
    
}

// UPDATE Dados Usuário
else if (!empty($_POST['update_usuario'])) {

    $id_usuario = $_POST['id_usuario'];

    $str_nome = utf8_decode($_POST['str_nome']);
    $str_login = utf8_decode($_POST['str_login']);
    $id_perfil = utf8_decode($_POST['id_perfil']);
    $int_estatus = utf8_decode($_POST['int_estatus']);


  
    
    // inserindo dados no banco. Comunicação com o 'oGeral' $tabela, $campos, $valores, $condicao = $recodição
    $update_alertas = $oGeral->update(
            'gr_usuario', "str_nome='$str_nome',str_login='$str_login',id_perfil='$id_perfil',int_estatus='$int_estatus'", "id_usuario", $id_usuario
    );

    // Mensagem de sucesso!
    if ($update_alertas == 1) {

        // Auditoria atualização de Alerta
        $oGeral->insert(
                'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','18'"
        );

        $_SESSION['MSGDU'] = 1;
        $_SESSION['Mensagem'] = "Dados do Usuário atualizado!";
        $_SESSION['updatesucesso'] = 1;
        js_go(RAIZ . 'administrador/gerencia_usuarios');
    }
}

// FIM Ações da página "gerencia_usuarios"
?>