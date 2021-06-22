$(document).ready(function () {
    $('#confirma_excluir').click(function () {

        const id_usuario = $('#id_usuario_excluir').val();

        event.preventDefault();
        // console.log(id_usuario);
        $.ajax({
            url: '../Modal/excluir_usuario.php',
            type: 'POST',
            data: {
                id_usuario: id_usuario
            },
            dataType: "HTML",
            success: function (resultado) {
                $('#resultado').html(resultado);
                $('#excluirUsuario').modal('hide')
                setTimeout(() => location.reload(), 2000);

            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            },

        });


    })
})

