
//toUpperCase
function handleInput(e) {
    var ss = e.target.selectionStart;
    var se = e.target.selectionEnd;
    e.target.value = e.target.value.toUpperCase();
    e.target.selectionStart = ss;
    e.target.selectionEnd = se;
}

//---------------------------------------------------------------------------------
//Endereço
function getDadosEnderecoPorCEP(cep) {
    var url = 'https://viacep.com.br/ws/' + cep + '/json/'

    var xmlHttp = new XMLHttpRequest()
    xmlHttp.open('GET', url)

    xmlHttp.onreadystatechange = () => {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var dadosJSONText = xmlHttp.responseText
            var dadosJSONObj = JSON.parse(dadosJSONText)

            document.getElementById('logradouro').value = dadosJSONObj.logradouro
            document.getElementById('bairro').value = dadosJSONObj.bairro
            document.getElementById('complemento').value = dadosJSONObj.complemento
            document.getElementById('cidade').value = dadosJSONObj.localidade
            document.getElementById('uf').value = dadosJSONObj.uf

        }
    }
    xmlHttp.send()
}


//Ajax --------------------------------------------------------------


// notification
function notification (title, message, template){
    function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            title: title,
            message: message,
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: {
                x: 20,
                y: 85
            },
            spacing: 10,
            z_index: 2031,
            delay: 2500,
            timer: 5000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: template
        });

    };

    $( function(){
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');

        notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

//---------------------------------------------------------------------------------
//home
$(document).ready(function() {

    $.get({
    url: '/api/home',
        success: function (response) {

                //
                total_itens = '<i class="text-white" style="font-size: 25px;">'+ response.count_total_itens +'</i>'
                itens_inativos = '<i class="text-white" style="font-size: 25px;">'+ response.count_itens_inativos +'</i>'
                count_categorias = '<i class="text-white" style="font-size: 25px;">'+ response.count_categorias +'</i>'
                count_empresas = '<i class="text-white" style="font-size: 25px;">'+ response.count_empresas +'</i>'

                $('#count_total_itens').append(total_itens);
                $('#count_itens_inativos').append(itens_inativos);
                $('#count_categorias').append(count_categorias);
                $('#count_empresas').append(count_empresas);

                var dataCatHome = []
                var dataEmpHome = []
                var cat_data = ''
                var emp_data = ''
                $.each(response.categorias, function (key, value) {
                    dataCatHome.push([
                        value.descricao,
                        value.produtos.length
                    ]);
                    cat_data += '<li class="list-group-item"><a href="#" class="text-light text-decoration-none">'+ value.descricao +'<span class="float-end">Itens: '+ value.produtos.length +'</span></a></li>'
                })

                $.each(response.empresas, function (key, value) {
                    dataEmpHome.push([
                        value.razao_social,
                    ]);
                    emp_data += '<li class="list-group-item"><a href="#" class="text-light text-decoration-none">'+ value.razao_social +'</a></li>'
                })

                $('#categorias_home').append(cat_data);
                $('#empresas_home').append(emp_data);

            //---------------------------------------------------------------------------------
            //charts js

            //charts qtd itens por categoria
                var dataSetLabels = [];
                var dataSetData = [];
                $.each(response.categorias, function (key, value) {
                    dataSetLabels.push([
                        value.descricao
                    ]);
                    dataSetData.push(
                        value.produtos.length
                    );
                })

                //Gerador de cores
                function color_hexadecimal()
                {
                    return '#' + parseInt((Math.random() * 0xffffff))
                    .toString(16)
                    .padStart(6, '0');
                }

                var color = []
                for (let i = 0; i < dataSetData.length; i++) {
                    color.push(color_hexadecimal(i))
                }

                var ctx = document.getElementById("itensCategoria");
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    labels: dataSetLabels,
                    datasets: [
                        {
                            label: "Population (millions)",
                            backgroundColor: color,
                            data: dataSetData
                        }
                    ]
                    },
                    options: {
                    title: {
                        display: true,
                        text: 'Itens por Categoria'
                    },
                    }
                });


            //charts valor por categoria
                var descr_cat = [];
                var valor_Cat = [];
                $.each(response.valor_categorias, function (key, value) {
                    descr_cat.push(
                        value.descricao
                    );
                    valor_Cat.push(
                        value.total
                    );

                })

                var ctx = document.getElementById("valorCategoria");
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: descr_cat,
                        datasets: [{
                            data: valor_Cat,
                            backgroundColor: color
                        }]
                    },
                    options: {
                            "hover": {
                            "animationDuration": 0
                        },
                        "animation": {
                            "duration": 1,
                            "onComplete": function () {
                                var chartInstance = this.chart,
                                    ctx = chartInstance.ctx;

                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'bottom';

                                this.data.datasets.forEach(function (dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function (bar, index) {
                                        var data = dataset.data[index];
                                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                    });
                                });
                            }
                        },
                        legend: {
                            "display": false,
                            padding: 20,
                        },
                        title: {
                            padding: 20,
                            display: true,
                            text: 'Valor por Categoria'
                        },
                        tooltips: {
                            "enabled": false,
                        },
                        scales: {
                            yAxes: [{
                                    display: true,
                                    gridLines: {
                                    display : true
                                },
                                ticks: {
                                        display: true,
                                    beginAtZero:true
                                }
                            }],
                            xAxes: [{
                                    gridLines: {
                                    display : true
                                },
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            //Chart Valores por Empresa
            var empresas = []
            var valor_total = []
            var valor_depr = []
            $.each(response.total_valor_empresas, function (key, value) {
                empresas.push([
                    value.fantasia
                ]);
                valor_total.push(
                    value.total
                );
                valor_depr.push(
                    value.depreciado
                );
            });

            new Chart(document.getElementById('valorEmpresas'), {
                type: 'bar',
                data: {
                    labels: empresas,
                    datasets: [
                        {
                        label: 'Valor Total',
                        backgroundColor: "#3e95cd",
                        data: valor_total,
                        borderWidth: 1
                        },
                        {
                        label: 'Valor com Depreciação',
                        backgroundColor: "#8e5ea2",
                        data: valor_depr,
                        borderWidth: 1
                        },
                    ],
                },

                options: {
                    tooltips: {enabled: false},
                    "hover": {
                        "animationDuration": 0
                    },
                    "animation": {
                        "duration": 1,
                        "onComplete": function () {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function (bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                });
                            });
                        }
                    },
                    legend: {
                        "display": true,
                        padding: 20,
                    },
                    title: {
                        padding: 20,
                        display: true,
                        text: 'Valor Total e Depreciados por Empresa'
                    },
                    scales: {
                        yAxes: [{
                                display: true,
                                gridLines: {
                                display : true
                            },
                            ticks: {
                                    display: true,
                                beginAtZero:true
                            }
                        }],
                        xAxes: [{
                                gridLines: {
                                display : true
                            },
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });
});


//---------------------------------------------------------------------------------
// New Empresa
$(document).ready(function() {
    $('#form-new-empresa').submit(function (e) {
        e.preventDefault()
        var url = $(this).attr("action");
        var formData = new FormData($(this)[0])
        var form = formData

        $.ajax({
            data: form,
            url: url,
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('#loading').modal('show');
            },

            success: function (response) {

                $('[data-name="form-new-empresa"]').val('');
                $("#load_modal_form_new").load(location.href + " #load_modal_form_new");

                var select_empresa = '';
                select_empresa = '<option value=" '+ response.id +' ">'+ response.razao_social +'</option>';
                $('#select_empresa').append(select_empresa);

                title = ' <i class="bi bi-check2-square"></i> '
                message = 'Empresa cadastrada com sucesso!'
                template =
                    '<div class="alert alert-success" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                setTimeout(function() {
                    notification(title, message, template)
                    $("#load-section").load(location.href + " #load-section");
                    $('#new-cliente').modal('hide');
                }, 1000);
            },

            error: function (response) {
                title = ' <i class="bi bi-exclamation-circle"> </i> '
                message = response.responseJSON.message
                template =
                    '<div class="alert alert-danger" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                notification(title, message, template)
            },

            complete: function () {
                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 1000);
            }

        })
    })
});
$("#clean-form-new-empresa").click(function () {
    $('[data-name="form-new-empresa"]').val('');
});

//---------------------------------------------------------------------------------
// Edit Empresa
$(document).on('click','#button-edit-empresa', function() {
    $('#form_edit_empresa').submit(function (e) {
        e.preventDefault()
        var url = $(this).attr("action");
        var formData = new FormData($(this)[0])
        var form = formData

        $.ajax({
            data: form,
            url: url,
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('#loading').modal('show');
            },

            success: function (response) {
                // $('#loading').modal('hide');
                $('#editar-empresa'+response.id).modal('hide');

                // recarregar a div
                $("#load-section").load(location.href + " #load-section");

                title = ' <i class="bi bi-check2-square"></i> '
                message = 'Empresa atualizada com sucesso!'
                template =
                    '<div class="alert alert-success" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'
                    setTimeout(function() {
                        notification(title, message, template)
                        $('#editar-empresa'+response.id).modal('hide');
                    }, 1000);


            },

            error: function (response) {
                title = ' <i class="bi bi-exclamation-circle"> </i> '
                message = response.responseJSON.message
                template =
                    '<div class="alert alert-danger" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                notification(title, message, template)
            },

            complete: function (response) {
                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 1000);
            }

        })
    })
});

//---------------------------------------------------------------------------------
// Edit Categoria
// $(document).ready(function() {
//     $(document).on('click','#button-edit-categoria', function() {
//         $("#form_update_categoria").submit(function (e) {
//             e.preventDefault()
//             url = $(this).attr("action")
//             $.ajax({
//                 data: $(this).serialize(),
//                 url: url,
//                 type: 'post',
//                 dataType: 'json',

//                 success: function (response) {
//                     console.log(response)

//                     $('#update_categoria'+response.id).modal('hide');

//                     title = ' <i class="bi bi-check2-square"></i> '
//                     message = 'Categoria Atualizada com sucesso!'
//                     template =
//                         '<div class="alert alert-success" role="alert">' +
//                         '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
//                         '</div>'

//                     notification(title, message, template)

//                     window.location.href = response.intended
//                 },

//                 error: function (response) {
//                     title = ' <i class="bi bi-exclamation-circle"> </i> '
//                     message = response.responseJSON.message
//                     template =
//                         '<div class="alert alert-danger" role="alert">' +
//                         '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
//                         '</div>'

//                     notification(title, message, template)

//                 }
//             })
//         })
//     })
// });

//---------------------------------------------------------------------------------
// New Categoria
$(document).on('click','#button-new-categoria', function() {
    $('#new_categoria').submit(function (e) {
        e.preventDefault()
        url = $(this).attr("action")
        $.ajax({
            data: $(this).serialize(),
            url: url,
            type: 'post',
            dataType: 'json',

            success: function (response) {
                console.log(response)
                $('[data-name="form-new-categoria"]').val('');
                $('#new-categoria').modal('hide');


                title = ' <i class="bi bi-check2-square"></i> '
                message = 'Categoria cadastrada com sucesso!'
                template =
                    '<div class="alert alert-success" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                    notification(title, message, template)

                    var categoria = '';
                    categoria = '<div class="card bg-white shadow rounded-custom border-0 m-2" style="width: 18rem;">'+
                    '<div class="card-body">'+
                    '<h6 class="card-title text-muted float-start">'+ response.descricao +'</h6>'+
                    '<button class=" btn btn-sm float-end" id="navbarDropdown+ response.id +" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>'+
                    '<ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown'+ response.id +'">'+
                    '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_categoria'+ response.id +'">Editar <i class="bi bi-pen float-end"></i></a></li>'+
                    '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detalhe-categoria'+ response.id +'">Detalhes <i class="bi bi-list-check float-end"></i></a></li>'+
                    '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#excluir-categoria'+ response.id +'">Excluir <i class="bi bi-x float-end"></i></a></li>'+
                    '</ul>'+
                    '</div>'+
                    '</div>'

                var select_categoria = '';
                select_categoria = '<option value=" '+ response.id +' ">'+ response.descricao +'</option>';

                $('#load-categoria').append(categoria);
                $('#select_categoria').append(select_categoria);
                $("#load-section").load( "/categorias #load-section");
                $("#load_modal_form_new").load( "/categorias #load_modal_form_new");
                $("#load_modal_form_new").load( "/cadastro_itens #load_modal_form_new");
            },

            error: function (response) {
                console.log(response.responseJSON.message)
                title = ' <i class="bi bi-exclamation-circle"> </i> '
                message = response.responseJSON.message
                template =
                    '<div class="alert alert-danger" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                notification(title, message, template)

            }
        })
    })
});

//---------------------------------------------------------------------------------
// New item
$(document).ready(function() {
    $('#form_new_item').submit(function (e) {
        e.preventDefault()
        var url = $(this).attr("action");
        var formData = new FormData($(this)[0])
        var form = formData

        $.ajax({
            data: form,
            url: url,
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('#loading').modal('show');
            },

            success: function (response) {
                console.log(response)
                $('[data-name="new-item"]').val('');
                $('#loading').modal('hide');

                title = ' <i class="bi bi-check2-square"></i> '
                message = 'Item inserido com sucesso!'
                template =
                    '<div class="alert alert-success" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                setTimeout(function() {
                    notification(title, message, template)
                }, 1000);

            },

            error: function (response) {
                console.log(response)
                title = ' <i class="bi bi-exclamation-circle"> </i> '
                message = response.responseJSON.message
                template =
                    '<div class="alert alert-danger" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                notification(title, message, template)
            },

            complete: function () {
                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 1000);

            }

        })
    })
});

//---------------------------------------------------------------------------------
// Edit item
$(document).ready(function() {
    $(document).on('click','#button-edit-item', function() {
        $('#form_edit_item').submit(function (e) {
            e.preventDefault()
            var url = $(this).attr("action");
            var formData = new FormData($(this)[0])
            var form = formData

            $.ajax({
                data: form,
                url: url,
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,

                beforeSend: function () {
                    $('#loading').modal('show');
                },

                success: function (response) {
                    $('#loading').modal('hide');
                    $('#edit-item'+response.id).modal('hide');
                    $("#load-section").load(location.href + " #load-section");

                    title = ' <i class="bi bi-check2-square"></i> '
                    message = 'Item Atualizado com sucesso!'
                    template =
                        '<div class="alert alert-success" role="alert">' +
                        '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                        '</div>'

                    setTimeout(function() {
                        notification(title, message, template)
                        $("#load-section").load(location.href + " #load-section")
                    }, 1000);


                },

                error: function (response) {
                    title = ' <i class="bi bi-exclamation-circle"> </i> '
                    message = response.responseJSON.message
                    template =
                        '<div class="alert alert-danger" role="alert">' +
                        '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                        '</div>'

                    notification(title, message, template)
                    setTimeout(function() {
                        $('#loading').modal('hide');
                    }, 1000);

                },

                complete: function (response) {
                    $('#edit-item'+response.id).modal('hide');
                    setTimeout(function() {
                        $('#loading').modal('hide');
                    }, 1000);
                }

            })
        })
    })
});

//---------------------------------------------------------------------------------

//calculo valor depreciado
document.getElementById('tx_depreciacao').onkeyup = function() {
    var valor = parseFloat(document.getElementById('valor').value.replace('.', ''));
    var resultado = valor * (parseFloat(this.value.replace(',', '.'))/100);
    var valor_depr = valor - resultado;
    document.getElementById('item_valor_depr').value = valor_depr.toLocaleString('pt-BR');
}






