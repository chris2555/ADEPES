@extends('adminlte::page')

@section('title', 'dash')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>PANEL GENERAL</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
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
    </div>
</div>

 <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $TotalSolicitudesAprobadas }}</h3>
                    <p>Total Pagado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('pagos.index') }}" class="small-box-footer">Mostrar pagos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

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

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


@stop
