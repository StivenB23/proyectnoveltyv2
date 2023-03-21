@extends('layout.dashboardLayout')
@section('content')
    <div class="">
        <h2><a href="{{route('classrooms')}}" class="menu-title mdi mdi-chevron-left" ></a> Historial Ambiente {{$classroom[0]->number_classroom}}</h2>
        <div class="">
            @if($history->count() == 0)
                <h3>NO HAY NOVEDADES</h3>
            @else
                @if ($classroom[0]->user_id == Auth::user()->id)
                <div class="d-flex flex-wrap gap-1">
                    @foreach ($history as $data)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                @php
                                            setlocale(LC_ALL, 'esp');
                                            $dateFriendly = \Carbon\Carbon::parse(strtotime($data->date_novelty))->diffForHumans();
                                            $dateFormat = \Carbon\Carbon::parse(strtotime($data->date_novelty))->formatLocalized('%d de %B del %Y');
                                @endphp
                                <span class=" card-title">{{$dateFriendly}}</span>    
                                @switch($data->state)
                                    @case('pendiente')
                                        {{-- <span class="card-title text-warning text-center text-white p-1">Pendiente</span> --}}

                                        <span class="card-title text-warning text-center p-1">Pendiente</span>
                                        @break
                                    @case('en proceso')
                                        <span class="card-title text-info p-1">En proceso</span>
                                        @break
                                    @case('hecho')
                                        <span class="card-title text-success p-1">Hecho</span>
                                        @break
                                    @default
                                    <span class="card-title text-danger text-dark p-1">Error</span>
                                        
                                @endswitch
                            </div>
                           
                              @php
                              $description = substr($data->description,3,90);
                          @endphp
                        <p class="card-text">{!! $description !!}...</p>
                          {{-- <img src="{{asset('storage/NoveltyImage/'.$data->photo_evidence)}}" width="100" alt=""> --}}
                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novelty-{{$data->id}}">
                                Ver más
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="novelty-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-mg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">NOVEDAD</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            // $date = date("j F, Y",strtotime($data->date_novelty))
                                        @endphp
                                       <div class="row">
                                        <div class="col-12 overflow-auto">
                                            <img src="{{ asset('storage/NoveltyImage/'.$data->photo_evidence) }}" width="300" alt="">
                                        </div>
                                        <div class="col-12">
                                           
                                            <h4>{{$dateFormat}}</h4>
                                            {!!$data->description!!}
                                        </div>
                                       </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                          {{-- <a href="#" class="card-link">Another link</a> --}}
                        </div>
                      </div>
                  
                    @endforeach
                </div>
                @else
                <div class="d-flex flex-wrap gap-1">
                    @foreach ($history as $data)
                        @php
                            setlocale(LC_ALL, 'esp');
                            $today = date("Y-m-d");
                            $dateComparation = date("Y-m-d", strtotime($today . "- 15 days"));
                            $dateFriendly = \Carbon\Carbon::parse(strtotime($data->date_novelty))->diffForHumans();
                            $dateFormat = \Carbon\Carbon::parse(strtotime($data->date_novelty))->formatLocalized('%d de %B del %Y');
                        @endphp
                        @if ($data->date_novelty > $dateComparation)    
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between">
                                    <span class=" card-title" id="date-novelty">{{$dateFriendly}}</span>    
                                    @switch($data->state)
                                        @case('pendiente')
                                            {{-- <span class="card-title text-warning text-center text-white p-1">Pendiente</span> --}}
    
                                            <span class="card-title text-warning text-center p-1">Pendiente</span>
                                            @break
                                        @case('en proceso')
                                            <span class="card-title text-info p-1">En proceso</span>
                                            @break
                                        @case('hecho')
                                            <span class="card-title text-success p-1">Hecho</span>
                                            @break
                                        @default
                                        <span class="card-title text-danger text-dark p-1">Error</span>
                                            
                                    @endswitch
                                </div>
                                  @php
                                  $description = substr($data->description,3,90);
                              @endphp
                            <p class="card-text">{!! $description !!}...</p>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novelty-{{$data->id}}">
                                Ver más
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="novelty-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-mg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">NOVEDAD</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row">
                                        <div class="col-12 overflow-auto">
                                            <img src="{{ asset('storage/NoveltyImage/'.$data->photo_evidence) }}" width="300" alt="">
                                        </div>
                                        <div class="col-12">
                                           
                                            <h4>{{$dateFormat}}</h4>
                                            {!!$data->description!!}
                                        </div>
                                       </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                          </div>
                        @endif
                    @endforeach
                </div>
                @endif
            @endif
           
        </div>
    </div>
      {{-- Moment js --}}
      <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
      <script>
          moment.locale();  
          let date = document.getElementById('date-novelty');
          let dateNew  = 
      </script>
@endsection