@extends('adminlte::page')

@section('title', 'Solicitudes - Creando nueva solicitud')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <!-- Logo en la esquina izquierda -->
        <img src="{{ asset('img/logo-adepes.png') }}" alt="Logo ADEPES" style="height: 60px;">
        
        <!-- Contenedor de los títulos centrados -->
        <div class="text-center flex-grow-1">
            <h1 class="titulo-negrita">Asociación de Desarrollo Pespirense</h1>
            <h1 class="titulo-negrita">"ADEPES"</h1>
        </div>

        <!-- Espacio vacío para mantener el título centrado -->
        <div style="width: 60px;"></div>
    </div>
@stop

@section('css')
   
@stop

@section('content')
<div class="container">
    <h2>Administración de Préstamos</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('Prestamo.create') }}" class="btn btn-primary">Nuevo</a>
    </div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
@stop