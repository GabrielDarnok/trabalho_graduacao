fetch('/dadosbar')
    .then(response => response.json())
    .then(data => {
        const charts = document.querySelectorAll(".chart");

        charts.forEach(function (chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: data.dados.labels,
                    datasets: [
                        {
                            label: "Pedidos mensais",
                            data: data.dados.dados, // Use os dados recebidos aqui
                            backgroundColor: [
                                "rgba(127, 255, 212, 0.2)"
                            ],
                            borderColor: [
                                "rgba( 46, 139, 87, 1 )",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        });
    })
    .catch(error => {
        console.error('Erro ao obter os dados do servidor:', error);
    });

fetch('/dadosbar2')
    .then(response => response.json())
    .then(data => {
        const charts = document.querySelectorAll(".chart2");

        charts.forEach(function (chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: data.dados2.labels,
                    datasets: [
                        {
                            label: "Cadastros de produtos mensais",
                            data: data.dados2.dados,
                            backgroundColor: [
                                "rgba(255, 165, 0, 0.2)"
                            ],
                            borderColor: [
                                "rgba(255, 165, 0, 1)"
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        });
    })
    .catch(error => {
        console.error('Erro ao obter os dados do servidor:', error);
    });

fetch('/dados-circular')
    .then(response => response.json())
    .then(data => {
        const charts = document.querySelectorAll(".pizza-chart"); // Mudança na classe CSS

        charts.forEach(function (chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,  // Usar os labels retornados
                    datasets: [{
                        label: 'Vulnerabilidades detectadas',
                        data: data.counts,  // Usar os counts retornados
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    width: 400,
                    height: 200,
                    plugins: {
                        legend: {
                            position: 'left',
                        },
                    }
                },
            });
        });
    })
    .catch(error => {
        console.error('Erro ao obter os dados do servidor:', error);
    });

fetch('/dadosline')
    .then(response => response.json())
    .then(data => {
        const charts = document.querySelectorAll(".line-chart");

        charts.forEach(function (chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.dados_do_grafico.labels,
                    datasets: [{
                        label: 'Novos usuarios',
                        data: data.dados_do_grafico.dados,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    width: 400,
                    height: 200,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                },
            });
        });
    })
    .catch(error => {
        console.error('Erro ao obter os dados do servidor:', error);
    });