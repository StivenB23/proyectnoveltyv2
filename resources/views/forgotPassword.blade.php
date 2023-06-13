@extends('layout.structure')
@section('title', 'Login')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h1 class="fw-bold fs-2 text-primary">AsisQuick</h1>
                            <h4>Restaurar contraseña</h4>
                            <a href="{{ route('login') }}">Volver</a>
                            <form action="{{ route('resetPassword') }}" method="post" class="pt-3">
                                @csrf
                                <div class="form-group">
                                    <h6>Ingrese su número de documento:</h6>
                                    <input type="number" class="form-control form-control-lg" name="number_document"
                                        id="exampleInputEmail1" placeholder="123456789"
                                        value="{{ old('number_document') }}">
                                    @error('number_document')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Restaurar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
