$(function(){
    $('#demands-list .nav-item .nav-link').click(function(){
        $('#current-demand').val($(this).attr('data-status-id'));
        getList();
    });

    function getList(){
        var id = $('#current-demand').val();
        $.ajax({
            url:'/admin/pedidos/getlist/' + id,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                mApp.block("#demands-list", {
                    overlayColor: "#000000",
                    type: "loader",
                    state: "primary",
                    message: "Processando.."
                });
            },
            success: function(data){
                mApp.unblock("#demands-list");
                $('#demands-list').html(data.view);
                $("#demands-list .nav-item").each(function() {
                    $("#demands-list .nav-link[data-status-id='" + id + "']").click();
                    return false;
                });
            }
        });
    }

    $('.preparo_demand').click(function(){
        sendRequestDemand('/admin/pedidos/prepear/', $(this).attr('id'), $(this));
    });

    $('.retirada_demand').click(function(){
        sendRequestDemand('/admin/pedidos/withdrawal/', $(this).attr('id'), $(this));
    });

    $('.confirm_demand_panel').click(function(){
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
                sendRequestDemand('/admin/pedidos/confirm/', id, $(this));
                swal("Bom trabalho!", "Pedido foi entregue com sucesso!", "success");
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
                sendRequestDemand('/admin/pedidos/cancel/', id, $(this));
                swal("Bom trabalho!", "Pedido foi cancelado!", "success");                
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
                    sendRequestDemand('/admin/pedidos/paid/', id, $(this));
                }else{
                    sendRequestDemand('/admin/pedidos/prepear/', id, $(this));
                }
                swal("Bom trabalho!", "Pedido foi retornado ao status anterior!", "success");                
            }
        });
    });

    // Método para enviar requisiçao
    function sendRequestDemand(url, id, e){
        $.ajax({
            url: url + id,
            dataType: 'json',
            beforeSend: function() {
               $(e).addClass('m-loader m-loader--light m-loader--right');
               $(e).prop("disabled",true);
            },
            success: function(data){
                if(data.success){
                    $(e).removeClass('m-loader m-loader--light m-loader--right');
                    $(e).prop("disabled",false);
                    return true;
                }
            },
            complete: function(){
                getList();
            }
        });
    }
});