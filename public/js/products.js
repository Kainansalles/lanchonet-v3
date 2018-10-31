$(function(){
    //CSRF Token laravel para formulários
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //limpar o ID quando clicar em novo produto
    $("#modalProdutos").click(function(){
        $("#imagem").hide();
        $("#id_save").val("");
        $('#produtosForm').trigger("reset");
        //$('#produtosForm').validate().resetForm();
    });

    // Método para criar a tabela com produtos
    $('#table_produtos').DataTable({
        paging : true,
        responsive: true,
        stateSave: true,
        "ajax": {
            "processing": true,
            "serverSide": true,
            "url": "produtos/todosprodutosadmin",
            "data": function ( d, x) {
                $('body').on('click', '.editar_botao', function(){
                    var id = $(this).attr('id');
                    $("#imagem").fadeIn(300);
                    $('#produtosForm').validate().resetForm();
                    $("#id_save").val(id);
                    $.getJSON( "/api/products/"+id, function( data ) {
                        var data = data.data;
                        $("#name").val(data.name);
                        $("#price_cost").val(data.price_cost);
                        $("#price_sale").val(data.price_sale);
                        $("#quantity").val(data.quantity);
                        $("#imagem").attr('src', data.url_image);
                        if(data.validade){
                            $("#m_datepicker_3_modal").val(data.validade.substring('0', '10'));
                        }
                        $("#description").val(data.description);
                        if(data.status == 1){
                            $("#ativo").prop("checked", true);
                        }else{
                            $("#inativo").prop("checked", true);
                        }
                    });
                    $('#modalProdutosTarget').modal('show');
                });

                $('body').on('click', '.excluir_botao', function(){
                    var id = $(this).attr('id');
                    swal({
                        title: "Você tem certeza?",
                        text: "Você não vai poder reverter isso!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Não, cancelar!"
                    }).then(function(e) {
                        if(e.value){
                            deletarProduto(id);
                            swal("Bom trabalho!", "Produto deletado com sucesso!", "success");
                        }
                    });
                });
            },
        },
        "columns": [
            { "data": "id", "title": "#" },
            { "data": "name", "title": "Nome" },
            { "data": "description", "title": "Descrição" },
            { "data": "quantity", "title": "Qtd" },
            { "data": "price_cost", "title": "Preço de Custo" },
            { "data": "price_sale", "title": "Preço de Venda" },
            {data: 'action', name: 'action', "title":"Ações", orderable: false, searchable: false}
        ],
        "columnDefs": [
            { "width": "1%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "2%", "targets": 3 },
            { "width": "5%", "targets": 4 },
            { "width": "5%", "targets": 5 },
            { "width": "10%", "targets": 6 }
        ],
        "order": [ 1, 'asc' ],
        "language": {
            "url": document.location.origin+ "/js/pt-br-translations-datatable.json"
        }
    });

    // Métódo Ajax para inserir um novo produto
    $('#produtosForm').on('submit',function(e){
        e.preventDefault(e);
        limpaCamposPreco();
        $produtosForm = new FormData($(this)[0]);
            if($("#id_save").val() == ""){
            insertProduto();
        }else{
            updateProduto();
        }
    });

    /*$("#produtosForm").validate( {
            rules: {
                name: {
                    required: !0, minlength: 1, maxlength: 50
                },
                 price_sale: {
                    required: !0
                },
                // url_image: {
                //     required: !0
                // },
                description: {
                    maxlength: 100
                }
            }
            , invalidHandler:function(e, r) {

            }
            , submitHandler:function(form) {
                limpaCamposPreco();
                $produtosForm = new FormData($('#produtosForm')[0]);
                if($("#id_save").val() == ""){
                    insertProduto();
                }else{
                    updateProduto();
                }
            }
        }
    );*/

    // Método para Insert de produto
    function insertProduto(){
        $.ajax({
            type:"POST",
            url:'/admin/produtos/novo',
            data: $produtosForm,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                mApp.block("#modalProdutosTarget .modal-content", {
                    overlayColor: "#000000",
                    type: "loader",
                    state: "primary",
                    message: "Processando.."
                });
            },
            success: function(data){
                mApp.unblock("#modalProdutosTarget .modal-content");
                if(data.hasOwnProperty("success")){
                    $('#modalProdutosTarget').modal('hide');
                    swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                    $('#produtosForm').trigger("reset");
                    $('#table_produtos').DataTable().ajax.reload();
                }else{
                    $.each(data.errors, function( key, value ) {

                        var e = {
                            message: value
                        };
                        var t = $.notify(e, {
                            type: 'danger',
                            allow_dismiss: true,
                            spacing: 10,
                            timer: 2000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            offset: {
                                x: 30,
                                y: 30
                            },
                            delay: 1000,
                            z_index: 10000,
                            animate: {
                                enter: "animated " + "bounceIn",
                                exit: "animated " + "flipOutX"
                            }
                        });

                    });
                }
            }
        });
    }

    //Método para update de produto
    function updateProduto(){
        var id = $('#id_save').val();
        $.ajax({
            type:"POST",
            url:'/admin/produtos/editar/'+id,
            data: $produtosForm,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                mApp.block("#modalProdutosTarget .modal-content", {
                    overlayColor: "#000000",
                    type: "loader",
                    state: "primary",
                    message: "Processando.."
                });
            },
            success: function(data){
                mApp.unblock("#modalProdutosTarget .modal-content");
                if(data.hasOwnProperty("success")){
                    $("#imagem").attr("src", $("#imagem").attr('src')+"?"+new Date().getTime());
                    $('#modalProdutosTarget').modal('hide');
                    swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                    $('#produtosForm').trigger("reset");
                    $('#table_produtos').DataTable().ajax.reload();
                }else{
                    $.each(data.errors, function( key, value ) {

                        var e = {
                            message: value
                        };
                        var t = $.notify(e, {
                            type: 'danger',
                            allow_dismiss: true,
                            spacing: 10,
                            timer: 2000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            offset: {
                                x: 30,
                                y: 30
                            },
                            delay: 1000,
                            z_index: 10000,
                            animate: {
                                enter: "animated " + "bounceIn",
                                exit: "animated " + "flipOutX"
                            }
                        });

                    });
                }
            }
        });
    }

    // Método para deletar produto
    function deletarProduto(id){
        $.ajax({
            type:"DELETE",
            url:'/admin/produtos/excluir/'+id,
            headers: {'X-CSRF-TOKEN': $('#token').val()},
            dataType: 'json',
            success: function(data){
                if(data.hasOwnProperty("success")){
                    $('#produtosConfirmDelete').modal('hide');
                    $('#table_produtos').DataTable().ajax.reload();
                }
            }
        });
    }

    // Método responsavel por limpar os campos de preços
    function limpaCamposPreco(){
        var price_cost = $("#price_cost").val();
        price_cost = price_cost.replace(',', '.');
        $("#price_cost").val(price_cost);

        var price_sale = $("#price_sale").val();
        price_sale = price_sale.replace(',', '.');
        $("#price_sale").val(price_sale);
    }

    // Mascaras formulario produto
    $("#price_cost").inputmask("R$ 999.999.999,99", {
        numericInput: !0
    });
    $("#price_sale").inputmask("R$ 999.999.999,99", {
        numericInput: !0
    });
});