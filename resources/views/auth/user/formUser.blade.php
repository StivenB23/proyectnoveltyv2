@extends('layout.dashboardLayout')
@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">REGISTRAR USUARIO</h4>
                <form action="{{ route('formUser') }}" method="post" class="forms-sample">
                    @csrf
                    <div class="row d-flex flex-column flex-sm-row">
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Nombre:<b class="text-danger">*</b></label>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                id="exampleInputUsername1" placeholder="Username">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Apellidos:<b class="text-danger">*</b></label>
                            @error('lastname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}"
                                id="exampleInputUsername1" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numberDocument">Número de documento:<b class="text-danger">*</b></label>
                        @error('number_document')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="number"name="number_document" value="{{ old('number_document') }}"
                            class="form-control" id="numberDocument" placeholder="">
                    </div>
                    <div class="row ">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Correo:<b class="text-danger">*</b></label>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Ambiente:<b class="text-danger">*</b></label>
                            <select class=" mb-2 overflow-y-auto " aria-label="size 3 select example" multiple
                                name="classrooms[]" id="classrooms">
                                <option value="NULL" selected>No aplica</option>
                                @foreach ($classrooms as $classroom)
                                    <option style="color:green" value="{{ $classroom->id }}">
                                        {{ $classroom->number_classroom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Registrar usuario</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>

    <script>
        new MultiSelectTag('classrooms') // id
    </script>
@endsection
