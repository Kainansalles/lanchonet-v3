$(function(){
    $('body').addClass('m-brand--minimize m-aside-left--minimize');
    setInterval(function() {
        $('#table_demands').DataTable().ajax.reload();
    }, 60000 );


    $.getJSON( "/admin/pedidos/getlist", function( data ) {
        $('#demands-list').html(data.view);
        //new mPortlet('.portlets-demands');
    });

    $("#filter_status_demand").select2();

    $('body').on('change', '#filter_status_demand',function(){
        $('#status_delivery').removeClass('active');
        $('#table_demands').DataTable().ajax.url( '/admin/pedidos/consultdemand/' + $(this).val()).load();
    });

    // Método para criar a tabela com produtos
    $('#table_demands')
    .on( 'preXhr.dt', function () {
        mApp.block("#content-table-demands", {
            overlayColor: "#000000",
            type: "loader",
            state: "primary",
            message: "Processando.."
        });
    })
    .on( 'xhr.dt', function () {
        mApp.unblock("#content-table-demands");
        renderDemand();
        optionsDemand();

        $('body').on('click', '#status_delivery',function(){
            $(this).addClass('active');
            $('#table_demands').DataTable().ajax.url( '/admin/pedidos/all').load();
        });
        $("body").ready(function(){
            if($('#status_delivery').hasClass('active')){
                $('#table_demands tbody tr:first td:last-child').append("<div class='m-spinner m-spinner--warning m-spinner--lg'></div>");
            }
        });
    })
    .DataTable({
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
        "columnDefs": [
            { "width": "1%", "targets": 0 },
            { "width": "10%", "targets": 1 },
            { "width": "5%", "targets": 2 },
            { "width": "5%", "targets": 3 },
            { "width": "10%", "targets": 4 }
        ],
        dom: 'flrtip',
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
                    text: "Uma vez cancelado, você não poderá recuperar este pedido!",
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
                    $('#table_demands').DataTable().ajax.reload();
                }
            }
        });
    }

});