$(document).ready(function () {
    $('#cadastrar').click(function () {
        const nomeCompleto = $('#nomeCompleto').val();
        const cargo = $('#cargo').val();
        const usuario = $('#usuario').val();
        const senha = $('#senha').val();

        console.log(nomeCompleto, cargo, usuario, senha);
        event.preventDefault();

        $.ajax({
            url: '../Modal/cadastrar_usuario_modal.php',
            type: 'POST',
            data: {
                nomeCompleto: nomeCompleto,
                cargo: cargo,
                usuario: usuario,
                senha: senha
            },
            dataType: "HTML",
            success: function (resultado) {
                $('#resultado').html(resultado);
                setTimeout(() => location.reload(), 2000);
            },
            error: function () {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            },

        });

    });
});