$(function(){
    $('#demands-list .nav-item .nav-link').click(function(){
        $('#current-demand').val($(this).attr('data-status-id'));
        getList();
    });

    function getList(){
        var id = $('#current-demand').val();
        $.getJSON( "/admin/pedidos/getlist/" + id, function( data ) {
            $('#demands-list').html(data.view);
            $("#demands-list .nav-item").each(function(k, e) {
                $("#demands-list .nav-link[data-status-id='" + id + "']").click();
                return false;
            });
        });
    }

    $('.preparo_demand').click(function(){
        sendRequest('/admin/pedidos/prepear/', $(this).attr('id'));
        getList();
    });

    $('.retirada_demand').click(function(){
        sendRequest('/admin/pedidos/withdrawal/', $(this).attr('id'));
        getList();
    });

    $('.confirm_demandd').click(function(){
        var id = $(this).attr('id');
        swal({
            title: "Você tem certeza?",
            text: "Uma vez entregue, você não poderá recuperar este pedido!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, finalizar!",
            cancelButtonText: "Não, cancelar!"
        }).then(function(e) {
            if(e.value){
                sendRequest('/admin/pedidos/confirm/', id);
                swal("Bom trabalho!", "Pedido foi entregue com sucesso!", "success");
                getList();
            }
        });
    });

    $('.cancel_demand_panel').click(function(){
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
                getList();
            }
        });
    });

    $('.return_demand').click(function(){
        var id = $(this).attr('id');
        var data_status_id = $(this).attr('data-status-id');
        swal({
            title: "Você tem certeza?",
            text: "Você almente quer retornar esse pedido ao status anterior!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim!",
            cancelButtonText: "Não!"
        }).then(function(e) {
            if(e.value){
                if(data_status_id == 4){
                    sendRequest('/admin/pedidos/paid/', id);
                }else{
                    sendRequest('/admin/pedidos/prepear/', id);
                }
                swal("Bom trabalho!", "Pedido foi retornado ao status anterior!", "success");
                getList();
            }
        });
    });
});