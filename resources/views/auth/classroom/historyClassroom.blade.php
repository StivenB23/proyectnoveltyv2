@extends('layout.dashboardLayout')
@section('content')
    <div class="">
        @if ($history->count() == 0)
            <h3><a href="{{ route('classrooms') }}" class="menu-title mdi mdi-chevron-left"></a> NO HAY NOVEDADES</h3>
        @else
            <h2><a href="{{ route('classrooms') }}" class="menu-title mdi mdi-chevron-left"></a> Historial Ambiente
                {{ $classroom[0]->number_classroom }}</h2>
            <div class="">
                <div>
                    <label class="fw-bold" for="inputFilter">Filtrar</label>
                    <input type="text" name="filterSearch" id="inputFilter" placeholder="Filtrar" class="form-control my-2" aria-label="Text input with dropdown button">
                </div>
                @if ($classroom[0]->user_id == Auth::user()->id)
                    <div class="d-flex flex-wrap gap-1">
                        @foreach ($history as $data)
                            <div class="card" id="card" state="{{$data->state}}" date="{{$data->date_novelty}}" style="width: 18rem;">
                                <div class="card-body">
                                    <div class=" d-flex justify-content-between">
                                        @php
                                            setlocale(LC_ALL, 'esp');
                                            $dateFriendly = \Carbon\Carbon::parse(strtotime($data->date_novelty))->diffForHumans();
                                            $dateFormat = \Carbon\Carbon::parse(strtotime($data->date_novelty))->formatLocalized('%d de %B del %Y');
                                            $dateFormatResolved = \Carbon\Carbon::parse(strtotime($data->date_resolved))->formatLocalized('%d de %B del %Y');
                                        @endphp
                                        <span class=" card-title">{{ $dateFriendly }}</span>
                                        @switch($data->state)
                                            @case('pendiente')
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
                                        $description = substr($data->description, 3, 90);
                                    @endphp
                                    <p class="card-text">{!! $description !!}...</p>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#novelty-{{ $data->id }}">
                                        Ver más
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="novelty-{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-mg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">NOVEDAD</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-11 bg-white rounded mx-auto d-flex overflow-auto">
                                                            @if ($data->type == 'ambiente')
                                                                @foreach ($data->images as $image)
                                                                    <img class="m-1 rounded shadow "
                                                                        src="{{ asset('storage/NoveltyImage/' . $image->image) }}"
                                                                        width="200" height="250" alt="">
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <h4>Fecha Novedad: {{ $dateFormat }}</h4>
                                                            <h4>Notificado por: {{$data->instructor->name}}</h4>
                                                            @if ($data->date_resolved != null)
                                                                <h4>Resuelto el {{ $dateFormatResolved }}</h4>
                                                            @endif
                                                            <p>Tipo Novedad: {{ $data->type }}</p>
                                                            <p>Estado: <b>{{ $data->state }}</b></p>
                                                            <p class="mb-0"><b>Descripción:</b></p>
                                                            {!! $data->description !!}
                                                            @if ($data->details_procces !== null)
                                                                <p class="mb-0"><b>Descripción del proceso:</b></p>
                                                                <p>{{ $data->details_procces }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                <div class="d-flex flex-wrap gap-1">
                    @foreach ($history as $data)
                            @php
                                setlocale(LC_ALL, 'esp');
                                $today = date('Y-m-d');
                                $dateComparation = date('Y-m-d', strtotime($today . '- 15 days'));
                                $dateFriendly = \Carbon\Carbon::parse(strtotime($data->date_novelty))->diffForHumans();
                                $dateFormat = \Carbon\Carbon::parse(strtotime($data->date_novelty))->formatLocalized('%d de %B del %Y');
                                $dateFormatResolved = \Carbon\Carbon::parse(strtotime($data->date_resolved))->formatLocalized('%d de %B del %Y');
                            @endphp
                            @if ($data->date_novelty > $dateComparation)
                                <div class="card" id="card" state="{{$data->state}}" date="{{$data->date_novelty}}" style="width: 18rem;">
                                    <div class="card-body">
                                        <div class=" d-flex justify-content-between">
                                            <span class=" card-title" id="date-novelty">{{ $dateFriendly }}</span>
                                            @switch($data->state)
                                                @case('pendiente')
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
                                            $description = substr($data->description, 3, 90);
                                        @endphp
                                        <p class="card-text">{!! $description !!}...</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#novelty-{{ $data->id }}">
                                            Ver más
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="novelty-{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-mg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">NOVEDAD</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div
                                                                class="col-11 bg-white rounded mx-auto d-flex overflow-auto">
                                                                @if ($data->type == 'ambiente')
                                                                    @foreach ($data->images as $image)
                                                                        <img class="m-1 rounded shadow "
                                                                            src="{{ asset('storage/NoveltyImage/' . $image->image) }}"
                                                                            width="300" height="300" alt="">
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="col-12">
                                                                <h4>Fecha Novedad:-- {{ $dateFormat }}</h4>
                                                                <h4>Notificado por: {{$data->instructor->name}}</h4>
                                                                @if ($data->date_resolved !== null)
                                                                    <h4>Resuelto el {{ $dateFormatResolved }}</h4>
                                                                @endif
                                                                <p>Tipo Novedad: {{ $data->type }}</p>
                                                                <p>Estado: {{ $data->state }}</p>
                                                                <p class="mb-0"><b>Descripción:</b></p>
                                                                {!! $data->description !!}
                                                                @if ($data->details_procces !== null)
                                                                    <p class="mb-0"><b>Descripción del proceso:</b></p>
                                                                    <p>{{ $data->details_procces }}</p>
                                                                @endif
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
@endsection
