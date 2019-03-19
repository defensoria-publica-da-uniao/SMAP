<?php

require '../../application/configs/config.php';
require '../alert.php';
require 'PHPMailer.php';
require 'SMTP.php';
session_start();

$email = $_SESSION['destinatario'];
$assunto = $_SESSION['assunto'];
$corpo_email = $_SESSION['corpoEmail'];
$caminho = '../../' . $_SESSION['caminho'];
$tipo = $_SESSION['tipo'];
$caminho_anexos = $_SESSION['caminho_anexos'];

unset($_SESSION['destinatario']);
unset($_SESSION['assunto']);
unset($_SESSION['corpoEmail']);
unset($_SESSION['caminho']);
unset($_SESSION['tipo']);
unset($_SESSION['caminho_anexos']);

$objEmail = new EnviaEmail($email, $assunto, $corpo_email, $caminho, $tipo, $caminho_anexos);

class EnviaEmail {

    private $objEmail;
    private $destinatario;
    private $assunto;
    private $corpoEmail;
    private $caminho;
    private $tipo;
    private $caminho_anexos;

    public function __construct($destinatario, $assunto, $corpoEmail, $caminho, $tipo, $caminho_anexos) {
        $this->objEmail = new PHPMailer(true);
        $this->destinatario = $destinatario;
        $this->assunto = $assunto;
        $this->corpoEmail = $corpoEmail;
        $this->caminho = $caminho;
        $this->caminho_anexos = $caminho_anexos;
        $this->tipo = $tipo;
        $this->Email();
    }

    public function Email() {
        try {
            // Configurações do servidor
            $this->objEmail->SMTPDebug = 0;
            $this->objEmail->isSMTP();
            $this->objEmail->Host = 'webmail.dpu.def.br';
            $this->objEmail->SMTPAuth = false;
            //$this->objEmail->Username = 'ascom@dpu.def.br';
            //$this->objEmail->Password = 'ascom@123';
            //$mail->SMTPSecure = 'tls';                            
            $this->objEmail->Port = 2520;

            // Remetente e Destinatário
            $this->objEmail->setFrom('smap@dpu.def.br', 'Relatório SMAP');
            $this->objEmail->addAddress($this->destinatario);
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // Anexos
            //echo $this->caminho;
            //var_dump($this->caminho_anexos);
            $this->objEmail->addAttachment($this->caminho);


            try {
                for ($i = 0; $i < count($this->caminho_anexos); $i++) {
                    $this->objEmail->addAttachment('../../' . $this->caminho_anexos[$i]);
                }
            } catch (Exception $e) {
                // Sem instruções
            }

            // Conteúdo do Email
            $this->objEmail->isHTML(true);
            $this->objEmail->CharSet = 'UTF-8';
            $this->objEmail->Subject = $this->assunto;
            $this->objEmail->Body = $this->corpoEmail;

            $this->objEmail->send();
            try {
                for ($i = 0; $i < count($this->caminho_anexos); $i++) {
                    if (is_file('../../' . $this->caminho_anexos[$i])) {
                        unlink('../../' . $this->caminho_anexos[$i]);
                    }
                }
            } catch (Exception $e) {
                return 0;
            }

            $_SESSION['msg_relatorio'] = 'Relatório Enviado !';

            if ($this->tipo == 'geral') {
                // Auditoria Relatórios
                require_once("../../controller/alert.php");
                require_once("../../application/configs/config.php");
                require_once('../../model/cGeral.php');

                $oGeral = new cGeral();

                $dt_registro = date("Y-m-d H:i:s");
                $str_usr_criador = $_SESSION['usuario']['login'];

                $oGeral->insert(
                        'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','16'"
                );
                // FIM Auditoria Relatórios
                js_go(RAIZ . 'relatorios/rel_geral');
            } elseif ($this->tipo == 'pendencias') {
                // Auditoria Relatórios
                require_once("../../controller/alert.php");
                require_once("../../application/configs/config.php");
                require_once('../../model/cGeral.php');

                $oGeral = new cGeral();

                $dt_registro = date("Y-m-d H:i:s");
                $str_usr_criador = $_SESSION['usuario']['login'];

                $oGeral->insert(
                        'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','15'"
                );
                // FIM Auditoria Relatórios
                js_go(RAIZ . 'relatorios/rel_pendencias');
            } elseif ($this->tipo == 'demandas') {
                // Auditoria Relatórios
                require_once("../../controller/alert.php");
                require_once("../../application/configs/config.php");
                require_once('../../model/cGeral.php');

                $oGeral = new cGeral();

                $dt_registro = date("Y-m-d H:i:s");
                $str_usr_criador = $_SESSION['usuario']['login'];

                $oGeral->insert(
                        'tb_auditoria', 'dt_registro, str_usr_criador, id_generica_tabela', "'$dt_registro','$str_usr_criador','14'"
                );
                // FIM Auditoria Relatórios
                js_go(RAIZ . 'relatorios/rel_demandas');
            }
        } catch (Exception $e) {
            
            // ERRO QUANDO NÃO ENVIA O E-MAIL
            if ($this->tipo == 'geral') {
                $_SESSION['msg_relatorio_erro'] = "Falha ao enviar mensagem. Endereço de e-mail errado. Contate o Administrador.";
                js_go(RAIZ . 'relatorios/rel_geral');
            }elseif ($this->tipo == 'pendencias') {
                $_SESSION['msg_relatorio_erro'] = "Falha ao enviar mensagem. Endereço de e-mail errado. Contate o Administrador.";
                js_go(RAIZ . 'relatorios/rel_pendencias');
            }elseif ($this->tipo == 'demandas') {
                $_SESSION['msg_relatorio_erro'] = "Falha ao enviar mensagem. Endereço de e-mail errado. Contate o Administrador.";
                js_go(RAIZ . 'relatorios/rel_demandas');
            }
            // FIM ERRO QUANDO NÃO ENVIA O E-MAIL
            
            //echo 'Falha ao enviar mensagem. E-mail Error: ', $this->objEmail->ErrorInfo;
        }
    }

}
