@extends('layout.structure')
@section('title','Login')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <h1 class="fw-bold fs-2 text-primary" ><img
                src="{{ asset('assets/images/logoSena.png') }}" alt="logo sena"
                style="width: 30px; height:30px"> AsisQuick</h1>
              <h4>¡Hola! empecemos</h4>
              <h6 class="font-weight-light">Inicia sesión para continuar.</h6>
              <form action="{{route('login')}}" method="post" class="pt-3">
                @csrf
                <div class="form-group">
                  <input type="number" class="form-control form-control-lg" name="number_document" id="exampleInputEmail1" placeholder="Número de documento" value="{{ old('number_document') }}" >
                  @error('number_document')      
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg pl-1"  name="password" id="exampleInputPassword1" placeholder="Contraseña">
                  @error('password')      
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="my-3 text-center">
                  <button type="submit" class="w-75  btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >Entrar</button>
                </div>
                <div class="text-center"> 
                  <a class="mt-2 " href="{{ route('forgotPassword') }}">¿Has olvidado tu contraseña?</a>
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