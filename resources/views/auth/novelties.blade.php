@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <h3 class="mt-1">NOVEDADES</h3>
        <form action="{{ route('noveltyClean') }}" method="POST">
            @csrf
            <button  class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-2"><i class="mdi mdi-broom fs-4"></i></button>
        </form>
        <table class="table table-light table-hover	 table-borderless align-middle" id="myTable">
            <thead>
                <tr>
                    <th>N° de novedad</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Detalles</th>
                    <th>Estado</th>
                    <th>Ambiente</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($novelties as $novelty)
                    <tr>
                        <td scope="row">
                            {{ $novelty->id }}
                        </td>
                        <td scope="row">{{ $novelty->date_novelty }}</td>
                        <td scope="row">{!! $novelty->description !!}</td>
                        <td scope="row">
                            {{ $novelty->details_procces == null ? 'No hay detalle' : $novelty->details_procces }}</td>
                        <td scope="row">{{ $novelty->state }}</td>
                        <td scope="row">
                            {{ $novelty->classroom_id }}
                        </td>
                        <td scope="row">
                            <form class="col-5" action="/restaurarcontraseña" method="post">
                                @csrf
                                <button type="submit" name="" id=""
                                    class="btn btn-primary">Inhabilitar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
