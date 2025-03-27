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
                    <h3>{{ $TotalMontosAprobados }}</h3>
                    <p>Total Prestado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('prestamos.index') }}" class="small-box-footer">Mostrar prestamos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>


        <div class="card bg-gradient-blue">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>

                <div class="card-tools">

                    <div class="btn-group">

                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Add new event</a>
                            <a href="#" class="dropdown-item">Clear events</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-body pt-0">

                <div id="calendar" style="width: 100%">
                    <div class="bootstrap-datetimepicker-widget usetwentyfour">
                        <ul class="list-unstyled">
                            <li class="show">
                                <div class="datepicker">
                                    <div class="datepicker-days" style="">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="prev" data-action="previous"><span
                                                            class="fa fa-chevron-left" title="Previous Month"></span></th>
                                                    <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                        title="Select Month">December 2023</th>
                                                    <th class="next" data-action="next"><span class="fa fa-chevron-right"
                                                            title="Next Month"></span></th>
                                                </tr>
                                                <tr>
                                                    <th class="dow">Su</th>
                                                    <th class="dow">Mo</th>
                                                    <th class="dow">Tu</th>
                                                    <th class="dow">We</th>
                                                    <th class="dow">Th</th>
                                                    <th class="dow">Fr</th>
                                                    <th class="dow">Sa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td data-action="selectDay" data-day="11/26/2023"
                                                        class="day old weekend">26</td>
                                                    <td data-action="selectDay" data-day="11/27/2023" class="day old">27
                                                    </td>
                                                    <td data-action="selectDay" data-day="11/28/2023" class="day old">28
                                                    </td>
                                                    <td data-action="selectDay" data-day="11/29/2023" class="day old">29
                                                    </td>
                                                    <td data-action="selectDay" data-day="11/30/2023" class="day old">30
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/01/2023" class="day">1</td>
                                                    <td data-action="selectDay" data-day="12/02/2023" class="day weekend">2
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/03/2023"
                                                        class="day active today weekend">3</td>
                                                    <td data-action="selectDay" data-day="12/04/2023" class="day">4
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/05/2023" class="day">5
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/06/2023" class="day">6
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/07/2023" class="day">7
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/08/2023" class="day">8
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/09/2023"
                                                        class="day weekend">9</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/10/2023"
                                                        class="day weekend">10</td>
                                                    <td data-action="selectDay" data-day="12/11/2023" class="day">11
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/12/2023" class="day">12
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/13/2023" class="day">13
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/14/2023" class="day">14
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/15/2023" class="day">15
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/16/2023"
                                                        class="day weekend">16</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/17/2023"
                                                        class="day weekend">17</td>
                                                    <td data-action="selectDay" data-day="12/18/2023" class="day">18
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/19/2023" class="day">19
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/20/2023" class="day">20
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/21/2023" class="day">21
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/22/2023" class="day">22
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/23/2023"
                                                        class="day weekend">23</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/24/2023"
                                                        class="day weekend">24</td>
                                                    <td data-action="selectDay" data-day="12/25/2023" class="day">25
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/26/2023" class="day">26
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/27/2023" class="day">27
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/28/2023" class="day">28
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/29/2023" class="day">29
                                                    </td>
                                                    <td data-action="selectDay" data-day="12/30/2023"
                                                        class="day weekend">30</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/31/2023"
                                                        class="day weekend">31</td>
                                                    <td data-action="selectDay" data-day="01/01/2024" class="day new">1
                                                    </td>
                                                    <td data-action="selectDay" data-day="01/02/2024" class="day new">2
                                                    </td>
                                                    <td data-action="selectDay" data-day="01/03/2024" class="day new">3
                                                    </td>
                                                    <td data-action="selectDay" data-day="01/04/2024" class="day new">4
                                                    </td>
                                                    <td data-action="selectDay" data-day="01/05/2024" class="day new">5
                                                    </td>
                                                    <td data-action="selectDay" data-day="01/06/2024"
                                                        class="day new weekend">6</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="datepicker-months" style="display: none;">
                                        <table class="table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="prev" data-action="previous"><span
                                                            class="fa fa-chevron-left" title="Previous Year"></span></th>
                                                    <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                        title="Select Year">2023</th>
                                                    <th class="next" data-action="next"><span
                                                            class="fa fa-chevron-right" title="Next Year"></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><span data-action="selectMonth"
                                                            class="month">Jan</span><span data-action="selectMonth"
                                                            class="month">Feb</span><span data-action="selectMonth"
                                                            class="month">Mar</span><span data-action="selectMonth"
                                                            class="month">Apr</span><span data-action="selectMonth"
                                                            class="month">May</span><span data-action="selectMonth"
                                                            class="month">Jun</span><span data-action="selectMonth"
                                                            class="month">Jul</span><span data-action="selectMonth"
                                                            class="month">Aug</span><span data-action="selectMonth"
                                                            class="month">Sep</span><span data-action="selectMonth"
                                                            class="month">Oct</span><span data-action="selectMonth"
                                                            class="month">Nov</span><span data-action="selectMonth"
                                                            class="month active">Dec</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="datepicker-years" style="display: none;">
                                        <table class="table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="prev" data-action="previous"><span
                                                            class="fa fa-chevron-left" title="Previous Decade"></span>
                                                    </th>
                                                    <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                        title="Select Decade">2020-2029</th>
                                                    <th class="next" data-action="next"><span
                                                            class="fa fa-chevron-right" title="Next Decade"></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><span data-action="selectYear"
                                                            class="year old">2019</span><span data-action="selectYear"
                                                            class="year">2020</span><span data-action="selectYear"
                                                            class="year">2021</span><span data-action="selectYear"
                                                            class="year">2022</span><span data-action="selectYear"
                                                            class="year active">2023</span><span data-action="selectYear"
                                                            class="year">2024</span><span data-action="selectYear"
                                                            class="year">2025</span><span data-action="selectYear"
                                                            class="year">2026</span><span data-action="selectYear"
                                                            class="year">2027</span><span data-action="selectYear"
                                                            class="year">2028</span><span data-action="selectYear"
                                                            class="year">2029</span><span data-action="selectYear"
                                                            class="year old">2030</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="datepicker-decades" style="display: none;">
                                        <table class="table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="prev" data-action="previous"><span
                                                            class="fa fa-chevron-left" title="Previous Century"></span>
                                                    </th>
                                                    <th class="picker-switch" data-action="pickerSwitch" colspan="5">
                                                        2000-2090</th>
                                                    <th class="next" data-action="next"><span
                                                            class="fa fa-chevron-right" title="Next Century"></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><span data-action="selectDecade"
                                                            class="decade old" data-selection="2006">1990</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2006">2000</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2016">2010</span><span
                                                            data-action="selectDecade" class="decade active"
                                                            data-selection="2026">2020</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2036">2030</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2046">2040</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2056">2050</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2066">2060</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2076">2070</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2086">2080</span><span
                                                            data-action="selectDecade" class="decade"
                                                            data-selection="2096">2090</span><span
                                                            data-action="selectDecade" class="decade old"
                                                            data-selection="2106">2100</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li class="picker-switch accordion-toggle"></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        </section>

    </div>

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
