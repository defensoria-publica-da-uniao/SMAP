<?php
session_start();
require_once '../application/configs/config.php';
require_once MODELS . 'cLogin.php';
require_once MODELS . 'cGeral.php';
$oLogin = new cLogin();
$oGeral = new cGeral();

$usuario = $_POST['str_login'];

$conexao = ldap_connect('ldap://10.0.2.253');
ldap_set_option($conexao, LDAP_OPT_REFERRALS, 0);
ldap_set_option($conexao, LDAP_OPT_PROTOCOL_VERSION, 3);

$usuario2 = "dpu\\" . $_SESSION['usuario']['login'];
$senha2 = base64_decode($_SESSION['usuario']['senha_c']);

$bind = ldap_bind($conexao, "$usuario2", "$senha2");

//determina base e filtro para consulta LDAP
$base = "ou=DPGU, dc=dpu, dc=gov, dc=br";
$filtro = "(&(&(&(objectCategory=person)(objectClass=user)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))(samaccountname=$usuario)(|(description=estag*)(description=terc*)(description=colab*)(description=serv*)(description=defe*))))";

//consulta LDAP
$consulta = ldap_search($conexao, $base, $filtro);
//busca informações do usuário
$informacoes = ldap_get_entries($conexao, $consulta);
if (count($informacoes) > 1) {
    // echo '<pre>';
    // var_dump($informacoes);
    $nome = $informacoes[0]['cn'][0];
} else {
    $nome = 'Usuário não encontrado';
}
?>


<div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
    <div class="form-group col-md-12">
        <label style="text-align:left !important;" >Nome completo:</label>
        <input class="form-control spinner" maxlength="100" name="nome_usuario_ajax" id="nome_usuario_ajax" type="text" placeholder="Nome completo" required="" value="<?php echo $nome; ?>" disabled>  
        
    </div>
</div>