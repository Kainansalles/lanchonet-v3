$(function(){
    //setInterval(function() {
    //    $('#table_demands').mDatatable().ajax.reload();
    //}, 1000 );

    // Método para criar a tabela com produtos
    $('#table_demands')
    .on( 'preXhr.dt', function () {
        mApp.block("#content-table-products", {
            overlayColor: "#000000",
            type: "loader",
            state: "primary",
            message: "Processando.."
        });
    })
    .on( 'xhr.dt', function () {
        mApp.unblock("#content-table-products");
        renderDemand();
        optionsDemand();
    })
    .mDatatable({
        orderFixed: [ 3, 'desc' ],
        paging : true,
        responsive: true,
        stateSave: true,
        "ajax": { "url": "/admin/pedidos/all" },
        "columns": [
            { "data": "id", "title": "#" },
            { "data": "client.name", "title": "Nome" },
            { "data": "status_demand.description", "title": "Status" },
            { "data": "hour_recall", "title": "Horário de retirada"},
            // { "data": "created_at", "title": "Horário do pedido", "visible" : false},
            {data: 'action', name: 'action', "title":"Ações", orderable: false, searchable: false}
        ],
        // "columnDefs": [
        //     { "width": "1%", "targets": 0 },
        //     { "width": "10%", "targets": 1 },
        //     { "width": "5%", "targets": 2 },
        //     { "width": "5%", "targets": 3 },
        //     { "width": "10%", "targets": 4 }
        // ],
        dom: 'Bflrtip',
        buttons: [
            {
                text: 'Entregas atuais',
                className: 'btn btn-primary botoes-filtro',
                action: function ( e, dt, node, config ) {
                    $('.botoes-filtro').removeClass('active botoes-filtro-efeito');
                    $("#table_demands").addClass('fl-datatable');
                    node.addClass('active botoes-filtro-efeito');
                    $("#status_demand_description").val('');
                    $('#table_demands').mDatatable().ajax.url( '/admin/pedidos/all' ).load();
                },
                init: function (e, settings, json) {
                    settings.addClass('active botoes-filtro-efeito');
                }
            },
            {
                text: 'Cancelados',
                className: 'btn btn-danger botoes-filtro',
                action: function ( e, dt, node, config ) {
                    $('.botoes-filtro').removeClass('active botoes-filtro-efeito');
                    $("#table_demands").removeClass('fl-datatable');
                    node.addClass('active botoes-filtro-efeito');
                    $('#table_demands').mDatatable().ajax.url( '/admin/pedidos/allcancel' ).load();
                }
            },
            {
                text: 'Finalizados',
                className: 'btn btn-success botoes-filtro',
                action: function ( e, dt, node, config ) {
                    $('.botoes-filtro').removeClass('active botoes-filtro-efeito');
                    $("#table_demands").removeClass('fl-datatable');
                    node.addClass('active botoes-filtro-efeito');
                    $('#table_demands').mDatatable().ajax.url( '/admin/pedidos/allfinalized' ).load();
                }
            }
        ],
        "language": {
            "url": document.location.origin+ "/js/pt-br-translations-datatable.json"
        }
    });

    // Método para renderizar demanda
    function renderDemand(){
        $('body').off('click').on('click', '.view_demand', function(){
            var id = $(this).attr('id');
            $('#content-modal').html('');
            $.getJSON( "/admin/pedidos/" + id, function( data ) {
                $('#content-modal').html(data.view);
            });
            $('#modalDemandTarget').modal('show');
        });
    }

    // Método para realizar ações dos botões
    function optionsDemand(){
        if($("#status_demand_description").val() == "Cancelado" ||
            $("#status_demand_description").val() == "Finalizado"){
        }else{
            $('body').on('click', '.confirm_demand', function(){
                var id = $(this).attr('id');
                swal({
                    title: "Você tem certeza?",
                    text: "Uma vez entregue, você não poderá recuperar este pedido!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Sim, deletar!",
                    cancelButtonText: "Não, cancelar!"
                }).then(function(e) {
                    if(e.value){
                        sendRequest('/admin/pedidos/confirm/', id);
                        swal("Bom trabalho!", "Pedido foi entregue com sucesso!", "success");
                    }
                });

            });

            $('body').on('click', '.cancel_demand', function(){
                var id = $(this).attr('id');
                swal({
                    title: "Você tem certeza?",
                    text: "Uma vez <strong>cancelado</strong>, você não poderá recuperar este pedido!",
                    type: "error",
                    showCancelButton: !0,
                    confirmButtonText: "Sim!",
                    cancelButtonText: "Não!"
                }).then(function(e) {
                    if(e.value){
                        sendRequest('/admin/pedidos/cancel/', id);
                        swal("Bom trabalho!", "Pedido foi cancelado!", "success");
                    }
                });

            });

            $('body').on('click', '.confirm_demand_product', function(){
                sendRequest('/admin/pedidos/confirm/', $('#productID').val());
                $('#modalDemandTarget').modal('hide');
            });

            $('body').on('click', '.cancel_demand_product', function(){
                sendRequest('/admin/pedidos/cancel/', $('#productID').val());
                $('#modalDemandTarget').modal('hide');
            });

        }
    }

    // Método para enviar requisiçao
    function sendRequest(url, id){
        $.ajax({
            url: url + id,
            dataType: 'json',
            success: function(data){
                if(data.hasOwnProperty("success")){
                    $('#table_demands').mDatatable().ajax.reload();
                }
            }
        });
    }

});