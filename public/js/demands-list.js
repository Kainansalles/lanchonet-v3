$(function(){
    $('#demands-list .nav-item .nav-link').click(function(){
        $('#current-demand').val($(this).attr('data-status-id'));
        getList();
    });

    function getList(){
        var id = $('#current-demand').val();
        $.getJSON( "/admin/pedidos/getlist/" + id, function( data ) {
            $('#demands-list').html(data.view);
            $("#demands-list .nav-item").each(function() {
                //$("#demands-list .nav-link[data-status-id='" + id + "']").addClass('active show');
                $("#demands-list .nav-link[data-status-id='" + id + "']").click();
            });
        });
    }

    $('body').on('click', '.retirada_demand',function(){
        sendRequest('/admin/pedidos/prepear/', $(this).attr('id'));
        getList();
    });
    $('body').on('click', '.preparo_demand',function(){
        sendRequest('/admin/pedidos/withdrawal/', $(this).attr('id'));
        getList();
    });

    $('body').on('click', '.confirm_demand', function(){
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
});