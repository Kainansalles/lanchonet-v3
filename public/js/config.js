$(function(){
    // Métódo Ajax para inserir um novo produto
   $("#configuracoesForm").validate( {
            rules: {
                cnpj: {
                    required: !0
                },
                company_name: {
                    required: !0, maxlength: 50
                },
                nickname: {
                    required: !0, maxlength: 50
                },
                bank_account: {
                    required: !0
                },
                bank_agency: {
                    required: !0
                },
                open_hours: {
                    required: !0
                },
                close_hours: {
                    required: !0
                },
                works_days: {
                    required: !0
                }
            },
            submitHandler:function(form) {
                $produtosForm = $('#configuracoesForm');

                var cnpj = $("#cnpj").val();
                cnpj = cnpj.replace('.', '');
                cnpj = cnpj.replace('/', '');
                cnpj = cnpj.replace('-', '');
                $("#cnpj").val(cnpj);
    
                $.ajax({
                    type:"PUT",
                    url:'/admin/configuracoes/editar/1',
                    data: $produtosForm.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.success){
                            swal("Bom trabalho!", "Clique sobre o botão para fechar!", "success");
                        }
                    }
                });
            }
        }
    );

    // Mascaras formulario configuracoes
    $('#cnpj').mask('00.000-000/0000-00');
    $('#cep').mask('000-00000');
    $('#telephone').mask('(00) 0000-0000');
    $('#bank_account').mask('0000-0');
    $('#bank_agency').mask('000000-0');
});