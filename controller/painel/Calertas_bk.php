<?php

for ($c = 0; $c < count($dados_processos_tipos['Ações Judiciais']['diferenca_dias']); $c++) {
    echo "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'>  ";
    if ($dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] < 15) {
        echo "<div class='label label-sm nao-parado-geral'>";
    } else if ($dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] > 15 && $dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] < 30) {
        echo "<div class='label label-sm parado-15'>";
    } else if ($dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] > 30 && $dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] < 60) {
        echo "<div class='label label-sm parado-30'>";
    } else {
        echo "<div class='label label-sm parado-60'>";
    }
    echo "       <i class='fa fa-gavel'></i>
                     </div>
                   </div>
                <div class='cont-col2'>
            <div class='desc'> " . @$dados_processos_tipos['Ações Judiciais']['protocol_formatado'][$c] . " </div>
         </div>
    </div>
   </div>
     <div class='col2'>
 <div class='date'> " . @$dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] . " dias </div>
  </div>
      </li>";
}
for ($c = 0; $c < count($dados_processos_tipos['Pedido de Acesso à Informação - SIC']['diferenca_dias']); $c++) {
    echo "<li>
            <div class='col1'>
                <div class='cont'>
                    <div class='cont-col1'>  ";
    if ($dados_processos_tipos['Pedido de Acesso à Informação - SIC']['diferenca_dias'][$c] < 15) {
        echo "<div class='label label-sm nao-parado-geral'>";
    } else if ($dados_processos_tipos['Pedido de Acesso à Informação - SIC']['diferenca_dias'][$c] > 15 && $dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] < 30) {
        echo "<div class='label label-sm parado-15'>";
    } else if ($dados_processos_tipos['Pedido de Acesso à Informação - SIC']['diferenca_dias'][$c] > 30 && $dados_processos_tipos['Ações Judiciais']['diferenca_dias'][$c] < 60) {
        echo "<div class='label label-sm parado-30'>";
    } else {
        echo "<div class='label label-sm parado-60'>";
    }
    echo " <i class='fa fa-exclamation-circle'></i>
                    </div>
                </div>
             <div class='cont-col2'>
         <div class='desc'> " . @$dados_processos_tipos['Pedido de Acesso à Informação - SIC']['protocol_formatado'][$c] . " </div>
        </div>
       </div>
      </div>
      <div class='col2'>
       <div class='date'> " . @$dados_processos_tipos['Pedido de Acesso à Informação - SIC']['diferenca_dias'][$c] . " dias </div>
      </div>
      </li>";
}