@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <h3 class="mt-1">EQUIPOS</h3>
        <form action="{{ route('computerClean') }}" method="POST">
            @csrf
            <button  class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-2" title="Limpiar Equipos"><i class="mdi mdi-broom fs-4"></i></button>
        </form>
        <table class="table table-light table-hover	 table-borderless align-middle" id="myTable">
            <thead>
                <tr>

                    <th>Código</th>
                    <th>N° equipo</th>
                    <th>Ambiente</th>
                    {{-- <th colspan="2">Acciones</th> --}}
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($computers as $computer)
                    <tr>
                        <td scope="row">
                            <a href="/computer/{{ $computer->id }}">{{ $computer->code }}</a>
                        </td>
                        <td scope="row">{{ $computer->number_computer }}</td>
                        <td scope="row">{{ $computer->classroom->number_classroom == null ? 'No asignado' : $computer->classroom->number_classroom}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
