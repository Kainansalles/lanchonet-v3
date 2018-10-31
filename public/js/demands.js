$(function(){
    // setInterval(function() {
    //     $('#table_demands').DataTable().ajax.reload();
    // }, 10000 );

    // Método para criar a tabela com produtos
    $('#table_demands').DataTable({
        orderFixed: [ 3, 'desc' ],
        paging : true,
        responsive: true,
        stateSave: true,
        "ajax": {
            "processing": true,
            "serverSide": true,
            "url": "/admin/pedidos/all",
            "data": function ( d, x) {
                renderDemand();
                optionsDemand();
            },
        },
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
        "drawCallback": function( settings ) {
            // $('[data-toggle="confirm_cancel_demand"]').confirmation({
            //     title: 'Você tem certeza?',
            //     btnOkLabel      : 'Sim',
            //     btnCancelLabel  : 'Não',
            //     onConfirm: function(e) {
            //         sendRequest('/admin/pedidos/cancel/', $(this).attr('id'));
            //     },
            // });

        },
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
                    $('#table_demands').DataTable().ajax.url( '/admin/pedidos/all' ).load();
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
                    $('#table_demands').DataTable().ajax.url( '/admin/pedidos/allcancel' ).load();
                }
            },
            {
                text: 'Finalizados',
                className: 'btn btn-success botoes-filtro',
                action: function ( e, dt, node, config ) {
                    $('.botoes-filtro').removeClass('active botoes-filtro-efeito');
                    $("#table_demands").removeClass('fl-datatable');
                    node.addClass('active botoes-filtro-efeito');
                    $('#table_demands').DataTable().ajax.url( '/admin/pedidos/allfinalized' ).load();
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
            $.getJSON( "/admin/pedidos/"+id, function( data ) {
                // var data = data.data;
                // var PerProduct = 0;
                // var total = 0;
                // $("#productID").val(data.id);
                // $("#status_demand_description").val(data.status_demand.description);
                // $('.buttons-options').show();
                // $('.value-total').removeClass('col-md-12').addClass('col-md-6');
                //
                // if($("#status_demand_description").val() == "Cancelado" ||
                //     $("#status_demand_description").val() == "Finalizado"){
                //     $('.buttons-options').hide();
                //     $('.value-total').removeClass('col-md-6').addClass('col-md-12');
                // }
                //
                // $("h2#name").html(data.client.name);
                // $("h4#status").html("<strong>Status:</strong> " + data.status_demand.description);
                // $("h4#retirada").html("<strong>Retirada:</strong> " + data.hour_recall);
                // $("#modal_demands").find("tbody").html('');
                //
                // $.each(data.demand_x_product, function(i, val){
                //     PerProduct += (parseFloat(val.price_registred) * val.quantity);
                //     total += parseFloat(PerProduct);
                //
                //     $("#modal_demands").find("tbody").append('<tr>' +
                //         '<td>' + val.product.name + '</td>' +
                //         '<td> R$ ' + val.price_registred.replace('.', ',') + '</td>' +
                //         '<td>' + val.quantity + '</td>' +
                //         '<td> R$ ' + PerProduct.toFixed(2).replace('.', ',') + '</td>' +
                //         '</tr>');
                // });

                //$("h4#value_total").html("<strong>Valor total:</strong> R$ " + total.toFixed(2).replace('.', ','));
                console.log(data);
                $('#content-modal').html(data.view);
                // $('.buttons-options').show();
                // $('.value-total').removeClass('col-md-12').addClass('col-md-6');
                //
                // if($("#status_demand_description").val() == "Cancelado" ||
                //     $("#status_demand_description").val() == "Finalizado"){
                //     $('.buttons-options').hide();
                //     $('.value-total').removeClass('col-md-6').addClass('col-md-12');
                // }
            });

            $('#modalDemandTarget').modal('show');
        });
    }

    // Método para realizar ações dos botões
    function optionsDemand(){
        if($("#status_demand_description").val() == "Cancelado" ||
            $("#status_demand_description").val() == "Finalizado"){

            $('.buttons-options').hide();
            $('.value-total').removeClass('col-md-6').addClass('col-md-12');

        }else{
            $('.buttons-options').show();
            $('.value-total').removeClass('col-md-12').addClass('col-md-6');
            $('body').on('click', '.confirm_demand', function(){
                var id = $(this).attr('id');
                swal({
                    buttons: ["Cancelar", "Confirmar"],
                    title: "Você tem certeza?",
                    text: "Uma vez entregue, você não poderá recuperar este pedido!",
                    icon: "warning",
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        sendRequest('/admin/pedidos/confirm/', id);
                        swal("Pedido foi entregue com sucesso!", {
                            title: "Bom trabalho!",
                            icon: "success",
                        });
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
                    $('#table_demands').DataTable().ajax.reload();
                }
            }
        });
    }

});