<?php

    session_start();
    require_once '../alert.php';
    require_once '../../application/configs/config.php';
    require_once '../' . MODELS . 'cGeral.php';
    require_once '../' . MODELS . 'cBanco.php';
    require_once '../' . MODELS . 'cSmap.php';

    $oGeral = new cGeral();
    $oBanco = new cBanco();
    $oSmap = new cSmap();

    //UPDATE Unidade DPU
    if (!empty($_POST['id_unidade'])){
        
        $id_unidade = $_POST['id_unidade'];
        
        $select = $oSmap-> select_unidade_dpu($id_unidade);
        $arDados = mssql_fetch_array($select);
        //echo '<pre>';
        //var_dump($arDados);    //   O resultado do select está sendo guardado dentro do array 'arDados'
        
        $id_regiao = $arDados['id_regiao'];
        $id_estado = $arDados['id_estado'];
        $str_email = $arDados['str_email'];
        $str_descricao = $arDados['str_descricao'];

        include '../../application/ajax/editar_destino_dpu_dpgu.php';
        
    }
    //UPDATE Área DPGU
    else if (!empty($_POST['id_secretaria'])){
       
        $id_secretaria = $_POST['id_secretaria'];
        
        $select = $oSmap-> select_area_dpgu($id_secretaria);
        $arDados = mssql_fetch_array($select);
        //echo '<pre>';
        //var_dump($arDados);     //  O resultado do select está sendo guardado dentro do array 'arDados'
        
        $str_sigla = $arDados['str_sigla'];
        $id_secretaria_pai = $arDados['id_secretaria_pai'];
        $str_email = $arDados['str_email'];
        $str_descricao = $arDados['str_descricao'];
        
        include '../../application/ajax/editar_destino_dpu_dpgu.php';
    }
    
    //UPDATE Alertas
    else if (!empty($_POST['id_alertas'])){
       
        $id_alertas = $_POST['id_alertas'];
        
        $select = $oSmap-> select_alertas_condicao($id_alertas);
        $arDados = mssql_fetch_array($select);
        
        //echo '<pre>';
        //var_dump($arDados);     //  O resultado do select está sendo guardado dentro do array 'arDados'
        //exit();
        
        $str_nome_tipo = $arDados['str_nome_tipo'];
        $str_nome_icone = $arDados['str_nome_icone'];
        
        if ($arDados['str_nome_icone'] == 'fa fa-gavel') {
            $situ1 = "Checked='checked'";
        } else if ($arDados['str_nome_icone'] == 'fa fa-exclamation-circle') {
            $situ2 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-contao') {
             $situ3 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-industry') {
             $situ4 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-diamond') {
             $situ5 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-graduation-cap') {
             $situ6 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-calendar-plus-o') {
             $situ7 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-heart') {
             $situ8 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-commenting') {
             $situ9 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-fire-extinguisher') {
             $situ10 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-get-pocket') {
             $situ11 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-gg') {
             $situ12 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-home') {
             $situ13 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-picture-o') {
             $situ14 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-hourglass') {
             $situ15 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-cutlery') {
             $situ16 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-mouse-pointer') {
             $situ17 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-dollar') {
             $situ18 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-map') {
             $situ19 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-map-pin') {
             $situ20 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-phone-square') {
             $situ21 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-plane') {
             $situ22 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-plug') {
             $situ23 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-share-alt') {
             $situ24 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-university') {
             $situ25 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-unlock') {
             $situ26 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-trophy') {
             $situ27 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-tree') {
             $situ28 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-thumbs-up') {
             $situ29 = "Checked='checked'";
        }else if ($arDados['str_nome_icone'] == 'fa fa-refresh') {
             $situ30 = "Checked='checked'";
        }
        
        
        
        include '../../application/ajax/editar_alertas.php';
    }
    
    //UPDATE Usuário
    else if (!empty($_POST['id_usuario'])){
       
        $id_usuario = $_POST['id_usuario'];
        
        $select = $oSmap-> select_usuario_condicao($id_usuario);
        $arDados = mssql_fetch_array($select);
        
        //echo '<pre>';
        //var_dump($arDados);     //  O resultado do select está sendo guardado dentro do array 'arDados'
        //exit();
        
        $str_nome = $arDados['str_nome'];
        $str_login = $arDados['str_login'];
        $id_perfil = $arDados['id_perfil'];
        $int_estatus = $arDados['int_estatus'];
        
        include '../../application/ajax/editar_usuarios.php';
    }
?>


