@extends('layout.dashboardLayout')
@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ACTUALIZAR DATOS</h4>
                <form action="/user/{{ $user->id }}" method="post" class="forms-sample">
                    @method('PUT')
                    @csrf
                    <div class="row d-flex flex-column flex-sm-row">
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                id="exampleInputUsername1" placeholder="Username">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Apellidos</label>
                            <input type="text" class="form-control" value="{{ $user->lastname }}" name="lastname"
                                id="exampleInputUsername1" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numberDocument">Número de documento</label>
                        <input type="number" readonly disabled value="{{ $user->number_document }}" class="form-control"
                            id="numberDocument" placeholder="">
                    </div>
                    <div class="row ">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ambiente/s: </label>
                            @foreach ($classrooms as $classroom)
                                @if ($classroom->user_id == $user->id)
                                    <span>{{ $classroom->number_classroom }}</span>
                                @endif
                            @endforeach
                            <br>
                            <small>Seleccione el/los nuevo/s ambiente, incluidos los antiguos si es el caso.</small>
                            <select class="form-select form-select-sm" multiple name="classrooms[]" id="classrooms" required>
                              <option value="NULL" selected>No cambiar</option>
                                @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}"  >
                                        {{ $classroom->number_classroom }}
                                       {{ $classroom->user_id == null ? 'Disponible':'No disponible' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>

    <script>
        new MultiSelectTag('classrooms')
    </script>
    {{-- <form action="/user/{{Auth::user()->id}}" method="post">
        @method('PUT')
        @csrf
        <label for="">Nombre:</label>
        <input type="text" >
        <label for="">Apellido:</label>
        <input type="text"name="lastname" >
        <label for="">Documento:</label>
        <input type="text" >
        <label for="">Correo:</label>
        <input type="text" >
        <label for="">Ambiente Asignado</label>
        <select name="classroom" id="">
            @if ($user->classroom_id === null)
                <option value="NULL" selected>Ninguno</option>   
            @endif
            @foreach ($classrooms as $classroom)
            @if ($classroom->id === $user->classroom_id)
                <option value="{{$classroom->id}}" selected>{{$classroom->number_classroom}}</option>
            @endif
                <option value="{{$classroom->id}}">{{$classroom->number_classroom}}</option>
            @endforeach
        </select>
        <button type="submit" >Actualizar</button>
    </form> --}}
@endsection
