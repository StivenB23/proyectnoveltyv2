@extends('layout.dashboardLayout')
@section('content')

    <div class="d-flex flex-column flex-wrap flex-sm-row gap-1">
        @foreach ($classrooms as $classroom)  
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{$classroom->number_classroom}}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Ambiente de formación</h6>
              {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
              <a href="ambiente/{{$classroom->id}}">Ver Historial</a>
            </div>
          </div>  
        @endforeach
    </div>
@endsection