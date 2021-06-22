$(document).ready(function() {
    $('#pesquisaDatas').click(function() {
        event.preventDefault();
        var dataInicio = $('#dataInicio').val();
        var dataFim = $('#dataFim').val();



        $.ajax({
            url: '../Modal/relatorios_total_modal.php',
            type: 'POST',
            data: { dataInicio: dataInicio, dataFim: dataFim },
            dataType: "text",
            success: function(resultado) {
                $('#resultado').html(resultado);
            },
            error: function() {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })
        $.ajax({
            url: '../Modal/relatorios_lucro_modal.php',
            type: 'POST',
            data: { dataInicio: dataInicio, dataFim: dataFim },
            dataType: "text",
            success: function(resultado) {
                $('#resultado_lucro').html(resultado);
            },
            error: function() {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })

        $.ajax({
            url: '../Modal/relatorios_custo_modal.php',
            type: 'POST',
            data: { dataInicio: dataInicio, dataFim: dataFim },
            dataType: "text",
            success: function(resultado) {
                $('#resultado_custo').html(resultado);
            },
            error: function() {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })
        $.ajax({
            url: '../Modal/relatorios_retirada_modal.php',
            type: 'POST',
            data: { dataInicio: dataInicio, dataFim: dataFim },
            dataType: "text",
            success: function(resultado) {
                $('#resultado_retirada').html(resultado);
            },
            error: function() {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })


        // POPULANDO OS GRAFICOS


        $.ajax({
            url: '../Modal/relatorios_graficos_modal.php',
            type: 'POST',
            data: { dataInicio: dataInicio, dataFim: dataFim },
            dataType: "json",
            success: function(resultado) {

                var vendas = []

                for (var i in resultado) {
                    vendas.push(resultado[i]);
                    console.log(vendas)
                }

                grafico(vendas);
            },
            error: function() {
                console.log("SE EU APARECER É PORQUE NÃO FUNCIONA");
            }
        })
    })


    var grafico_1 = document.getElementById('myChart_1').getContext('2d');

    function grafico(vendas) {
        var myDoughnutChart = new Chart(grafico_1, {
            type: 'doughnut',
            data: {
                labels: ['Dinheiro', 'Cartão de Crédito'],
                datasets: [{
                    label: 'Vendas',
                    data: [vendas[0], vendas[1]],
                    backgroundColor: [
                        '#FF6347', '#FFA500',
                    ],
                    borderWidth: 4
                }]
            }
        });
    }
})