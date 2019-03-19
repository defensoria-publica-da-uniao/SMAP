<?php
$consulta_arvore = $objSmap->select_cdestino_arvore();

while ($result = mssql_fetch_array($consulta_arvore)) {
    switch ($result['tbr_id_regiao']) {
        case 1:
            $c_oeste[] = utf8_encode($result['tbe_str_estado']);
            $unidade_Oeste[] = utf8_encode($result['tbu_str_descricao']);
            break;
        case 2:
            $nordeste[] = utf8_encode($result['tbe_str_estado']);
            $unidade_nordeste[] = utf8_encode($result['tbu_str_descricao']);
            break;
        case 3:
            $estados_norte[] = utf8_encode($result['tbe_str_estado']) . ' - ' . utf8_encode($result['tbe_str_uf']);
            if ($result['tbu_id_estado'] == $result['tbe_id_estado']) {
                $unidade_norte[] = utf8_encode($result['tbu_str_descricao']);
                $idEstadoNorte[] = $result['tbe_id_estado'];
                $idUnidadeNorte[] = $result['tbu_id_estado'];
            }
            break;
        case 4:
            $sudeste[] = utf8_encode($result['tbe_str_estado']);
            $unidade_sudeste[] = utf8_encode($result['tbu_str_descricao']);
            break;
        case 5:
            $sul[] = utf8_encode($result['tbe_str_estado']);
            $unidade_sul[] = utf8_encode($result['tbu_str_descricao']);
            break;
    }
}
$idEstadoNorte = array_unique($idEstadoNorte);
$estados_norte = array_unique($estados_norte);
$estados_norte = implode(".", $estados_norte);
$unidade_norte = implode(".", $unidade_norte);
$idEstadoNorte = implode(".", $idEstadoNorte);
$idUnidadeNorte = implode(".", $idUnidadeNorte);
?>

<script>
    //Declarar variável
    var estados_norte;
    var unidade_norte;
    var idEstadoNorte;
    var idUnidadeNorte;
    //Receber variável php
    unidade_norte = "<?php echo $unidade_norte; ?>";
    estados_norte = "<?php echo $estados_norte; ?>";

    idEstadoNorte = "<?php echo $idEstadoNorte; ?>";
    idUnidadeNorte = "<?php echo $idUnidadeNorte; ?>";
    //Dividir Variável para variar array
    estados_norte = estados_norte.split(".");
    unidade_norte = unidade_norte.split(".");

    idEstadoNorte = idEstadoNorte.split(".");
    idUnidadeNorte = idUnidadeNorte.split(".");
    console.log(idUnidadeNorte);

    var UITree = function () {

        var contextualMenuSample = function () {

            $("#tree_40").jstree({
                "core": {
                    "themes": {
                        "responsive": false
                    },
                    // so that create works
                    "check_callback": true,
                    'data': [{
                            "text": "DPGU - Administração Superior",
                            "children": [{
                                    "text": "DPGU"
                                }]
                        },
                        {
                            "text": "DPU - Órgão de Atuação (Unidade)",

                            "children": [{
                                    "text": "Norte",
                                    "children": (function () {
                                        var estado = [];
                                        for (i = 0; i < estados_norte.length; i++) {
                                            estado.push({
                                                "text": estados_norte[i],
                                                "children": (function () {

                                                    var unidade = [];
                                                    for (j = 0; j < unidade_norte.length; j++) {
                                                        if (idUnidadeNorte[j] == idEstadoNorte[i]) {
                                                            unidade.push({
                                                                "text": unidade_norte[j],
                                                            })
                                                        }
                                                    }
                                                    return unidade;
                                                }()),
                                            })
                                        }
                                        return estado;
                                    }()),
                                }]
                        }
                    ]
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file": {
                        "icon": "fa fa-file icon-state-warning icon-lg"
                    }
                },
                "state": {"key": "demo2"},
                "plugins": ["contextmenu", "dnd", "state", "types"]
            });
        }

        return {
            //Função principal para inicialização do módulo.
            init: function () {
                contextualMenuSample();
            }
        };
    }();
    if (App.isAngularJsApp() === false) {
        jQuery(document).ready(function () {
            UITree.init();
        });
    }
</script>                                        