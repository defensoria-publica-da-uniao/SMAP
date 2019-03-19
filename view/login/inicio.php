<script type="text/javascript">
    $(function () {
        $("#formLogin").validate();
        $("#formLogin").submit(function () {
            if ($("#formLogin").valid()) {
                enviaForm();
            }
        });
    });  
</script>

<!-- Enviar formulário clicando em Enter -->
<script type="text/javascript">
document.onkeyup=function(e){
    if(e.which == 13){
    document.form_login.submit();
    }
}
</script>
<!-- FIM Enviar formulário clicando em Enter -->

<!-- Carregar os icones na próxima página -->
<link href="<?php echo PUBLICO; ?>css/login/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PUBLICO; ?>css/login/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PUBLICO; ?>css/login/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PUBLICO; ?>css/login/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- FIM Carregar os icones na próxima página -->

<div id="background">
    <div id="background-imagem">

        <div class="login">	
            <!-- BEGIN LOGO -->
            <div class="clearfix visible-md-block visible-lg-block">
                <div class="logo">
                    <img src="<?php echo IMG; ?>logo/logo-desk-branca.png" height="125" alt=""> 
                </div>
            </div>
            <div class="clearfix visible-xs-block visible-sm-block">
                <p align="center">
                    <img src="<?php echo IMG; ?>logo/logo-mobile-branco.png" height="150" alt=""> 
                </p>
            </div>
            <!-- END LOGO -->

            <div class="content">
                <div style="color:#FFFF00;">
                    <center> <?php require LAYOUTS . "mensagem.php"; ?> </center>
                </div>
                <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'login.php' ?>">
                    <h3 class="form-title">Acesso ao Sistema</h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span> Entre com seu usuário e senha da rede. </span>
                    </div>
                    <div align="center" class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Usuário</label>
                        <div class="input-icon">
                            <i class="">
                                <img src="<?php echo IMG; ?>user.png" height="15" alt="User" >
                            </i>
                            <input type="user" name="arrDadosForm[ds_login]"  value="" id="usuario" class="form-control" placeholder="Nome de usuário"> </div>
                    </div>
                    <div align="center" class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Senha</label>
                        <div class="input-icon">
                            <i class="">
                                <img src="<?php echo IMG; ?>lock.png" height="15" alt="lock" >
                            </i>
                            <input type="password" name="arrDadosForm[ds_senha]" value="" id="senha" class="form-control" placeholder="Senha"> </div>
                    </div>
                    <br />
                    <div  class="form-actions" align="center">
                        <button type="submit" class="btn green pull-center"> Acessar </button>
                    </div>
                    <br />
                    <br />
                    <div class="create-account" align="center">
                        <p> Informações do Sistema procure a&nbsp;<b>Unidade Urgente/UND</b></p>
                        <p>+55 (61) 3318-4319 | unidadeurgente.dpgu@dpu.def.br</p>
                    </div>
                </form>
            </div>
            <br />
            <br />
            <div class="copyright"> 
                © <script language=javascript type="text/javascript">
                    now = new Date
                    document.write (now.getFullYear() )
                </script> Coordenação de Sistemas - STI - Defensoria Pública da União</div>

        </div>
    </div>
</div>

<script src="<?php echo PUBLICO; ?>js/login/jquery.backstretch.min.js" type="text/javascript"></script>
<?php  session_destroy(); require_once 'public/js/login/login-4.php'; ?>
