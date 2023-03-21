 <!-- 403 Error Text -->
 @extends('layout.error')
 @section('message_content')
 <div class="row d-flex justify-content-center mt-4">
    <div class="col-12 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-primary rounded text-white">
            <p class="fs-1 text-center">403</p>
            <h3 class="fs-2 lead text-gray-800 mb-5">Permiso Denegado</h3>
                <p class="fs-3" >Lo sentimos, no tienes los permisos suficientes para acceder.</p>
                <a class="text-white" href="{{ route('dashboard') }}">Volver</a>
            </div>
            </div>
          </div>
       
    </div>
  
    
@endsection