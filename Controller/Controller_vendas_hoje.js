$(function() {
    $.post('../Modal/dashboard_vendas_hoje.php', function(retorna) {
        $("#vendas_hoje").html(retorna)
    })

    $(function() {
        $.post('../Modal/dashboard_investimento.php', function(retorna) {
            $("#investimento").html(retorna)
        })
    })

    $(function() {
        $.post('../Modal/dashboard_total_produtos.php', function(retorna) {
            $("#total_produtos").html(retorna)
        })
    })

    $(function() {
        $.post('../Modal/dashboard_grafico_modal.php', function(retorna) {
            // alert('teste');
        })
    })

    // $ajax({
    //     url: "../Modal/dashboard_grafico_modal.php",
    //     type: "POST",
    //     dataType: "json",
    //     success: function(data) {
    //         alert("Funcionou");
    //     }
    // })
})