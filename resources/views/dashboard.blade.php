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

  <div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Total de Pagos Por Mes</h5>
        <div style="max-width: 500px;">
            <canvas id="pagosChart" style="height: 300px;"></canvas>
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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const formatted = new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(value);
                                return `${context.dataset.label}: $${formatted}`;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error("Error al cargar los pagos:", error);
    });


    </script>
@stop
