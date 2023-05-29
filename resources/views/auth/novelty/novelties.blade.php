@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <h3 class="mt-1">NOVEDADES</h3>
        <form action="{{ route('noveltyClean') }}" method="POST">
            @csrf
            @if (!$novelties->isEmpty())
                <button class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-2"><i class="mdi mdi-broom fs-4"
                        title="Limpiar novedades"></i></button>
            @endif
        </form>
        <table class="table table-light table-hover	 table-borderless align-middle" id="myTable">
            <thead>
                <tr>
                    <th>N° de novedad</th>
                    <th>Fecha</th>
                    <th>Fecha Resuelto</th>
                    <th>Tipo</th>
                    <th>Detalles</th>
                    <th>Estado</th>
                    <th>Notificado por</th>
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
                        <td scope="row">{{ $novelty->date_resolved == null ? 'No resuelto' : $novelty->date_resolved }}
                        </td>
                        <td scope="row">{{ $novelty->type }}</td>
                        <td scope="row">
                            {{ $novelty->details_procces == null ? 'No hay detalle' : $novelty->details_procces }}</td>
                        <td scope="row">{{ $novelty->state }}</td>
                        <td scope="row">
                            {{ $novelty->instructor->name }}
                            {{ $novelty->instructor->lastname }}
                        </td>
                        <td scope="row">
                            {{ $novelty->classroom->number_classroom }}
                        </td>
                        <td scope="row">
                            @if ($novelty->state != 'hecho')
                                <form class="col-5" action="/terminarnovedad" method="post">
                                    @csrf
                                    <input type="hidden" name="idNovelty" value="{{ $novelty->id }}">
                                    <button type="submit" name="" id=""
                                        class="btn btn-danger">Terminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
