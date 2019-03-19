<?php
require_once INCLUDES . 'validaLogin.php';
require_once 'controller/administrador/Cgerencia_usuarios.php';

//  require_once 'controller/Cdestino_arvore.php';
?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <div class="page-content-inner">


                            <!-- ÁRVORE -- >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="portlet light ">
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light ">

                                                    <div class="portlet-body">
                                                        <div id="tree_40" class="tree-demo"> 
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FIM ÁRVORE -->


                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="page-title" align="center">
                                        <span class="caption-subject font-dark bold uppercase">
                                            <br/>

                                            <?php
                                            if (!empty($_SESSION['MSGDU'])) {
                                                $msg = $_SESSION['Mensagem'];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-lg-offset-3 col-xl-offset-3 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="alert alert-block alert-msn-texto fade in alert-msn-borda">
                                                            <button type="button" class="close" data-dismiss="alert"></button>
                                                            <h4 class="alert-heading bold">Sucesso!</h4>
                                                            <p style="text-transform: capitalize!important;"><?php echo $msg ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            unset($_SESSION['MSGDU']);
                                            unset($_SESSION['Mensagem']);
                                            ?>

                                            <div class="m-heading-1 border-green m-bordered">
                                                <h3 style="margin-top: 10px;"><b>Área de Administrador</b></h3>
                                                <h4>Controle do usuário</h4>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3">

                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <span class="caption-subject bold uppercase font-dark"> Quantidade</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body todo-project-list-content">
                                            <div class="todo-project-list">
                                                <ul class="nav nav-stacked">
                                                    <li style="text-align: left !important;">
                                                        <p style="padding-left: 10px;">
                                                            <span class="badge badge-success"> <?php echo $ativos; ?> </span> Usuários Ativos </p>
                                                    </li>
                                                    <li style="text-align: left !important;">
                                                        <p style="padding-left: 10px;">
                                                            <span class="badge badge-danger"><?php echo $inativos; ?> </span> Usuários Inativos </p>
                                                    </li>
                                                    <li style="text-align: left !important;">
                                                        <p style="padding-left: 10px;">
                                                            <span class="badge badge-info"> <?php echo $consultantes; ?> </span> Usuários Consultantes </p>
                                                        <!-- Somente é contado os usuários ativos -->
                                                    </li>
                                                    <li style="text-align: left !important;">
                                                        <p style="padding-left: 10px;">
                                                            <span class="badge badge-info"> <?php echo $colaboradores; ?> </span> Usuários Colaboradores </p>
                                                        <!-- Somente é contado os usuários ativos -->
                                                    </li>
                                                    <li style="text-align: left !important;">
                                                        <p style="padding-left: 10px;">
                                                            <span class="badge badge-info"> <?php echo $administradores; ?> </span> Usuários Administradores </p>
                                                        <!-- Somente é contado os usuários ativos -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">


                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <span class="caption-subject bold uppercase"> Usuários</span>
                                            </div>
                                            <div class="tools"> 

                                                <button type="button" class="btn btn-success" data-toggle="modal"  data-target='#cadastrar'>
                                                    Cadastrar novo usuário 
                                                </button>

                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table id="sample_3" class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Ação</th>
                                                        <th class="text-center">Nome completo</th>
                                                        <th class="text-center">Login</th>
                                                        <th class="text-center">Nível de acesso</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Data do cadastro</th>
                                                        <th class="text-center">Criado por</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($gerencia_usuario_r = mssql_fetch_array($gerencia_usuario)) { ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <button type="button" class="btn blue-madison btn-xs mod popovers" data-toggle="modal" data-doc="<?php echo $gerencia_usuario_r['id_usuario']; ?>" data-target='#visualiza_usuario_editar' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                                    <i class="glyphicon glyphicon-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td><?php echo utf8_encode($gerencia_usuario_r ['str_nome']); ?></td>
                                                            <td><?php echo utf8_encode($gerencia_usuario_r ['str_login']); ?></td>
                                                            <td> <?php echo $gerencia_usuario_r['str_perfil']; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($gerencia_usuario_r['int_estatus'] == 1) {
                                                                    echo "<span class='label label-sm label-success'> Ativo </span></td>";
                                                                } else if ($gerencia_usuario_r['int_estatus'] == 0) {
                                                                    echo "<span class='label label-sm label-danger'> Inativo </span></td>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo utf8_encode($gerencia_usuario_r ['dt_criacao']); ?></td>
                                                            <td><?php echo utf8_encode($gerencia_usuario_r ['usr_criador']); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL | id=cadastrar -->
<div class="modal fade bs-modal-lg" id="cadastrar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4 ><b>Cadastrar novo usuário</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>      
                            </h4>
                        </div>
                    </span>
                </div>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Dados gerais</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <div class="form-body">
                                    <form id="busca_usuario">
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Login:</label>
                                                <input class="form-control spinner" maxlength="40" name="str_login" id="str_login" type="text" placeholder="Login" required> 
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >.</label>
                                                <button type="submit" class="form-control btn btn-primary" >Pesquisar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="fetched-data">
                                        <!-- Vai abrir aqui o conteudo do arquivo ajax -->
                                    </div>
                                    <form action="<?php echo CONTROLLER . 'administrador/Coperacoes.php'; ?>" method="POST">
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Nível de acesso:</label>
                                                <select class="form-control" name="id_perfil" required="">
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Colaborador</option>
                                                    <option value="3">Consultante</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="form-group col-md-6">
                                                    <label style="text-align:left !important;" >Status:</label><br>
                                                    <!-- <input name="int_estatus" type="checkbox" class="make-switch" data-on-text="&nbsp;Ativo&nbsp;" data-off-text="&nbsp;Inativo&nbsp;" data-on-color="success" data-off-color="danger">
                                                    -->
                                                    <select class="form-control" name="int_estatus" required="">
                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

                <input type="hidden" name="insert_usuario" value="4000000"/>
                <input type="hidden" name="nome_usuario" id ="usuario" value=""/>
                <input type="hidden" name="login" id ="login" value=""/>


                <input type="hidden" name="id_documento" value="<?php echo $_SESSION['usuario']['login']; ?>" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL | id=cadastrar -->

<!-- MODAL | id=editar -->
<div class="modal fade bs-modal-lg" id="visualiza_usuario_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4 ><b>Editar dados do usuário</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>      
                            </h4>
                        </div>
                    </span>
                </div>
            </div>

            <div class="modal-body">

                <div class="fetched-data_usuarios">
                    <!-- Vai abrir aqui o conteudo do arquivo ajax -->
                </div>

            </div>

        </div>
    </div>
</div>
<!-- FIM MODAL | id=editar -->

<!-- Ajax para editar usuário -->
<?php
$caminho3 = CONTROLLER . 'administrador/Cform_edit.php';
$caminhousuario = CONTROLLER . 'buscausuario.php';
?>
<script>

    var caminho3;
    caminho3 = '<?php echo $caminho3 ?>';

    $(document).ready(function () {
        $('#visualiza_usuario_editar').on('show.bs.modal', function (e) {
            var id_usuario = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'post',
                url: caminho3,
                data: 'id_usuario=' + id_usuario,
                success: function (data) {
                    $('.fetched-data_usuarios').html(data);

                }
            });
        });

    });

    var caminhousuario;
    caminhousuario = '<?php echo $caminhousuario ?>';

    $(function () {
        $('#busca_usuario').submit(function (event) {
            event.preventDefault();// using this page stop being refreshing 
            var login = $('#str_login').val();
            $.ajax({
                type: 'POST',
                url: caminhousuario,
                data: $('form').serialize(),
                success: function (data) {
                    $('.fetched-data').html(data);
                    $('#login').val(login);
                    var nome = $('#nome_usuario_ajax').val();
                    $('#usuario').val(nome);
                }
            });

        });
    });
</script>


