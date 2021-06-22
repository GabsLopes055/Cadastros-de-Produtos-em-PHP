$(document).ready(function () {
    $('#cadastrar').click(function () {
        const numero_nota = $('#numero_nota').val();
        const nome_produto = $('#nome_produto').val();
        const fornecedor = $('#fornecedor').val();
        const quantidade = $('#quantidade').val();
        const valor_unitario = $('#valor_unitario').val();

        event.preventDefault();
        console.log(numero_nota, nome_produto, fornecedor, quantidade, valor_unitario);

        console.log('teste');

        $.ajax({
            url: '../Modal/cadastrar_produto_modal.php',
            type: 'POST',
            dataType: "text",
            data: {
                numero_nota: numero_nota,
                nome_produto: nome_produto,
                fornecedor: fornecedor,
                quantidade: quantidade,
                valor_unitario: valor_unitario,
            },
            success: function (resultado) {
                $('#resultado').html(resultado);
            },
            error: function () {
                console.log("Erro ao Cadastrar");
            }
        });

        $.ajax({
            url: '../Modal/listar_cadastrar_produto_modal.php',
            type: 'POST',
            data: {
                numero_nota: numero_nota,
            },
            dataType: "text",
            success: function (resultado) {
                $('#resultado').html(resultado);
            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        });

        $('#nome_produto').val('');
        $('#quantidade').val('');
        $('#valor_unitario').val('');

    });

});