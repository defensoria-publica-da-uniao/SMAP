<?php
 

require_once '../../application/configs/config.php';
require_once '../' . MODELS . 'cGeral.php';

$oGeral = new cGeral(); 
$pasta = '../../view/'; 
 
if (is_dir($pasta)) { 

    $diretorio = dir($pasta);
    if ($diretorio <> '.') {
        while (($modulo = $diretorio->read()) !== false) {

            if ($modulo <> '.' && $modulo <> '..') {
                //Verificando se ja existe o modulo para cadastrar
                $consultaModulo = $oGeral->modulo($modulo);
                $checkModulo = mssql_num_rows($consultaModulo);

                if (empty($checkModulo)) {
                    //Inserindo Modulo 
                    $oGeral->insert('gr_modulo', 'str_modulo', "'$modulo'");
                }
                echo 'modulo = ' . $modulo . '  </br> views = ';
                $pastaemodulo = $pasta . $modulo . '/';
                //verificando se existe views nos modulos
                if (is_dir($pastaemodulo)) {
                    $diretorio2 = dir($pastaemodulo);
                    while (($view = $diretorio2->read()) !== false) {
                        if ($view <> '.' && $view <> '..') {
                            $explode = explode('.', $view);
                            $view_final = $explode[0];
                          echo $view_final . ' / ';
                         
                            //Pegando id do modulo
                            $consultaModuloid = $oGeral->modulo($modulo);
                            $arrModulo = mssql_fetch_array($consultaModuloid);
                            $id_modulo = $arrModulo['id_modulo'];

                            //verificando se ja existe essa view cadastrada 
                            $consultaView = $oGeral->view($view_final, $id_modulo);
                            $checkview = mssql_num_rows($consultaView);

                            if (empty($checkview)) {
                                //Inserindo view 
                                $oGeral->insert('gr_view', 'id_modulo,str_view', "'$id_modulo','$view_final'");
                                
                                //Buscando id_view
                                $consultaView = $oGeral->view($view_final, $id_modulo);
                                $arrView = mssql_fetch_array($consultaView);
                                $id_view = $arrView['id_view'];

                                //Ver quantos tipos de usuário existem no sistema
                                $consultaPerfil = $oGeral->select('gr_perfil');
                               
                                //Inserindo a permissao dos perfis na view
                                while ($arrPerfil = mssql_fetch_array($consultaPerfil)) {
                                    $id_perfil = $arrPerfil['id_perfil'];
                                    $str_perfil = $arrPerfil['str_perfil'];
                                    if ($str_perfil == 'Administrador') {
                                        $oGeral->insert('gr_acesso', 'id_view,id_perfil,visualizar,cadastrar,alterar,excluir'
                                                , "'$id_view','$id_perfil','1','1','1','1'");
                                    } else {
                                        $oGeral->insert('gr_acesso', 'id_view,id_perfil,visualizar,cadastrar,alterar,excluir'
                                                , "'$id_view','$id_perfil','0','0','0','0'");
                                    }
                                }
                            }
                        }
                    }
                }

                echo'<hr>';
            }
        }
    }
    $diretorio->close();
} else {
    echo 'A pasta não existe.';
}
