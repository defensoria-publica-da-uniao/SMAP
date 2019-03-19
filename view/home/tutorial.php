<?php
    require_once INCLUDES . 'validaLogin.php';    
?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">

                            <div class="row">    
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>
                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>MANUAL DE FUNCIONALIDADES DO SMAP</b></h3>
                                                <h4><span class="font-blue-sharp">PASSO A PASSO</span></h4>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>                        
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase">Índice</span>
                                                <a id="indice"></a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="container">                                                
                                                <a href="#painel_geral" class="scrollSuave">1. Painel Geral</a>
                                                <br> 
                                                <a style="padding-left: 40px;" href="#informacoes_gerais" class="scrollSuave">1.1 Informações Gerais</a>
                                                <br> 
                                                <a style="padding-left: 40px;" href="#alertas_especificos" class="scrollSuave">1.2 Alertas Específicos</a>
                                                <br> 
                                                <a style="padding-left: 40px;" href="#processos_com_prazo" class="scrollSuave">1.3 Processos com Prazo</a>
                                                <br> 
                                                <a style="padding-left: 40px;" href="#processos_sem_resposta" class="scrollSuave">1.4 Processos sem Resposta</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#grafico_de_acompanhamento" class="scrollSuave">1.5 Gráfico de Acompanhamento de Todas as Demandas</a>
                                                <br><br> 
                                                <a href="#demandas" class="scrollSuave">2. Demandas</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#inclusao_acompanhamento" class="scrollSuave">2.1 Inclusão de Acompanhamento de Demandas do SMAP</a>
                                                <br>                                                
                                                <a style="padding-left: 40px;" href="#edicao_acompanhamento" class="scrollSuave">2.2 Edição de Acompanhamento de Demandas do SMAP</a>
                                                <br> 
                                                <a style="padding-left: 40px;" href="#encaminhar_remocao" class="scrollSuave">2.3 Encaminhamento de Processos para Remoção</a>
                                                <br><br> 
                                                <a href="#relatorios" class="scrollSuave">3. Relatórios</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#relatorios_demanda" class="scrollSuave">3.1 Relatórios por Demanda</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#relatorios_pendencias" class="scrollSuave">3.2 Relatórios por Pendências</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#relatorios_geral" class="scrollSuave">3.3 Relatórios Geral</a>
                                                <br>
                                                <a style="padding-left: 40px;" href="#relatorios_email" class="scrollSuave">3.4 Encaminhar Relatórios por Email</a>
                                                
                                                <!-- Visível Aos Administradores do Sistema -->
                                                <?php if ($_SESSION['usuario']['perfil']==1){ ?>
                                                    <br><br> 
                                                    <a href="#area_administrativa" class="scrollSuave">4. Área Administrativa</a>
                                                    <br>
                                                    <a style="padding-left: 40px;" href="#administrar_usuarios" class="scrollSuave">4.1 Administrar Usuários</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#cadastro_usuarios" class="scrollSuave">4.1.1 Cadastro de Usuários</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#edicao_usuarios" class="scrollSuave">4.1.2 Edição de Usuários</a>
                                                    <br>
                                                    <a style="padding-left: 40px;" href="#auditoria" class="scrollSuave">4.2 Auditoria</a>
                                                    <br>
                                                    <a style="padding-left: 40px;" href="#unidades_secretarias" class="scrollSuave">4.3 Unidades DPU / Secretarias DPGU</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#cadastro_unidades_secretarias" class="scrollSuave">4.3.1 Cadastro de Unidades DPU / Secretarias DPGU</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#edicao_unidades_secretarias" class="scrollSuave">4.3.2 Edição de Unidades DPU / Secretarias DPGU</a>
                                                    <br>
                                                    <a style="padding-left: 40px;" href="#gerenciamento_alertas" class="scrollSuave">4.4 Gerenciamento de Alertas</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#cadastro_alertas" class="scrollSuave">4.4.1 Cadastro de Alertas</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#edicao_alertas" class="scrollSuave">4.4.2 Edição de Alertas</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#exclusao_alertas" class="scrollSuave">4.4.3 Exclusão de Alertas</a>
                                                    <br>
                                                    <a style="padding-left: 80px;" href="#processos_duplicados" class="scrollSuave">4.5 Processos Duplicados</a>
                                                <?php } ?>
                                                <!-- Visível Aos Administradores do Sistema -->
                                                
                                                <br><br>
                                                <a href="#filtros" class="scrollSuave">5. Filtros do SMAP</a>                                                
                                            </div>                                                
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!-- INÍCIO da Seção do Painel -->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase">1. Painel Geral</span>
                                                <a id="painel_geral"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        O Painel Geral é um conjunto de <i>dashboards</i> (painéis que mostram informações importantes para alcançar objetivos e metas traçadas de forma visual, facilitando a compreensão dos dados gerados) específicas com a finalidade de monitoramento de métricas e indicadores das demandas.
                                                    </p><br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/painel.png" alt="Painel Geral" width="80%" >
                                                    </center>                                              
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">1.1 Informações Gerais</span>
                                                <a id="informacoes_gerais"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        Basicamente, o Painel Geral exibe informações sobre: as demandas do SMAP com status "Em Aberto", as demandas "Concluídas" da DPGU e das Unidades DPU, as demandas "Em Andamento" da DPGU e das Unidades DPU.
                                                    </p>
                                                    <p>Para complementar ainda mais a consciência situacional das demandas, é exibido um gráfico pizza para fornecer ao usuário do sistema um maior entendimento do que está acontecendo em relação a todas as demandas.</p>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/informacoes-gerais.png" alt="Painel Geral" width="80%" >
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">1.2 Alertas Específicos</span>
                                                <a id="alertas_especificos"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        Esta funcionalidade lista as demandas que sofreram acompanhamento de processos específicos. 
                                                    </p>
                                                    <p>
                                                        Atualmente os processos que estão cadastrados para serem listados são "Ações Judiciais", "Contratos - Aditivo / Renovação / Rescisão", "Imóvel - Reforma", "Lei de Acesso à Informação - LAI" e "Pedido de Acesso à Informação - SIC". Caso os usuários desejem incluir, editar ou excluir os alertas, estes deverão entrar em contato com o administrador do sistema.
                                                    </p><br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/alertas-especificos.png" alt="Alertas Específicos" width="30%">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">1.3 Processos com Prazo</span>
                                                <a id="processos_com_prazo"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        Esta funcionalidade lista as demandas que sofreram, com algumas ressalvas, acompanhamento. Essas ressalvas são explicadas logo abaixo:  
                                                    </p>
                                                    <ol>
                                                        <li>Não serão listados os processos do tipo "Alertas Específicos";</li>
                                                        <li>O usuário deverá preencher o campo de "Prazo de Resposta" quando incluir um acompanhamento na demanda para que sejam mostrados os prazos antes de 15, 30 ou 60 dias;</li>
                                                        <li>A demanda deve estar com o status "Em andamento" e parado há mais de 15, 30 ou 60 dias. Isso ocorre caso o usuário não inclua o "Prazo de Resposta" no acompanhamento.</li>
                                                    </ol>  
                                                    <p>Para complementar, a seguir é exibido o significado da fraseologia utilizada na <i>dashboard</i>:</p>
                                                    <ul>
                                                        <li><u>Falta</u>: andamentos que foram cadastrados com "Prazo de Resposta";</li>
                                                        <li><u>Expirado</u>: andamentos que estouraram o "Prazo de Resposta".</li>
                                                    </ul><br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/processos-com-prazo.png" alt="Processos Com Prazo" width="30%">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                          
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">1.4 Processos sem Resposta </span>
                                                <a id="processos_sem_resposta"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        Esta funcionalidade lista as demandas que estão paralisadas nos respectivos setores onde se encontram.
                                                    </p>
                                                    <p>Para complementar, a seguir é exibido o significado de informações que são mostradas no filtro da <i>dashboard</i>:</p>                                                    
                                                    <ul>
                                                        <li><u>Total</u>: quantidade total de processos parados;</li>
                                                        <li><u>Parados (+ 15 dias)</u>: processos que estão parados há mais de 15 dias;</li>
                                                        <li><u>Parados (+ 30 dias)</u>: processos que estão parados há mais de 30 dias;</li>
                                                        <li><u>Parados (+ 60 dias)</u>: processos que estão parados há mais de 60 dias.</li>
                                                    </ul><br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/processos-sem-resposta.png" alt="Processos Sem Resposta" width="30%">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">1.5 Gráfico de Acompanhamento de Todas as Demandas</span>
                                                <a id="grafico_de_acompanhamento"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        O Gráfico de Acompanhamento de Todas as Demandas apresenta o status de todos os registros de demandas presentes no sistema.
                                                    </p><br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/painel/acompanhamento.png" alt="Gráfico de Acompanhamento de Todas as Demandas" width="50%">
                                                    </center>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM da Seção do Painel -->
                                    
                                    
                                    
                                    <!-- INÍCIO da Seção de Demandas -->
                                    <div class="portlet light ">  
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase">2. Demandas</span>
                                                <a id="demandas"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        Através do menu do sistema é possível selecionar a opção de "Demandas" do SMAP.
                                                    </p>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/menu.png" alt="Demandas do SMAP" width="80%" >
                                                    </center>
                                                    <br>
                                                    <p>
                                                        <b>Página de Demandas do SMAP:</b>
                                                    </p>
                                                    <ul>
                                                        <li>O sistema exibe os processos que estão na caixa da Secretaria-Geral Executiva (SGE) que foram importados do Sistema Eletrônico de Informações (SEI);</li>
                                                        <li>Somente os documentos de "Despacho", "Portaria", "Informação", "Decisão" e "Encaminhamento" que foram remetidos pela SGE a outros setores ou unidades no sistema SEI serão mostrados na listagem;</li>
                                                        <li>Demandas sinalizadas como "Concluídas" não poderão ser editadas ou excluídas.</li>                                                        
                                                        <li>A carga de demandas é realizada de hora em hora e é aplicada automaticamente por quem estiver logado no sistema.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">2.1 Inclusão de Acompanhamento de Demandas do SMAP</span>
                                                <a id="inclusao_acompanhamento"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        <b>Como exemplo, vamos realizar uma inclusão de acompanhamento em uma demanda do SMAP:</b>
                                                    </p>
                                                    <ol>
                                                        <li>No menu principal, selecione a opção "Demandas";</li><br>
                                                        <li>Uma listagem de demandas com status "Em aberto" será mostrada em ordem decrescente pela data de despacho;</li><br>
                                                        <li>Utilize os filtros para encontrar processos ou documentos específicos. Caso não sabia como utilizá-los, <a href="#filtros">Clique Aqui</a>;</li><br>
                                                        <li>Os resultados serão mostrados em uma tabela com várias colunas com informações relevantes. A primeira coluna, chamada de "Ação", apresenta um botão que ao ser clicado exibe as informações da demanda e do conteúdo do despacho;</li><br>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/lista-de-demanda.png" alt="Detalhes da Demanda" width="80%" >
                                                        </center><br>
                                                        <li>Após ser direcionado para a página de exibição da demanda, informações úteis do processo ajudarão o usuário na elaboração do acompanhamento. O formulário de acompanhamento encontra-se ao final da página;</li><br>
                                                        <li>Caso a demanda tenha outros acompanhamentos já realizados anteriormente, o campo de "Histórico de Acompanhamento" será mostrado logo abaixo do formulário de acompanhamento;</li><br>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/demanda-acompanhamento.png" alt="Inclusão de Acompanhamento de Demanda" width="80%" >
                                                        </center>
                                                        <br><li>Após a inclusão do acompanhamento com o preenchimento dos devidos campos, a inclusão será registrada no "Histórico de Acompanhamento".</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>                                     
                                       
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">2.2 Edição de Acompanhamento de Demandas do SMAP</span>
                                                <a id="edicao_acompanhamento"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        <b>Como exemplo, vamos realizar uma edição de acompanhamento em uma demanda do SMAP:</b>
                                                    </p>
                                                    <ol>
                                                        <li>No menu principal, selecione a opção "Demandas";</li><br>
                                                        <li>Uma listagem de demandas com status "Em Aberto" será mostrada em ordem decrescente pela data de despacho;</li><br>
                                                        <li>Utilize os filtros para encontrar processos ou documentos específicos. Caso não sabia como utilizá-los, <a href="#filtros">Clique Aqui</a>;</li><br>
                                                        <li>Os resultados serão mostrados em uma tabela com várias colunas com informações relevantes. A primeira coluna, chamada de "Ação", apresenta um botão que ao ser clicado exibe as informações da demanda e do conteúdo do despacho;</li><br>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/lista-de-demanda.png" alt="Detalhes da Demanda" width="80%" >
                                                        </center><br>
                                                        <li>Após ser direcionado para a página de exibição da demanda, o sistema exibe o "Histórico de Acompanhamento" ao final da página;</li><br>
                                                        <li>Selecione então a opção de <i>Editar Acompanhamento</i>;</li><br>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/historico_acompanhamento.png" alt="Histórico de Acompanhamento" width="80%" >
                                                        </center><br>
                                                        <li>Atualize os campos que achar necessário e clique em <i>Incluir</i>;</li>                                                        
                                                        <br><li>A demanda editada é listada no "Histórico de Acompanhamento" com suas informações devidamente atualizadas.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">2.3 Encaminhamento de Processos para Remoção</span>
                                                <a id="encaminhar_remocao"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>
                                                        <b>Como exemplo, vamos encaminhar para remoção as demandas que aparecem duplicadas na lista do SMAP:</b>
                                                    </p>
                                                    <ol>
                                                        <li>No menu principal, selecione a opção "Demandas";</li><br>                                                        
                                                        <li>Utilize os filtros para encontrar processos ou documentos específicos. Caso não sabia como utilizá-los, <a href="#filtros">Clique Aqui</a>;</li><br>
                                                        <li>Os resultados serão mostrados em uma tabela com várias colunas com informações relevantes. A primeira coluna, chamada de "Ação", apresenta um botão que ao ser clicado exibe as informações da demanda e do conteúdo do despacho. Já a segunda coluna exibe um <i>checkbox</i> que permite selecionar as demandas a serem encaminhadas para remoção por estarem duplicadas no sistema;</li><br>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/demandas/registros-duplicados.png" alt="Página de Demandas a Serem Arquivadas" width="80%" >
                                                        </center><br>
                                                        <li>Após selecionar as demandas de interesse que serão removidas, basta então escolher a opção de <i>Remover Duplicados</i>;</li><br>
                                                        <li>Clique em Sim para remover a demanda ou em Não para cancelar;</li><br>
                                                        <li>Importante acrescentar que essa remoção não é definitiva. A demanda encaminhada para remoção depende da exclusão de forma definitiva pelo administrador do sistema, que recebe uma listagem de demandas que são reportadas como duplicadas pelos colaboradores.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                    <!-- FIM da Seção de Demandas -->
                                    
                                    
                                    
                                    <!-- INÍCIO da Seção de Relatórios -->
                                    <div class="portlet light ">                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase">3. Relatórios</span>
                                                <a id="relatorios"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>Os relatórios são excelentes ferramentas para uma gestão de sucesso. Dessa forma, a emissão de relatórios do sistema visa fornecer dados atualizados que podem ser gerados com rapidez e ainda serem encaminhados por email.</p>                                                    
                                                    <p>Através do menu do sistema é possível selecionar as opções de "Relatórios por Demanda", "Relatórios por Pendências" e "Relatórios Geral".</p>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/relatorios/menu.png" alt="Menu dos Relatórios" width="80%">
                                                        </center>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>                                        
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">3.1 Relatórios por Demanda</span>
                                                <a id="relatorios_demanda"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A emissão de relatórios por demanda ocorre por meio da funcionalidade "Relatórios por Demanda".</p>
                                                    <p>Nos relatórios por demanda, o usuário filtra os processos que estão sendo acompanhados em determinada Secretaria da DPGU ou em determinada Unidade da DPU, pelo período e situação escolhida.</p>
                                                    <p>Após gerado o relatório, este poderá ser exportado (formatos .pdf / .xls) ou encaminhado por email pelos administradores do sistema.</p>
                                                    <p><b>Como exemplo, vamos emitir um relatório contendo as situações das demandas compreendido em uma data específica:</b></p>
                                                    <ol>
                                                        <li>No menu "Relatórios", selecione a opção <i>Por Demanda</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e aplique o filtro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/relatorios/relatorios_demanda.png" alt="Emissão de Relatórios por Demanda" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O sistema assim retorna o relatório de interesse do usuário.</li>
                                                    </ol>                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">3.2 Relatórios por Pendências</span>
                                                <a id="relatorios_pendencias"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A emissão de relatórios por pendências ocorre por meio da funcionalidade "Relatórios por Pendências".</p>
                                                    <p>Nos relatórios por pendências, o usuário filtra os processos que estão sem movimentação em determinada Secretaria da DPGU ou em determinada Unidade da DPU por um período específico. Podem ser selecionados períodos sem movimentação que estão parados há mais de: + 15 dias, + 30 dias e + 60 dias.</p>
                                                    <p>Após gerado o relatório, este poderá ser exportado (formatos .pdf / .xls) ou encaminhado por email pelos administradores do sistema.</p>
                                                    <p><b>Como exemplo, vamos emitir um relatório contendo os períodos sem movimentação dos acompanhamentos:</b></p>
                                                    <ol>
                                                        <li>No menu "Relatórios", selecione a opção <i>Por Pendências</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e aplique o filtro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/relatorios/relatorios_pendencias.png" alt="Emissão de Relatórios por Pendências" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O sistema assim retorna o relatório de interesse do usuário.</li>
                                                    </ol>                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">3.3 Relatórios Geral</span>
                                                <a id="relatorios_geral"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A emissão de relatórios gerais ocorre por meio da funcionalidade "Relatórios Geral".</p>
                                                    <p>O relatório geral lista a quantidade de processos que passaram por determinados destinos em um período estabelecido, a fim de gerar estatísticas sobre o acervo de demandas que estão em andamento, bem como listar quantos processos já foram concluídos em determinados locais.</p>
                                                    <p>Após gerado o relatório, este poderá ser exportado (formatos .pdf / .xls) ou encaminhado por email pelos administradores do sistema.</p>
                                                    <p><b>Como exemplo, vamos emitir um relatório contendo os períodos de despacho:</b></p>
                                                    <ol>
                                                        <li>No menu "Relatórios", selecione a opção <i>Geral</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e aplique o filtro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/relatorios/relatorios_geral.png" alt="Emissão de Relatórios Geral" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O sistema assim retorna o relatório de interesse do usuário.</li>
                                                    </ol>                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">3.4 Encaminhar Relatórios por Email</span>
                                                <a id="relatorios_email"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>O envio de relatórios por email ocorre por meio da funcionalidade "Encaminhar Relatório por Email".</p>
                                                    <p>Ressaltando que todos os relatórios emitidos dispõem da referida funcionalidade, mas só podem ser enviados pelos administradores do sistema.</p>
                                                    <p><b>Como exemplo, vamos emitir um relatório geral e encaminhá-lo por email:</b></p>
                                                    <ol>
                                                        <li>No menu "Relatórios", selecione a opção <i>Geral</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e aplique o filtro;</li>                                                            
                                                        <li>O sistema assim retorna o relatório de interesse do usuário;</li>
                                                        <li>Desça a página e preencha os campos de destino, assunto e corpo do email. Opcionalmente, inclua um anexo;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/relatorios/email.png" alt="Envio de Relatório por Email" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>Clique em <i>Enviar</i> para encaminhar seu email.</li>
                                                    </ol>                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM da Seção de Relatórios -->
                                          
                                    
                                    
                                    <!-- INÍCIO da Seção da Área Administrativa -->
                                    <?php if ($_SESSION['usuario']['perfil']==1){ ?>
                                    <div class="portlet light ">                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase">4. Área Administrativa</span>
                                                <a id="area_administrativa"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>Um dos objetivos da Área Administrativa é permitir ao administrador do sistema a realização de auditorias, envio de relatórios por email, remoção de demandas duplicadas, gerenciamento de alertas, administração de usuários, cadastro, edição, ativação ou desativação de unidades DPU / secretarias DPGU.</p>
                                                    <p>Através do menu do sistema é possível selecionar as opções de "Administrar Usuários", "Auditoria", "Unidade DPU / Secretaria DPGU", "Gerenciamento de Alertas" e "Processos Duplicados".</p>
                                                        <center>
                                                            <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/menu.png" alt="Menu da Área Administrativa" width="80%">
                                                        </center>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.1 Administrar Usuários</span>
                                                <a id="administrar_usuarios"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A funcionalidade de administração de usuários é uma ferramenta que facilita a gestão de usuários que utilizam o sistema. Tal funcionalidade pode ser usada para cadastrar, editar e gerenciar as permissões de acesso de forma automatizada.</p>
                                                    <p><b>Descrição dos Usuários</b></p>
                                                    <ul>
                                                        <li><u>Administrador</u>: Este usuário pode realizar auditorias, enviar relatórios por email, remover demandas duplicadas, gerenciar alertas, administrar usuários, cadastrar, editar, ativar ou desativar unidades DPU / secretarias DPGU;</li>
                                                        <li><u>Colaborador</u>: Este usuário pode incluir e editar acompanhamento de demandas. Pode também mandar para remoção as demandas que estejam duplicadas. Além disso, pode gerar relatórios;</li>
                                                        <li><u>Consultante</u>: Este usuário pode visualizar o painel, visualizar as demandas, visualizar os acompanhamentos e visualizar os relatórios.</li>
                                                    </ul>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.1.1 Cadastro de Usuários</span>
                                                <a id="cadastro_usuarios"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>O cadastro de usuários no sistema ocorre por meio da funcionalidade "Cadastrar novo usuário".</p>
                                                    <p><b>Como exemplo, vamos cadastrar o usuário João Silva com o perfil de colaborador ativo no sistema:</b></p>
                                                    <ol>
                                                        <li>No menu "Administrar Usuários", selecione a opção <i>Cadastrar novo usuário</i>;</li>
                                                        <li>Primeiramente, pesquise se o usuário já não existe na base de dados do sistema. Se ele existir, o mesmo já será listado com seus respectivos dados;</li>
                                                        <li>Caso o usuário não seja localizado na pesquisa, preencha os campos obrigatórios e efetue o cadastro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/cadastrar_usuário.png" alt="Cadastro de Usuário" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O novo usuário cadastrado é listado na tabela correpondente.</li>
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.1.2 Edição de Usuários</span>
                                                <a id="edicao_usuarios"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A edição de usuários do sistema ocorre por meio da funcionalidade "Editar usuário". A edição permite apenas alterar o nível de acesso e seu status (ativo ou inativo).</p>
                                                    <p><b>Como exemplo, vamos editar o usuário Leonardo Santos Antunes. Atualizaremos seu nível de acesso para consultante:</b></p>
                                                    <ol>
                                                        <li>No menu "Administrar Usuários", selecione a opção <i>Editar usuário</i>;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/editar_usuário.png" alt="Edição de Usuário" width="80%">
                                                                </center>
                                                            <br>
                                                            <li>Edite o campo de nível de acesso para consultante e clique em <i>Atualizar</i>;</li>                                                            
                                                        <li>O usuário editado é listado na tabela correpondente com seu nível de acesso atualizado.</li>                                                            
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.2 Auditoria</span>
                                                <a id="auditoria"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A funcionalidade de auditoria é uma ferramenta que visa assegurar a fidelidade dos registros de tudo que é feito no sistema. Tal ferramenta pode ser usada para controle de acessos, de verificação e de confiabilidade das informações.</p>
                                                    <p>A auditoria no sistema ocorre por meio da funcionalidade "Auditoria".</p>
                                                    <p><b>Como exemplo, vamos exportar para .pdf um registro de auditoria do SMAP que contenha as ações executadas pelo usuário <i>tiago.faria</i>:</b></p>
                                                    <ol>
                                                        <li>No menu "Auditoria", filtre os registros através da funcionalidade <i>Procurar</i> (no caso, as ações executadas pelo referido usuário do sistema);</li>
                                                        <li>Após filtrar os registros de interesse, selecione a opção de exportação para <i>PDF</i>;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/auditoria.png" alt="Auditoria do Sistema" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>Um arquivo com os registros em formato .pdf será então baixado pelo Navegador Web.</li>
                                                    </ol>                                                     
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.3 Unidades DPU / Secretarias DPGU</span>
                                                <a id="unidades_secretarias"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A funcionalidade de Unidades DPU / Secretarias DPGU é uma ferramenta que facilita o cadastro, edição, ativação ou desativação de unidades e secretarias do sistema.</p>
                                                    <p>Uma unidade geralmente está vinculada a uma unidade federativa do país. Já uma secretaria geralmente está vinculada à Administração Superior da DPU.</p>                                                                                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.3.1 Cadastro de Unidades DPU / Secretarias DPGU</span>
                                                <a id="cadastro_unidades_secretarias"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>O cadastro de unidades e secretarias no sistema ocorre por meio da funcionalidade "Cadastrar nova Unidade DPU" ou "Cadastrar nova Secretaria DPGU".</p>
                                                    <p><b>Como exemplo, vamos cadastrar a unidade da DPU localizada em Maceió - AL:</b></p>
                                                    <ol>
                                                        <li>No menu "Unidades DPU / Secretarias DPGU", selecione a opção <i>Cadastrar nova Unidade DPU</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e efetue o cadastro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/cadastrar_unidade.png" alt="Cadastro de Unidade DPU" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>A nova unidade cadastrada é listada na tabela correpondente.</li>
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.3.2 Edição de Unidades DPU / Secretarias DPGU</span>
                                                <a id="edicao_unidades_secretarias"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A edição de unidades e secretarias do sistema ocorre por meio da funcionalidade "Editar Unidade DPU" ou "Editar Secretaria DPGU".</p>
                                                    <p><b>Como exemplo, vamos editar o email da Assessoria de Suporte às Unidades (ASU):</b></p>
                                                    <ol>
                                                        <li>No menu "Unidades DPU / Secretarias DPGU", selecione a opção <i>Editar Secretaria DPGU</i>;</li>
                                                        <li>Importante ressaltar que ao lado do botão de edição existe o botão de ativação / desativação, caso o usuário deseje aplicar essa regra na secretaria que está cadastrada no sistema;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/editar_secretaria.png" alt="Edição de Secretaria DPGU" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>Edite o campo de email para: asu@dpu.def.br;</li>
                                                        <li>Clique em <i>Atualizar</i>;</li>
                                                        <li>A secretaria editada é listada na tabela correspondente com seu email atualizado.</li>                                                            
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>                                                                           
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.4 Gerenciamento de Alertas</span>
                                                <a id="gerenciamento_alertas"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A funcionalidade de Gerenciamento de Alertas é uma ferramenta que facilita o cadastro, a edição e a exclusão de alertas do sistema.</p>
                                                    <p>Um alerta serve para notificar ao usuário sobre processos que possuem características semelhantes e que podem asssim serem devidamente classificados.</p>                                                                                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.4.1 Cadastro de Alertas</span>
                                                <a id="cadastro_alertas"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>O cadastro de alertas no sistema ocorre por meio da funcionalidade "Cadastrar novo tipo de alerta".</p>
                                                    <p><b>Como exemplo, vamos cadastrar um alerta de Diárias e Passagens:</b></p>
                                                    <ol>
                                                        <li>No menu "Gerenciamento de Alertas", selecione a opção <i>Cadastrar novo tipo de alerta</i>;</li>                                                        
                                                        <li>Preencha os campos obrigatórios e efetue o cadastro;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/cadastrar_alerta.png" alt="Cadastro de Alerta" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O novo alerta cadastrado é listado na tabela correpondente.</li>
                                                    </ol>    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.4.2 Edição de Alertas</span>
                                                <a id="edicao_alertas"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A edição de alertas do sistema ocorre por meio da funcionalidade "Editar Alerta".</p>
                                                    <p><b>Como exemplo, vamos editar o ícone do alerta de Diárias e Passagens:</b></p>
                                                    <ol>
                                                        <li>No menu "Gerenciamento de Alertas", selecione a opção <i>Editar Alerta</i>;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/editar_alerta.png" alt="Edição de Alerta" width="80%">
                                                                </center>
                                                            <br>
                                                            <li>Edite o ícone do alerta e clique em <i>Atualizar</i>;</li>
                                                        <li>O alerta editado é listado na tabela correspondente com seu ícone atualizado.</li>                                                            
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.4.3 Exclusão de Alertas</span>
                                                <a id="exclusao_alertas"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A exclusão de alertas do sistema ocorre por meio da funcionalidade "Excluir Alerta".</p>
                                                    <p><b>Como exemplo, vamos excluir o alerta de Diárias e Passagens:</b></p>
                                                    <ol>
                                                        <li>No menu "Gerenciamento de Alertas", selecione a opção <i>Excluir Alerta</i>;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/excluir_alerta.png" alt="Exclusão de Alerta" width="80%">
                                                                </center>
                                                            <br>
                                                            <li>Clique em <i>Sim</i> para excluir o registro ou em <i>Não</i> para cancelar;</li>
                                                        <li>O alerta é removido da tabela correspondente.</li>                                                            
                                                    </ol>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        
                                         <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">4.5 Processos Duplicados</span>
                                                <a id="processos_duplicados"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <p>A funcionalidade de processos duplicados é uma ferramenta que possibilita ao administrador remover as demandas duplicadas que forem reportadas pelos colaboradores do sistema.</p>
                                                    <p><b>Como exemplo, vamos remover algumas demandas que foram sinalizadas como duplicadas:</b></p>
                                                    <ol>
                                                        <li>No menu "Área Administrativa", selecione o submenu "Processos Duplicados";</li>
                                                        <li>O sistema exibe uma tabela de processos nos quais foram sinalizados como duplicados no sistema juntamente com o quantitativo de registros dos mesmos;</li>                                                            
                                                        <li>Selecione os processos a serem exluídos e aplique a ação de remover duplicados;</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/processos_duplicados.png" alt="Processos Duplicados" width="80%">
                                                                </center>
                                                            <br>
                                                        <li>O processo duplicado é removido da tabela correpondente;</li>
                                                        <li>Importante ressaltar que caso o administrador verifique que o processo não é duplicado, ele poderá remover o processo da lista clicando em "Remover da Lista", conforme na imagem abaixo. Dessa forma, esse processo voltará para listagem de demandas do SMAP com status "Em Aberto".</li>
                                                            <br>
                                                                <center>
                                                                    <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/administrativo/remover_da_lista.png" alt="Remover da Lista" width="80%">
                                                                </center>
                                                            <br>
                                                    </ol>                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <!-- FIM da Seção da Área Administrativa -->                                   
                                    
                                    
                                    
                                    <!-- INÍCIO da Seção de Filtros do SMAP -->
                                    <div class="portlet light "> 
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold">5. Filtros do SMAP</span>
                                                <a id="filtros"></a>
                                            </div>
                                            <div class="actions">
                                                <div class="actions">
                                                    <div class="hidden-print">
                                                        <a href="#indice" class="btn btn-circle btn-default">
                                                            <i class="fa fa-mail-reply"></i> Retorne ao Índice </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">                                                    
                                                    <p>
                                                        Os filtros nada mais são do que uma ferramenta de busca por resultados registrados no sistema SMAP. Não podemos nos esquecer de que as informações mais importantes de cada página devem ser consideradas. Caso não saiba quais são, <a href="#demandas">Clique Aqui</a> para visualizar o tutorial de acompanhamento de "Demandas do SMAP".
                                                    </p>
                                                    <p>
                                                        <b>Atenção:</b> Em páginas que contém os dois filtros abordados abaixo, recomendamos sempre utilizar o primeiro filtro que é exibido a seguir. O mesmo busca nos registros do banco de dados e não na tabela.
                                                    </p>
                                                    <p>
                                                        <b>Informações Importantes:</b> Como utilizar os filtros com mais eficiência nas páginas de "Demandas do SMAP" e em todos os relatórios.
                                                    </p>
                                                    <ul>
                                                        <li>Por nº do processo / nº do documento SEI:</li>
                                                        <ul>
                                                            <li>Este filtro funciona buscando pelo número de Processo ou pelo número do Documento SEI. É possível mesclar com o filtro "Por Situaçao".</li>
                                                        </ul>
                                                        <br>
                                                        <li>Data de Despacho pela SGE:</li>
                                                        <ul>
                                                            <li>Informe um período entre as datas para que o sistema realize a busca dos registros. Necessariamente, este campo deve estar mesclado com o filtro de "Por Unidade DPU / Secretaria DPGU" de destino, ou "Por Situação", ou ambos.</li>
                                                        </ul>
                                                        <br>
                                                        <li>Por Unidade DPU / Secretaria DPGU de destino:</li>
                                                        <ul>
                                                            <li>Com este filtro é possível especificar todas as secretarias, todas as unidades, buscar somente por uma secretaria ou unidade. É possível ainda mesclar com o filtro "Por Situaçao", no entanto, é obrigatório informar a "Data de Despacho pela SGE". </li>
                                                        </ul>
                                                        <br>
                                                        <li>Por Situação: </li><ul>
                                                            <li>Filtra as demandas registradas em sua atual situação. Há quatro situações possíveis atualmente: "Em Aberto", "Em Andamento", "Concluído" e "Ciente".</li>
                                                        </ul>
                                                    </ul>
                                                    <br>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/filtros/filtro-smap.png" alt="Filtros do SMAP" width="80%" >
                                                    </center>                                                    
                                                    <br>                                                    
                                                    <p>
                                                        <b>Informações Importantes:</b> Existe um filtro segundário em tabelas do sistema chamado "Pesquisar". Sua finalidade é procurar por resultados contidos na tabela e, simultaneamente, ocultar registros não encontrados. Segue abaixo um exemplo de filtro de tabela:
                                                    </p>
                                                    <center>
                                                        <img style="border:1px solid black" src="<?php echo IMG; ?>tutorial/filtros/filtro-tabela.png" alt="Filtros de Pesquisa" width="80%" >
                                                    </center>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM da Seção de Filtros do SMAP -->                                    
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>



<!-- Script de Otimização de Âncora -->
<script>
    var $doc = $('html, body');
    $('a').click(function(){
        $doc.animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 1000);
        return false;
    });
</script>