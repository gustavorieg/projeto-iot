<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Monitoramento de Temperatura</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .main-card {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      background: #fff;
    }

    .grafico-container {
      position: relative;
      height: 350px;
      background-color: #eef3f7;
      border-radius: 16px;
      overflow: hidden;
    }

    #graficoTemperatura {
      position: absolute;
      top: 0;
      left: 0;
      width: 100% !important;
      height: 100% !important;
      opacity: 0.25;
      z-index: 1;
    }

    .temperatura-destaque {
      position: relative;
      z-index: 2;
      text-align: center;
      color: #333;
      padding-top: 60px;
    }

    .temperatura-destaque .valor {
      font-size: 4rem;
      font-weight: 700;
    }

    .temperatura-destaque .label {
      font-size: 1.2rem;
      color: #666;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-primary {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="main-card p-4">
    <h4 class="text-center mb-4 text-primary">Análise de Temperatura</h4>

    <form id="filtro-form" class="row g-3 mb-4 justify-content-center">
      <div class="col-md-4">
        <label class="form-label">Início:</label>
        <input type="date" name="inicio" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Fim:</label>
        <input type="date" name="fim" class="form-control" required>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100" type="submit">Filtrar</button>
      </div>
    </form>

    <div class="grafico-container mb-3">
      <canvas id="graficoTemperatura"></canvas>
      <div class="temperatura-destaque">
        <div class="label">Última Temperatura</div>
        <div id="ultimaTemperatura" class="valor">-- °C</div>
      </div>
    </div>
  </div>
</div>

<script>
  let chart;

  function atualizarGrafico(labels, dados) {
    const cores = dados.map(temp => {
      if (temp < 20) return 'green';
      if (temp < 30) return 'orange';
      return 'red';
    });

    const ctx = document.getElementById('graficoTemperatura').getContext('2d');

    if (chart) chart.destroy();

    chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Temperatura (°C)',
          data: dados,
          borderWidth: 2,
          borderColor: '#007bff',
          backgroundColor: 'rgba(0,123,255,0.1)',
          pointBackgroundColor: cores,
          pointRadius: 4,
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: 'index',
          intersect: false
        },
        scales: {
          x: {
            display: false // esconde datas para manter visual limpo
          },
          y: {
            display: true,
            ticks: {
              color: '#555',
              font: { size: 12 }
            },
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          }
        },
        plugins: {
          legend: { display: false },
          tooltip: {
            enabled: true,
            backgroundColor: '#fff',
            borderColor: '#007bff',
            borderWidth: 1,
            titleColor: '#007bff',
            bodyColor: '#000',
            callbacks: {
              label: function(context) {
                return context.parsed.y + ' °C';
              }
            }
          }
        }
      }
    });

    if (dados.length > 0) {
      const ultima = dados[dados.length - 1];
      $('#ultimaTemperatura').text(ultima + ' °C');
    } else {
      $('#ultimaTemperatura').text('-- °C');
    }
  }

  function buscarDados(inicio = '', fim = '') {
    $.ajax({
      url: '/temperaturas/dados',
      data: { inicio, fim },
      success: function (response) {
        atualizarGrafico(response.labels, response.dados);
      }
    });
  }

  buscarDados();

  $('#filtro-form').on('submit', function (e) {
    e.preventDefault();
    const inicio = $(this).find('[name="inicio"]').val();
    const fim = $(this).find('[name="fim"]').val();
    buscarDados(inicio, fim);
  });
</script>

</body>
</html>
