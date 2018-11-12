$(function(){
    // Método para criar a tabela com produtos
    $('#table_produtos')
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
            //actionsButtons();
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
            "order": [ 1, 'asc' ],
            "language": {
                "url": document.location.origin+ "/js/pt-br-translations-datatable.json"
            }
        });

        $("#newuserform").validate( {
           rules: {
               name: {
                   required: !0, minlength: 1, maxlength: 50
               }
           }
           , invalidHandler:function(e, r) {

           }
           , submitHandler:function(form) {
               // $produtosForm = new FormData($('#newuserform')[0]);
               // if($("#id_save").val() == ""){
               //     insertProduto();
               // }else{
               //     updateProduto();
               // }
           }
       });


});