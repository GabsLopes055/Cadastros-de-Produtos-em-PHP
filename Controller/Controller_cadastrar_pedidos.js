$(document).ready(function () {
    $('#cadastrar').click(function () {
        event.preventDefault();

        const titulo = $('#titulo').val();
        const descricao = $('#descricao').val();

        console.log(titulo, descricao);
        $.ajax({
            url: '../Modal/cadastrar_pedido_modal.php',
            type: 'POST',
            data: {
                titulo: titulo,
                descricao: descricao
            },
            dataType: "HTML",
            success: function (resultado) {
                $('#resultado').html(resultado);
                $('#editarUsuario').modal('hide')
                setTimeout(() => location.reload(), 2000);
            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            },

        });
    });
});