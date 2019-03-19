<?php

session_start();
require_once '../application/configs/config.php';
require_once MODELS . 'cLogin.php';
require_once MODELS . 'cGeral.php';
require_once MODELS . 'cBanco.php';
require_once MODELS . 'cUsuarios.php';
$oLogin = new cLogin();
$oGeral = new cGeral();
$oBanco = new cBanco();
$oUsuario = new cUsuarios();


if ($_POST) {

    $arrDadosForm = $_POST['arrDadosForm'];
    $auth_pass = $arrDadosForm['ds_senha'];
    $usuario = $arrDadosForm['ds_login'];
    
    

    $buscarUsuario = $oUsuario->buscaUsuario($usuario);
    $resultadoUsuario = mssql_num_rows($buscarUsuario);
//Usuario Não cadastrado no Banco
    if ($resultadoUsuario == 0) {
        $oGeral->redirect('13', "login/inicio"); //Usuário sem acesso ao sistema
        exit;
    }
    //Usuario cadastrado no Banco
    else {
        while ($dadosUsuario = mssql_fetch_array($buscarUsuario)) {
            $nomeUsuario = $dadosUsuario['str_nome'];
            $perfilUsuario = $dadosUsuario['id_perfil'];
            $str_perfilUsuario= $dadosUsuario['str_perfil'];
            $estatusUsuario = $dadosUsuario['int_estatus'];
            $loginUsuario = $dadosUsuario['str_login'];        
        }
        
        //Usuário Inativo
        if ($estatusUsuario == 0) {
            $oGeral->redirect('14', "login/inicio"); //Usuário sem acesso ao sistema
            exit;
        } //Usuário Ativo
        else {
            $dom = '@dpu.gov.br';
            $ldap_server = "ldap://10.0.2.253";
            $auth_user = "dpu\\" . $arrDadosForm['ds_login'];

            $base_dn = "ou=DPGU, dc=dpu, dc=gov, dc=br";

            $filter = "(&(objectClass=user)(objectCategory=person)(cn=*)(samaccountname=$usuario))";
            //$filter = "(&(&(&(objectCategory=person)(objectClass=user)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))(samaccountname=$usuario)(|(description=estag*)(description=terc*)(description=colab*)(description=serv*)(description=defe*))))";

            if (!($connect = ldap_connect($ldap_server))) {
                $oGeral->redirect('8', "login/inicio");
                exit;
            }

            if (!($bind = ldap_bind($connect, $auth_user, $auth_pass))) {
                $oGeral->redirect('7', "login/inicio"); //Erro na autenticação
                exit;
            }

            if (!($search = ldap_search($connect, $base_dn, $filter))) {
                $oGeral->redirect('9', "login/inicio"); //Erro na consulta do usuario
                exit;
            }


            $_SESSION['usuario']['ok'] = true;
            $_SESSION['usuario']['login'] = $loginUsuario;
            $_SESSION['usuario']['nome'] = $nomeUsuario;
            $_SESSION['usuario']['perfil'] = $perfilUsuario;
            $_SESSION['usuario']['estatus'] = $estatusUsuario;
            $_SESSION['usuario']['str_perfil']= $str_perfilUsuario;
            $_SESSION['usuario']['senha_c']= base64_encode($auth_pass);
            $oGeral->redirect(null, 'home/index');
        }
    }
} else {
    ldap_close($ds);
    session_destroy();
    $oGeral->redirect('', "login/inicio");
}
?>