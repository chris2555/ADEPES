
@extends('layout.app')


@section('subtitle', 'Pagos')

@section('content_body')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Pagos</h1>
        <x-adminlte-button label="Agregar un pago" theme="primary" data-toggle="modal" data-target="#insert" />
    </header>

    <section>
        <x-adminlte-datatable striped id="table" :heads="$info['headsTable']" :config="$info['config']" with-buttons>
            @foreach ($info['config']['data'] as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!} </td>
                    @endforeach
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </section>

    

@stop

