$(document).ready(function () {
    

    $('#cadastrar_fornecedor').click(function () {
        const nome_fornecedor = $('#nome_fornecedor').val();
        const cnpj_fornecedor = $('#cnpj_fornecedor').val();
        const endereco_fornecedor = $('#endereco_fornecedor').val();
        const contato_fornecedor = $('#contato_fornecedor').val();

        console.log(nome_fornecedor, cnpj_fornecedor, endereco_fornecedor, contato_fornecedor);

       

        $.ajax({
            url: '../Modal/cadastrar_fornecedores_modal.php',
            type: 'POST',
            data: "nome_fornecedor=" + nome_fornecedor +
                "&cnpj_fornecedor=" + cnpj_fornecedor +
                "&endereco_fornecedor=" + endereco_fornecedor +
                "&contato_fornecedor=" + contato_fornecedor,

            success: function (resultado) {
                $('#resultado').html(resultado);
            },
            beforeSend: function () {
                $('#cadastrar_fornecedor').html('Carregando');
            },
            complete: function () {
                $('#resultado').html('<div class="alert alert-success alert-dismissible fade show" style="text-align: center;" role="alert"><h5>Fornecedor <strong>Cadastrado</strong> !<h5><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('#modal_fornecedor').modal('hide');
                setTimeout(() => location.reload(), 2000);
            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        });

    })
})

