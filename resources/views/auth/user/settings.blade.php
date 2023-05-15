@extends('layout.dashboardLayout')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title fs-2">INFORACIÓN USUARIO</h4>
                        <h4 class="fs-4">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h4>
                        <p>{{ Auth::user()->number_document }}</p>
                        <form action="/changeEmail" method="post">
                            @csrf
                            <div class="col-6 form-group">
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <label class="fw-bold" for="exampleInputEmail1">Correo</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ Auth::user()->email }}" placeholder="Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label class="fw-bold" for="exampleInputEmail1">Nueva contraseña:</label>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                    placeholder="Una contraseña segura tiene mayusculas, minusculas y números">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Guardar cambios</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
