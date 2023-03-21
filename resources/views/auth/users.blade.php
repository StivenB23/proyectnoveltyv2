@extends('layout.dashboardLayout')
@section('content')
    <div class="table-responsive rounded bg-white">
        <a href="{{ route('formUser') }}" class="btn btn-gradient-primary btn-rounded btn-icon mt-2 pt-2">
            <i class="mdi mdi-account-plus fs-4"></i>
        </a>
        <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mt-2" data-bs-toggle="modal"
            data-bs-target="#registerclassroom">
            <i class="mdi mdi-chair-school"></i><i class="mdi mdi-plus"></i>
        </button>
        <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mt-2" data-bs-toggle="modal"
            data-bs-target="#uploadData"><i class="mdi mdi-upload"></i>
        </button>
        <div class="modal fade" id="uploadData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-mg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">CARGA DE DATOS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('uploadData') }}" method="post" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo:<b class="text-danger">*</b></label>
                                <select class="form-select form-select-sm" required name="type" id="">
                                    <option disabled selected>Seleccionar</option>
                                    <option value="instructor">Instructores</option>
                                    <option value="classroom">Ambientes</option>
                                </select>
                            </div>
                            <div class="row ">
                                <div class="col form-group">
                                    
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cargar Archivo(csv):<b class="text-danger">*</b></label>
                                        <div class="form-group">
                                            <input type="file" multiple id="file-ip-1" accept=""
                                                name="file" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Cargar Archivo">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-primary"
                                                        type="button">Cargar</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="block-inline mx-auto">
                                <button type="submit" class="block btn btn-gradient-primary ">Cargar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerclassroom" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                    <label for="exampleInputUsername1">Número de ambiente:<b class="text-danger">*</b></label>
                                    <input type="numeric" class="form-control" name="classroom" id="exampleInputUsername1"
                                        placeholder="501, 402..." required >
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
        <table class="table table-light table-hover	 table-borderless align-middle" id="myTable">
            <thead>
                <tr>
                    <th>N° de documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Ambiente</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($users as $user)
                    <tr>
                        <td scope="row">
                            <a href="/user/{{ $user->id }}">
                                {{ $user->number_document }}
                            </a>
                        </td>
                        <td scope="row">{{ $user->name }}</td>
                        <td scope="row">{{ $user->lastname }}</td>
                        <td scope="row">{{ $user->email }}</td>
                        <td scope="row">{{ $user->role }}</td>
                        <td scope="row">
                            @foreach ($classrooms as $classroom)
                                @if ($user->id == $classroom->user_id)
                                    {{ $classroom->number_classroom }}
                                @endif
                            @endforeach
                        </td>
                        <td scope="row">
                            <form class="col-5" action="/restaurarcontraseña" method="post">
                                @csrf
                                <input type="hidden" name="document" value="{{ $user->number_document }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <button type="submit" name="" id="" class="btn btn-primary"><i
                                        class="mdi mdi-refresh"></i>Clave</button>
                            </form>
                        </td>
                        <td>
                            <form action="/changeStateUser" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                @if ($user->state == true)
                                    <button type="submit" name="" id=""
                                        class="btn btn-warning btn-small"><i
                                            class="mdi mdi-refresh"></i>Inhabilitar</button>
                                @else
                                    <button type="submit" name="" id=""
                                        class="btn btn-success btn-small"><i
                                            class="mdi mdi-refresh"></i>Habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
