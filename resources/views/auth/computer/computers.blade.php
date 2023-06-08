@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <h3 class="mt-1">EQUIPOS</h3>
        <form action="{{ route('computerClean') }}" method="POST">
            @csrf
            <button class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-2" title="Limpiar Equipos"><i
                    class="mdi mdi-broom fs-4"></i></button>
            <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mt-2" data-bs-toggle="modal"
                data-bs-target="#registrarComputer" title="Añadir Equipo"><i class="mdi mdi-plus"></i>
            </button>
        </form>
        <div class="modal fade" id="registrarComputer" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-mg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRAR EQUIPO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('computer') }}" method="post" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputUsername1">Código:<b class="text-danger">*</b></label>
                                <input type="numeric" class="form-control" name="code" id="exampleInputUsername1"
                                    placeholder="137325367" required>
                                <label for="exampleInputUsername1">Número de equipo:<b class="mt-1 text-danger">*</b></label>
                                <input type="numeric" class="form-control" name="numberComputer" id="exampleInputUsername1"
                                    placeholder="137325367" required>
                                <label for="" class="form-label">Ambientes:<b class="text-danger">*</b></label>
                                <select class="form-select form-select-sm" required name="classroom" id="">
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->number_classroom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="block-inline mx-auto">
                                <button type="submit" class="block btn btn-gradient-primary ">Guardar Equipo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                        <td scope="row">
                            {{ $computer->classroom->number_classroom == null ? 'No asignado' : $computer->classroom->number_classroom }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
