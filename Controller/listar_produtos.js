$(function() {
    $("#pesquisar").keyup(function() {

        var pesquisar = $(this).val();

        if (pesquisar != '') {
            var dados = {
                palavra: pesquisar
            }
            $.post('../Modal/listar_produtos_model.php', dados, function(retorna) {
                $("#conteudo").html(retorna)
            })
        }
    })
})