@extends('layout.dashboardLayout')
@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDITAR EQUIPO</h4>
                <form action="/computer/{{ $computer->id }}" method="post" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="row d-flex flex-column flex-sm-row">
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Código:<b class="text-danger">*</b></label>
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" value="{{ $computer->code }}" name="code"
                                id="exampleInputUsername1" placeholder="Username">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputUsername1">Número equipo:<b class="text-danger">*</b></label>
                            @error('numberComputer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="numberComputer"
                                value="{{ $computer->number_computer }}" id="exampleInputUsername1" placeholder="Username">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="mb-3">
                            <label for="" class="">Ambiente:<b class="text-danger">*</b></label>
                            <select class=" mb-2 overflow-y-auto form-control" aria-label="size 3 select example"
                                name="classroom" id="classroom">
                                <option value="NULL" selected>No aplica</option>
                                @foreach ($classrooms as $classroom)
                                    @if ($classroom->id == $computer->classroom_id)
                                        <option style="color:green" selected value="{{ $classroom->id }}">
                                            {{ $classroom->number_classroom }}</option>
                                    @endif
                                    <option style="color:green" value="{{ $classroom->id }}">
                                        {{ $classroom->number_classroom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Actualizar equipo</button>
                </form>
            </div>
        </div>
    </div>
@endsection
