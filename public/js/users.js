$(function(){
    // Método para criar a tabela com produtos
    $('#table_users')
        .on( 'preXhr.dt', function () {
            mApp.block("#content-table-users", {
                overlayColor: "#000000",
                type: "loader",
                state: "primary",
                message: "Processando.."
            });
        })
        .on( 'xhr.dt', function () {
            mApp.unblock("#content-table-users");
            actionsButtons();
        })
        .DataTable({
            pageLength: 5,
            responsive: true,
            "ajax": { "url": "usuarios/all" },
            "columns": [
                { "data": "id", "title": "#" },
                { "data": "name", "title": "Nome" },
                { "data": "email", "title": "Email" },
                { "data": "created_at", "title": "Dt criação" },
                {data: 'action', name: 'action', "title":"Ações", orderable: false, searchable: false}
            ],
            "columnDefs": [
                { "width": "1%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "15%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "10%", "targets": 4 },
            ],
            "order": [ 0, 'DESC' ],
            "language": {
                "url": document.location.origin+ "/js/pt-br-translations-datatable.json"
            }
        });

        $("#newuserform").validate( {
           rules: {
               name: {
                   required: true, minlength: 1, maxlength: 50
               },
               email:{
                   required: !0, email: true
               },
               password : {
                   required: !0,
                   minlength : 5
               },
               password_confirm : {
                   required: !0,
                   minlength : 5,
                   equalTo : "#password"
               }
           }, submitHandler:function() {
                $newuserform = new FormData($('#newuserform')[0]);
                $.ajax({
                    type:"POST",
                    url:'/admin/usuarios/new',
                    data: $newuserform,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        mApp.block("#content-new-users", {
                            overlayColor: "#000000",
                            type: "loader",
                            state: "primary",
                            message: "Gravando.."
                        });
                    },
                    success: function(data){
                        mApp.unblock("#content-new-users");
                        if(data.hasOwnProperty("success")){
                            swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                            $('#newuserform').trigger("reset");
                            $('#table_users').DataTable().ajax.reload();
                        }else{
                            $.each(data.errors, function( key, value ) {
                                messageError(value)
                            });
                        }
                    }
                });
           }
       });

       //Método para dar ações aos botões do datatable
    function actionsButtons(){
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
    }

    // Método para deletar produto
    function deletarProduto(id){
        $.ajax({
            type:"DELETE",
            url:'/admin/usuarios/delete/'+id,
            headers: {'X-CSRF-TOKEN': $('#token').val()},
            dataType: 'json',
            success: function(data){
                if(data.hasOwnProperty("success")){
                    $('#table_produtos').DataTable().ajax.reload();
                }
            }
        });
    }

    // Método para mostrar erros
    function messageError(value){
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
    }
});