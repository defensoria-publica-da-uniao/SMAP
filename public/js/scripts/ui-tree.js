var UITree = function () {

    var handleSample1 = function () {

        $('#tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }            
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "plugins": ["types"]
        });

        // Recurso de âncora HTML
        $('#tree_1').on('select_node.jstree', function() { 
            $('a').click(function() {
                    $doc.animate({
                        scrollTop: $( $.attr(this, 'href') ).offset().top
                    }, 1000);
                    return false;
                });
        });



        /* handle link clicks in tree nodes(support target="_blank" as well)
        $('#tree_1').on('select_node.jstree', function(e,data) { 
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
        
        */
    }

    var handleSample2 = function () {
        $('#tree_2').jstree({
            'plugins': ["wholerow", "checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false
                },    
                'data': [{
                        "text": "Same but with checkboxes",
                        "children": [{
                            "text": "initially selected",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "custom icon",
                            "icon": "fa fa-warning icon-state-danger"
                        }, {
                            "text": "initially open",
                            "icon" : "fa fa-folder icon-state-default",
                            "state": {
                                "opened": true
                            },
                            "children": ["Another node"]
                        }, {
                            "text": "custom icon",
                            "icon": "fa fa-warning icon-state-warning"
                        }, {
                            "text": "disabled node",
                            "icon": "fa fa-check icon-state-success",
                            "state": {
                                "disabled": true
                            }
                        }]
                    },
                    "And wholerow selection"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    }

    var contextualMenuSample = function() {

        $("#tree_3").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }, 
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "DPGU - Administração Superior",
                        "children": [{
                            "text": "CSDPU",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "DPGU",
                            "icon": "fa fa-warning icon-state-danger",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "GabDPGF", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ASPLAN", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ASCOM", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ASCE", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ASLEG", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "AJUR", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "CCR", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "AASTF", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ASME", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "SGAI", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "SGCIA", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "SGE", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "ESDPU", "icon" : "fa fa-file icon-state-warning"}
                            ]
                        }, {
                            "text": "SubDPGU",
                            "icon" : "fa fa-folder icon-state-success"
                        }, {
                            "text": "CGDPU",
                            "icon": "fa fa-warning icon-state-warning"
                        }]
                    },
                    "DPU - Órgão de Atuação (Unidade)"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "dnd", "state", "types" ]
        });
    
    }
    
    var ajaxTreeSample = function() {

        $("#tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }, 
                // so that create works
                "check_callback" : true,
                'data' : {
                    'url' : function (node) {
                      return '../demo/jstree_ajax_data.php';
                    },
                    'data' : function (node) {
                      return { 'parent' : node.id };
                    }
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo3" },
            "plugins" : [ "dnd", "state", "types" ]
        });
    
    }

    return {
        //Função principal para inicialização do módulo.
        init: function () {

            handleSample1();
            handleSample2();
            contextualMenuSample();
            ajaxTreeSample();

        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {    
       UITree.init();
    });
}