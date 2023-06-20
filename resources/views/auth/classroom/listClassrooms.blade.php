@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <h3 class="mt-1">AMBIENTES</h3>
        <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mt-2" data-bs-toggle="modal"
            data-bs-target="#registerclassroom" title="Añadir Ambiente">
            <i class="mdi mdi-chair-school"></i><i class="mdi mdi-plus"></i>
        </button>
        <div class="modal fade" id="registerclassroom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-mg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRAR AMBIENTE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/ambiente" method="post" class="forms-sample">
                            @csrf
                            <div class="row ">
                                <div class="col form-group">
                                    <label for="exampleInputUsername1">Número de ambiente:<b
                                            class="text-danger">*</b></label>
                                    <input type="numeric" class="form-control" name="classroom" id="exampleInputUsername1"
                                        placeholder="501, 402..." required>
                                    @error('classroom')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="block-inline mx-auto">

                                <button type="submit" class="block btn btn-gradient-primary ">Registrar Ambiente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form class="d-inline" action="{{ route('deleteClassroom') }}" method="POST">
            @csrf
            <button class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-1" data-confirm-delete="true"
                title="Limpiar Ambientes"><i class="mdi mdi-restore fs-4"></i></button>
        </form>
        <table class="table table-light table-hover	 table-borderless align-middle" id="myTable">
            <thead>
                <tr>
                    <th>Id classroom</th>
                    <th>Numero de ambiente</th>
                    <th>Cuentadante</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->id }}</td>
                        <td>{{ $classroom->number_classroom }}</td>
                        <td>{{ $classroom->user->name ?? ' ' }} {{ $classroom->user->lastname ?? 'No asignado' }}</td>
                        <td scope="row">
                            <form class="col-5" action="/eliminarambiente" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $classroom->id }}">
                                <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon"
                                    title="Añadir Equipo"><i class="mdi mdi-delete-empty"></i>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
