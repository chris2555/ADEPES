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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $TotalUsuarios }}</h3>
                    <p>USUARIOS</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Mostrar usuario <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- CLIENTES -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $TotalPersonas }}</h3>
                    <p>CLIENTES</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('gestionclientes.index') }}" class="small-box-footer">Mostrar clientes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- SOLICITUDES -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $TotalSolicitudesAprobadas }}</h3>
                    <p>Solicitudes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('solicitudes.index') }}" class="small-box-footer">Mostrar solicitudes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- TOTAL PRESTADO -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($TotalMontosAprobados, 2) }} LPS</h3>
                    <p>Total Prestado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('prestamos.index') }}" class="small-box-footer">Mostrar prestamos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- TOTAL CARTERA -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($CarteraEmpresa, 2) }} LPS</h3>
                    <p>Total Cartera</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('configuraciones.index') }}" class="small-box-footer">Mostrar Cartera <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- TOTAL PAGADO -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($TotalPagado, 2) }} LPS</h3>
                    <p>Total Pagado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('pagos.index') }}" class="small-box-footer">Mostrar pagos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
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



    <!-- Gráfico: Estadísticas (Monto Prestado) -->
    <div class="col-12 d-flex justify-content-left">
        <div class="card w-100" style="max-width: 800px;">
            <div class="card-body">
                <h5 class="card-title">Monto Prestado por Mes</h5>
                <div style="position: relative; width: 100%; height: auto;">
                    <canvas id="montoPrestadoChart"></canvas>
                </div>
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
<script>
    Swal.fire({
        title: "Exitoso!",
        text: "Bienvenido al panel general!",
        icon: "success"
    });
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
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
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
@section('js')
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
@stop

