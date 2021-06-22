$(document).ready(function () {
    $("#cadastrar").click(function () {
        const nome_produto = $("#nome_produto").val();
        const preco_custo = $("#preco_custo").val();
        const preco_produto = $("#preco_produto").val();
        const quantidade = $("#quantidade").val();
        const forma_pagamento = $("#forma_pagamento").val();

        console.log(nome_produto, preco_custo, preco_produto, quantidade, forma_pagamento);

        $.ajax({
            url: '../Modal/inserir_produto.php',
            type: 'POST',
            data: {
                nome_produto: nome_produto,
                preco_custo: preco_custo,
                preco_produto: preco_produto,
                quantidade: quantidade,
                forma_pagamento: forma_pagamento
            },
            success: function (resultado) {
                $('#resultado').html(resultado);
            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })

    })
})