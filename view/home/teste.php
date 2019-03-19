<?php 
//require_once 'controller/grafico_coluna.php';

echo $string='
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="pt-br" >
<head>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
p.Tabela_Texto_8 {font-size:8pt;font-family:Times New Roman;text-align:left;word-wrap:normal;margin:0 3pt 0 3pt;} p.Tabela_Texto_Alinhado_Direita {font-size:11pt;font-family:Times New Roman;text-align:right;word-wrap:normal;margin:0 3pt 0 3pt;} p.Tabela_Texto_Alinhado_Esquerda {font-size:11pt;font-family:Times New Roman;text-align:left;word-wrap:normal;margin:0 3pt 0 3pt;} p.Tabela_Texto_Centralizado {font-size:11pt;font-family:Times New Roman;text-align:center;word-wrap:normal;margin:0 3pt 0;} p.Tachado {font-size:11pt;font-family:Times New Roman;text-indent:1.18in;text-align:justify;word-wrap:normal;text-decoration:line-through;} p.Texto_Alinhado_Direita {font-size:12pt;font-family:Times New Roman;text-align:right;word-wrap:normal;margin:6pt;} p.Texto_Alinhado_Esquerda {font-size:12pt;font-family:Times New Roman;text-align:left;word-wrap:normal;margin:6pt;} p.Texto_Alinhado_Esquerda_Espaçamento_Simples {font-size:12pt;font-family:Times New Roman;text-align:left;word-wrap:normal;margin:0;} p.Texto_Centralizado {font-size:12pt;font-family:Times New Roman;text-align:center;word-wrap:normal;margin:6pt;} p.Texto_Centralizado_Maiusculas {font-weight:bold;font-size:13pt;font-family:Times New Roman;text-align:center;text-transform:uppercase;word-wrap:normal;} p.Texto_Citação {font-size:10pt;font-family:Times New Roman;word-wrap:normal;margin:4pt 0 4pt 1.18in;text-align:justify;} p.Texto_Ementa {font-size:10pt;font-family:Times New Roman;text-align:justify;word-wrap:normal;margin:4pt 0 4pt 3.14in;} p.Texto_Justificado {font-size:12pt;font-family:Times New Roman;text-align:justify;word-wrap:normal;text-indent:0;margin:6pt;} p.Texto_Justificado_Recuo_Primeira_Linha {font-size:12pt;font-family:Times New Roman;text-indent:1.18in;text-align:justify;word-wrap:normal;margin:6pt;} p.Texto_Mono_Espaçado {font-size:8pt;font-family:Courier New;text-align:left;white-space:nowrap;word-wrap:normal;margin:2pt;} 
</style><title>SEI/DPU - 2664090 - Despacho</title>
</head>
<body>
<table width="99%" border="0" cellpadding="0" cellspacing="0" style="border:0;">  
<tr> 
<td align="left" style="font-family:times new roman,times,serif;font-size:9pt;border:0;" width="50%">
&nbsp;2664090v<span id="spnVersao">2</span>&nbsp
</td>   
<p class="Texto_Centralizado_Maiusculas">Despacho - DPU/SGE DPGU</p>
<p class="Texto_Alinhado_Direita">Bras&iacute;lia, 26 de outubro de 2018.</p>
<p class="Texto_Alinhado_Esquerda_Espa&ccedil;amento_Simples"><strong>Objeto:</strong>&nbsp;Presta&ccedil;&atilde;o de servi&ccedil;os de vigil&acirc;ncia &ndash; DPU/Ribeir&atilde;o Preto/SP</p>

<p class="Texto_Alinhado_Esquerda_Espa&ccedil;amento_Simples"><strong>Assunto:</strong>&nbsp;Prorroga&ccedil;&atilde;o e altera&ccedil;&atilde;o&nbsp;do&nbsp;Contrato n&deg;&nbsp;140/2016.</p>
<p class="Texto_Justificado_Recuo_Primeira_Linha">&Agrave; SAJ</p>

<p class="Texto_Justificado_Recuo_Primeira_Linha">1. Trata-se do Contrato n&ordm; 140/2016, cujo objeto &eacute; a presta&ccedil;&atilde;o dos servi&ccedil;os de vigil&acirc;ncia&nbsp;para atender &agrave; Unidade da DPU em Ribeir&atilde;o Preto/SP&nbsp;e que tem vig&ecirc;ncia prevista at&eacute; o dia 28/11/2018.</p>

<p class="Texto_Justificado_Recuo_Primeira_Linha"><span>2.&nbsp;Por meio do Encaminhamento&nbsp;DICONT&nbsp;SUDESTE&nbsp;</span><a id="anchor10000002631983" target="_blank"><span id="span10000002631983" title="Despacho CCOP  DPGU 2517036"> DPGU </span></a><span contenteditable="false" style="text-indent:0;"><a class="ancoraSei"  href="controlador.php?acao=protocolo_visualizar&id_protocolo=10000002784675&infra_sistema=100000100&infra_unidade_atual=110000906&infra_hash=36fa93363c559de895340cd903a18ec26af3baa4b0b0f51f244d7c49f7095fac" target="_blank"  style="text-indent:0;">2659611</a></span>, solicita an&aacute;lise quanto a prorroga&ccedil;&atilde;o e altera&ccedil;&atilde;o ao contrato citado, relata que conforme tratativas com a contratada Observe Seguran&ccedil;a LTDA, em que manifestou favor&aacute;vel quanto a altera&ccedil;&atilde;o de valor mensal.</p>

<p class="Texto_Justificado_Recuo_Primeira_Linha">3. Frente o exposto, encaminhem-se os autos para an&aacute;lise e emiss&atilde;o de parecer jur&iacute;dico-formal.</p>

<p class="Texto_Justificado_Recuo_Primeira_Linha">&nbsp;</p>

</body>
</html>




';



echo $trato=$objSmap->trataDemandas($string);
//$ex= explode('DESPACHO',$string);
//echo $ex[0];

?>


<div id="chartdiv"></div>

  <script src="<?php echo JS; ?>pace.js" type="text/javascript"></script>
   <link href="<?php echo CSS; ?>themes/blue/pace-theme-loading-bar.css" rel="stylesheet" type="text/css" />
       
   <div id="carregar">
       
       sssss
   </div>

   
   
   
   
<select name="opcao" id="opcao" class=form-control required>
    <option value="">Selecione</option>
    <option value="DPGU">DPGU - Administração Superior</option>
    <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>

</select>

<div id="divtal" style="display:none" >
    <select name="unidades_destinos" id="unidades_destinos" class=form-control required>
        <option value="0">Escolha um estado</option>
    </select>
</div>

<form id='teste'>
    <input type="text" name="str_login" placeholder="Digite o login do usuário">
    <input type="submit" value="Buscar">
</form>


 <div class="fetched-data">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->
                </div>
<?php

echo $modulo;
echo $pagina;
$caminho = CONTROLLER . 'demandas/Cexibedemanda.php';
$caminhousuario = CONTROLLER . 'buscausuario.php';

?>


<script>
    var caminhousuario;
    caminhousuario = '<?php echo $caminhousuario ?>';

    $(function () {
        $('#teste').submit(function (event) {
            event.preventDefault();// using this page stop being refreshing 
            $.ajax({
                type: 'POST',
                url: caminhousuario,
                data: $('form').serialize(),
                success: function (data) {
                    $('.fetched-data').html(data);
                }
            });

        });
    });
    



    var caminho;
    caminho = '<?php echo $caminho ?>';

    $(document).ready(function () {
        $('#opcao').change(function () {
            $('#unidades_destinos').load(caminho + '?opcao=' + $('#opcao').val());
        });
        $('#opcao1').change(function () {
            $('#unidades_destinos1').load(caminho + '?opcao=' + $('#opcao1').val());
        });
        $('#opcao2').change(function () {
            $('#unidades_destinos2').load(caminho + '?opcao=' + $('#opcao2').val());
        });
    });

    function id(el) {
        return document.getElementById(el);
    }
    window.onload = function () {
        id('opcao').onchange = function () {
            if (this.value == 'DPU' || this.value == 'DPGU')
                id('divtal').style.display = 'block';

            else
                id('divtal').style.display = 'none';
        }

        id('opcao1').onchange = function () {
            if (this.value == 'DPU' || this.value == 'DPGU')
                id('divtal1').style.display = 'block';

            else
                id('divtal1').style.display = 'none';
        }

        id('opcao2').onchange = function () {
            if (this.value == 'DPU' || this.value == 'DPGU')
                id('divtal2').style.display = 'block';

            else
                id('divtal2').style.display = 'none';
        }
    }



</script>

<?php
echo $_SERVER['REMOTE_ADDR'];
?>
