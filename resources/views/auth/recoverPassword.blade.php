@extends('layout.structure')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <h1 class="fw-bold fs-2 text-primary" >RESTAURAR CONTRASEÑA</h1>
              <form action="/recoverpassword" method="post" class="pt-3">
                @csrf
                <input type="hidden" name="document" value="{{$document}}">
                <div class="form-group">
                  <input type="number" class="form-control form-control-lg" name="password" id="exampleInputEmail1" placeholder="Número de documento">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg"  id="exampleInputPassword1" placeholder="Contraseña">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >Restaurar</button>
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