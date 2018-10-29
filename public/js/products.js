$(function(){
    //CSRF Token laravel para formulários
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //limpar o ID quando clicar em novo produto
    $("#modalProdutos").click(function(){
        $("#msg-prod").fadeOut(300);
        $("#imagem").hide();
        $("#id_save").val("");
        $('#produtosForm').trigger("reset");
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
                    $("#msg-prod").fadeOut(300);
                    $("#imagem").fadeIn(300);
                    $('#produtosForm').trigger("reset");
                    $("#id_save").val(id);
                    $.getJSON( "/api/products/"+id, function( data ) {
                        var data = data.data;
                        $("#name").val(data.name);
                        $("#price_cost").val(data.price_cost);
                        $("#price_sale").val(data.price_sale);
                        $("#quantity").val(data.quantity);
                        $("#imagem").attr('src', data.url_image);
                        if(data.validade){
                            $("#validade").val(data.validade.substring('0', '10'));
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
        "drawCallback": function( settings ) {
            // $('[data-toggle="confirm_delete_produto"]').confirmation({
            //     title: 'Você tem certeza?',
            //     btnOkLabel      : 'Sim',
            //     btnCancelLabel  : 'Não',
            //     onConfirm: function() {
            //         var id = $(this).attr('id');
            //         if(id != ""){
            //             deletarProduto(id);
            //         }
            //     },
            // });
        },
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
                $('#salvar').button('loading');
            },
            success: function(data){
                $('#salvar').button('reset');
                if(data.hasOwnProperty("success")){
                    $("#msg-prod").find("ul").html('');
                    $('#modalProdutosTarget').modal('hide');
                    swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                    $('#produtosForm').trigger("reset");
                    $('#table_produtos').DataTable().ajax.reload();
                }else{
                    $("#msg-prod").find("ul").html('');
                    $("#msg-prod").removeClass('alert-success').addClass('alert-danger');
                    $.each(data.errors, function( key, value ) {
                        $("#msg-prod").fadeIn(300);
                        $("#msg-prod").find("ul").append('<li>'+value+'</li>');
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
                $('#salvar').button('loading');
            },
            success: function(data){
                $('#salvar').button('reset');
                console.log(data);
                if(data.hasOwnProperty("success")){
                    $("#msg-prod").find("ul").html('');
                    $("#imagem").attr("src", $("#imagem").attr('src')+"?"+new Date().getTime());
                    $('#modalProdutosTarget').modal('hide');
                    swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                    $('#produtosForm').trigger("reset");
                    $('#table_produtos').DataTable().ajax.reload();
                }else{
                    $("#msg-prod").find("ul").html('');
                    $.each(data.errors, function( key, value ) {
                        $("#msg-prod").fadeIn(300);
                        $("#msg-prod").find("ul").append('<li>'+value+'</li>');
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
    $('#price_cost').mask('000,00', {reverse: true});
    $('#price_sale').mask('000,00', {reverse: true});
});