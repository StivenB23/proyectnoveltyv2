@extends('layout.dashboardLayout')
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title fs-2">BIENVENID@ {{ Auth::user()->name }}, ES UN GUSTO TENERTE DE VUELTA 😁😄</h4>
                <p>AsisQuick es un sistema creado para ayudar con los diferentes procesos en los ambientes del centro de formación; cuyo objetivo es que todo proceso sea atendido y resuelto lo más pronto posible.</p>
              <div class="row">
                <div class="col-12 col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                      <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h2 class="mb-5 fs-6 fs-md-4 fs-lg-2">Manual de Usuario</h2>
                        <i class="mdi mdi-arrow-down-bold-circle-outline fs-2"></i><span>Descargar</span>
                      </div>
                    </div>
                  </div>
                <div class="col-12 col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-primary card-img-holder text-white">
                      <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h2 class="mb-5 fs-6 fs-md-4 fs-lg-2">Manual Técnico</h2>
                        <i class="mdi mdi-arrow-down-bold-circle-outline fs-2"></i><span>Descargar</span>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
       
    </div>
</div>
@endsection