$(document).ready(function () {
    $('#confirmar').click(function () {

        const id_usuario = $('#id_usuario').val();
        const nome_completo = $('#nome_completo').val();
        const nome_usuario = $('#nome_usuario').val();
        const cargo_usuario = $('#cargo_usuario').val();
        event.preventDefault();
        console.log(id_usuario, nome_completo)
        $.ajax({
            url: '../Modal/editar_usuario.php',
            type: 'POST',
            data: {
                id_usuario: id_usuario,
                nome_completo: nome_completo,
                nome_usuario: nome_usuario,
                cargo_usuario: cargo_usuario
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


    })
})

