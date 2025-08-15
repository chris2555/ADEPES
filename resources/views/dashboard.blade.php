@extends('adminlte::page')

@section('title', 'dash')

@section('plugins.Sweetalert2', true)


@section('content_header')
    <h1>PANEL GENERAL</h1>
@stop
@section('content')
<div class="container-fluid">
   <div class="row">
  <!-- USUARIOS -->
  @hasanyrole('Tecnico|Administrador')
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('users.index') }}" class="text-dark text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">USUARIOS</span>
          <span class="info-box-number">{{ $TotalUsuarios }}</span>
        </div>
      </div>
    </a>
  </div>
    @endhasanyrole
  <!-- CLIENTES -->
   @hasanyrole('Tecnico|Administrador')
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('gestionclientes.index') }}" class="text-dark text-decoration-none">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-friends"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">CLIENTES</span>
          <span class="info-box-number">{{ $TotalPersonas }}</span>
        </div>
      </div>
    </a>
  </div>
  @endhasanyrole

  <!-- SOLICITUDES -->
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('solicitudes.index') }}" class="text-dark text-decoration-none">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">SOLICITUDES</span>
          <span class="info-box-number">{{ $TotalSolicitudesAprobadas }}</span>
        </div>
      </div>
    </a>
  </div>

  <!-- TOTAL PRESTADO -->
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('prestamos.index') }}" class="text-dark text-decoration-none">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-dollar-sign"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">TOTAL PRESTADO</span>
          <span class="info-box-number">{{ number_format($TotalMontosAprobados, 2) }} LPS</span>
        </div>
      </div>
    </a>
  </div>

  <!-- TOTAL CARTERA -->
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('configuraciones.index') }}" class="text-dark text-decoration-none">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">TOTAL CARTERA</span>
          <span class="info-box-number">{{ number_format($CarteraEmpresa, 2) }} LPS</span>
        </div>
      </div>
    </a>
  </div>

  <!-- TOTAL PAGADO -->
  <div class="col-12 col-sm-6 col-md-3">
    <a href="{{ route('pagos.index') }}" class="text-dark text-decoration-none">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">TOTAL PAGADO</span>
          <span class="info-box-number">{{ number_format($TotalPagado, 2) }} LPS</span>
        </div>
      </div>
    </a>
  </div>
</div>


<div class="row mt-4">
    <!-- Gráfico: Total Pagado por Mes -->
    <div class="col-md-6 mb-4 d-flex justify-content-center">
        <div class="card w-100" style="max-width: 1000px;"
                                style="max-height: 600px;">
            <div class="card-body">
                <h5 class="card-title">Total de Pagos Por Mes</h5>
                <div style="position: relative; width: 100%; height: auto;">
                    <canvas id="pagosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico: Pastel por Tipo de Crédito -->
    <div class="col-md-6 mb-4 d-flex justify-content-center">
        <div class="card w-100" style="max-width: 1000px;"
                                style="max-height: 600px;">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center" style="height: 380px;">
    <canvas id="graficoTipoCredito" width="400" height="400"></canvas>
</div>

</div>

</div>

            </div>
        </div>
    </div>

    <!-- Gráfico: Estadísticas (Monto Prestado) y Estado de Solicitudes -->
<!-- Gráfico: Estadísticas (Monto Prestado) y Estado de Solicitudes -->
<div class="col-12 d-flex justify-content-left" style="gap: 20px;">
  <!-- Tarjeta del gráfico -->
  <div class="card w-100" style="max-width: 1000px;">
    <div class="card-body">
      <h5 class="card-title">Monto Prestado por Mes</h5>
      <div style="position: relative; width: 900px; height: auto;">
        <canvas id="montoPrestadoChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Tarjeta de estado de solicitudes + personas que pagan -->
  <div style="width: 390px;">
    <div class="card w-100">
      <div class="card-body">
        <div class="goal-container" id="goalStats">
          <div class="goal-title">Estado de Solicitudes de Préstamo</div>
        </div>
      </div>
    </div>

    <!-- Lista de personas que deben pagar esta semana -->
    <div class="card w-100 mt-3">
  <div class="card-body">
    <div class="goal-title">Personas Que Tienen Que Realizar sus Pagos Esta Semana</div>
    <div id="personasPagoLista" class="list-group list-group-flush"></div>
      </div>
    </div>
<div class="card w-100 mt-3">
  <div class="card-body">
    <div class="goal-title">Personas Que Tienen Sus Pagos Retrasados</div>
    <div id="personasPagoRetrasadoLista" class="list-group list-group-flush"></div>
      </div>
    </div>
  </div>
  </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@php
    $mustChange = auth()->check() && auth()->user()->change == 1;
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
@if ($mustChange)
    Swal.fire({
        title: ' Cambio de Contraseña Requerido',
        text: 'Tu contraseña ha vencido. Debes Cambiarla antes de continuar.',
        icon: 'warning',
        confirmButtonText: 'Actualizar ahora',
        allowOutsideClick: false,    
        allowEscapeKey: false,       
        allowEnterKey: false,        
        showCloseButton: false 
    }).then(() => {
        window.location.href = '{{ url('/profile') }}';
    });
@else
    Swal.fire({
        title: '¡Éxito!',
        text: 'Bienvenido al panel general!',
        icon: 'success'
    });
@endif
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Gráfico 1: Pagos por mes -->
<script>
    fetch('/api-local/pagos/por-mes')
        .then(response => response.json())
        .then(data => {
            const nombreMeses = [
                '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];

            const labels = data.map(item => nombreMeses[item.mes]);
            const montos = data.map(item => item.total_pagado);

            const ctx = document.getElementById('pagosChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total pagado',
                        data: montos,
                        backgroundColor: 'rgb(0, 123, 255, 0.5)', // Antes era 0.5
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(value)
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: context => {
                                    const value = context.raw;
                                    const formatted = new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }).format(value);
                                    return `${context.dataset.label}: Lps ${formatted}`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error("Error al cargar los pagos:", error));
</script>

<canvas id="montoPrestadoChart"></canvas>

<script>
fetch('/api-local/prestamos/por-mes')
  .then(response => response.json())
  .then(data => {
    const meses = {
      '01': 'Enero', '02': 'Febrero', '03': 'Marzo', '04': 'Abril',
      '05': 'Mayo', '06': 'Junio', '07': 'Julio', '08': 'Agosto',
      '09': 'Septiembre', '10': 'Octubre', '11': 'Noviembre', '12': 'Diciembre'
    };

    const anio = data.length > 0 ? data[0].mes.split('-')[0] : new Date().getFullYear().toString();

    const labels = [];
    const montos = [];

    for (let i = 1; i <= 12; i++) {
      const mesNum = i.toString().padStart(2, '0');
      const label = `${meses[mesNum]} ${anio}`;
      labels.push(label);

      const encontrado = data.find(item => item.mes === `${anio}-${mesNum}`);
      montos.push(encontrado ? parseFloat(encontrado.total) : 0);
    }

    const ctx = document.getElementById('montoPrestadoChart').getContext('2d');

    const initialPointRadius = Array(12).fill(0); // puntos ocultos
    const finalPointRadius = Array(12).fill(4);   // puntos visibles al finalizar

    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Monto total este mes',
          data: montos,
          fill: true,
          backgroundColor: 'rgba(54, 162, 235, 0.3)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1.5,
          tension: 0.5,
          pointBackgroundColor: 'rgba(54, 162, 235, 1)',
          pointRadius: initialPointRadius // ocultar puntos al inicio
        }]
      },
      options: {
        responsive: true,
        animation: {
          duration: 3000,
          onComplete: () => {
            chart.data.datasets[0].pointRadius = finalPointRadius;
            chart.update();
          }
        },
        scales: {
          x: {
            ticks: {
              autoSkip: false,
              maxRotation: 45,
              minRotation: 45
            }
          },
          y: {
            beginAtZero: true,
            ticks: {
              callback: value => 'Lps ' + value.toLocaleString()
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'top'
          },
          tooltip: {
            callbacks: {
              label: context => {
                const value = context.raw;
                return `${context.dataset.label}: Lps ${value.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
              }
            }
          }
        }
      }
    });
  })
  .catch(error => console.error("Error al cargar los préstamos:", error));
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="graficoTipoCredito" style="max-width: 500px; max-height: 500px;"></canvas>
<script>
fetch('/api-local/prestamos/tipo')
  .then(response => response.json())
  .then(data => {
    const labels = [];
    const valores = [];

    const tiposEsperados = ['Primera Vez', 'Refinanciamiento', 'Reingreso', 'Novación'];
    const coloresPastel = {
  'Primera Vez': 'rgb(48, 236, 92)',        // Verde sólido
  'Refinanciamiento': 'rgb(0, 123, 255)',   // Rosa sólido
  'Reingreso': 'rgb(255, 242, 63)',          // Amarillo sólido
  'Novación': 'rgba(255, 182, 193, 1)'            // Azul sólido
};
    const bordesPastel = {
       'Primera Vez': 'rgb(9, 146, 9)',        // Verde sólido
  'Refinanciamiento': 'rgb(42, 27, 255)',   // Rosa sólido
  'Reingreso': 'rgb(255, 238, 0)',          // Amarillo sólido
  'Novación': 'rgb(240, 86, 109)'            // Azul sólido
    };

    tiposEsperados.forEach(tipo => {
      const encontrado = data.find(item => item.tipo_credito === tipo);
      labels.push(tipo);
      valores.push(encontrado ? parseInt(encontrado.cantidad) : 0);
    });

    const ctx = document.getElementById('graficoTipoCredito').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: valores,
          backgroundColor: labels.map(label => coloresPastel[label]),
          borderColor: labels.map(label => bordesPastel[label]),
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
            labels: {
              font: {
                size: 14
              },
              color: '#555'
            }
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const valor = context.raw;
                const porcentaje = total > 0 ? ((valor / total) * 100).toFixed(1) : 0;
                return `${context.label}: ${valor} (${porcentaje}%)`;
              }
            }
          },
          title: {
            display: true,
            text: 'Total de préstamos por tipo de créditos',
            font: {
              size: 16
            },
            color: '#666'
          }
        }
      }
    });
  })
  .catch(error => console.error("Error al cargar gráfico de tipo de crédito:", error));
</script>

<script>
  // Inyectar estilos para las barras
  const style = document.createElement('style');
  style.textContent = `
    .goal-container {
      font-family: "Segoe UI", sans-serif;
      width: 100%;
    }
    .goal-title {
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
      font-size: 18px;
    }
    .goal-bar {
      margin-bottom: 18px;
    }
    .goal-label {
      display: flex;
      justify-content: space-between;
      font-size: 15px;
      font-weight: 500;
      margin-bottom: 4px;
    }
    .bar-background {
      background-color: #444;
      border-radius: 3px;
      overflow: hidden;
      height: 10px;
    }
    .bar-fill {
      display: block;
      height: 10px;
    }
    .bar-aprobado { background-color: #28a745; }
    .bar-rechazado { background-color: #dc3545; }
    .bar-pendiente { background-color: #007bff; }
  `;
  document.head.appendChild(style);

  // Cargar datos y construir barras
  // Cargar datos y construir barras
fetch('/api-local/solicitudes/estadistica')
  .then(response => response.json())
  .then(data => {
    const estados = ['Aprobado', 'Rechazado', 'Pendiente'];
    const coloresClase = {
      'Aprobado': 'bar-aprobado',
      'Rechazado': 'bar-rechazado',
      'Pendiente': 'bar-pendiente'
    };

    const container = document.getElementById('goalStats');

    // Calcular el total de solicitudes (suma de todas)
    const totalSolicitudes = data.reduce((sum, item) => sum + item.total, 0);

    estados.forEach(estado => {
      const item = data.find(d => d.estado_solicitud === estado);
      const valor = item ? item.total : 0;
      const porcentaje = (valor / totalSolicitudes) * 100;

      const barHTML = `
        <div class="goal-bar">
          <div class="goal-label">
            <span>${estado}</span>
            <span><strong>${valor}</strong>/${totalSolicitudes}</span>
          </div>
          <div class="bar-background">
            <span class="bar-fill ${coloresClase[estado]}" style="width: ${porcentaje}%;"></span>
          </div>
        </div>
      `;
      container.innerHTML += barHTML;
    });
  })
  .catch(error => console.error("Error al cargar las solicitudes:", error));

</script>

<script>
async function cargarPersonasPagoLista() {
  try {
    const response = await fetch('/api-local/personass/pagosDeEstaSemana');
    if (!response.ok) throw new Error(`HTTP ${response.status}`);

    const personas = await response.json();
    const lista = document.getElementById('personasPagoLista');
    lista.innerHTML = ''; // Limpiar contenido previo

    if (personas.length === 0) {
      const div = document.createElement('div');
      div.className = 'list-group-item';
      div.textContent = 'No hay pagos programados para esta semana.';
      lista.appendChild(div);
    } else {
      personas.forEach(p => {
        const div = document.createElement('div');
        div.className = 'list-group-item';
        div.textContent = `${p.nombres_apellidos} - Tel: ${p.telefono_secundario || 'No registrado'}`;
        lista.appendChild(div);
      });
    }

    // Estilo forzado para altura máxima
    lista.style.maxHeight = '156px';
    lista.style.overflowY = personas.length > 3 ? 'auto' : 'hidden';
    lista.style.border = '1px solid #dee2e6';

  } catch (error) {
    console.error('Error al cargar personas:', error);
  }
}

window.addEventListener('DOMContentLoaded', cargarPersonasPagoLista);
</script>

<script>
async function cargarPersonasPagoRetrasadoLista() {
  try {
    const response = await fetch('/api-local/pagoss/retrasados');
    if (!response.ok) throw new Error(`HTTP ${response.status}`);

    const personas = await response.json();
    const lista = document.getElementById('personasPagoRetrasadoLista');
    lista.innerHTML = ''; // Limpiar contenido previo

    if (personas.length === 0) {
      const div = document.createElement('div');
      div.className = 'list-group-item';
      div.textContent = 'No hay pagos programados para esta semana.';
      lista.appendChild(div);
    } else {
      personas.forEach(p => {
        const div = document.createElement('div');
        div.className = 'list-group-item';
        div.textContent = `${p.nombres_apellidos} - Tel: ${p.telefono_secundario || 'No registrado'}`;
        lista.appendChild(div);
      });
    }

    // Estilo forzado para altura máxima
    lista.style.maxHeight = '156px';
    lista.style.overflowY = personas.length > 3 ? 'auto' : 'hidden';
    lista.style.border = '1px solid #dee2e6';

  } catch (error) {
    console.error('Error al cargar personas:', error);
  }
}

window.addEventListener('DOMContentLoaded', cargarPersonasPagoRetrasadoLista);
</script>

@stop

