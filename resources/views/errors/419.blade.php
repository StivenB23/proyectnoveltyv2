 <!-- 403 Error Text -->
 @extends('layout.error')
 @section('message_content')
 <div class="row d-flex justify-content-center mt-4">
    <div class="col-12 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-primary rounded text-white">
            <p class="fs-1 text-center">419</p>
            <h3 class="fs-2 lead text-gray-800 mb-5">Tiempo de espera excedido</h3>
                <p class="fs-3" >Has tardado demasiado tiempo sin interactuar con la página, refreca o da clic en el enlace de abajo.</p>
                <a class="text-white" href="{{ route('dashboard') }}">Volver</a>
            </div>
            </div>
          </div>
       
    </div>
  
    
@endsection