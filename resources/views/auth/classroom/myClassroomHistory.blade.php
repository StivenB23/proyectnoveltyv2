@extends('layout.dashboardLayout')
@section('content')
    <div>
        <label class="fw-bold" for="inputFilter">Filtrar</label>
        <input type="text" name="filterSearch" id="inputFilter" placeholder="Filtrar" class="form-control my-2" aria-label="Text input with dropdown button">
    </div>
    <div class="d-flex gap-2 flex-wrap">
        @foreach ($history as $data)
            <div class="card h-auto" id="card" state="{{$data->state}}" date="{{$data->date_novelty}}" style="width: 18rem;">
                <div class="card-body">
                    <div class=" d-flex justify-content-between">
                        @php
                            setlocale(LC_ALL, 'esp');
                            $dateFriendly = \Carbon\Carbon::parse(strtotime($data->date_novelty))->diffForHumans();
                            $dateFormat = \Carbon\Carbon::parse(strtotime($data->date_novelty))->formatLocalized('%d de %B del %Y');
                            $dateFormatResolved = \Carbon\Carbon::parse(strtotime($data->date_resolved))->formatLocalized('%d de %B del %Y');
                        @endphp
                        <span class=" card-title">{{ $dateFormat }}</span>
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
                    <hr>
                    <h3>Acciones</h3>
                    <div class="d-flex gap-1">
                        <form action="/novedad" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            @switch($data->state)
                                @case('pendiente')
                                    <input type="hidden" name="state" value="en proceso">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descriptión:</label>
                                        <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                    </div>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-gradient-info btn-rounded btn-icon"
                                            data-bs-toggle="modal" data-bs-target="#novelty-{{ $data->id }}">
                                            <i class="mdi mdi-eye" title="Ver detalle novedad"></i>
                                        </button>
                                        <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon"
                                            title="Poner en proceso">
                                            <i class="mdi mdi-cube-send fs-4"></i>
                                        </button>
                                    </div>
                                @break

                                @case('en proceso')
                                    <input type="hidden" name="state" value="hecho">
                                    <button type="button" class="btn btn-gradient-info btn-rounded btn-icon mx-2"
                                        data-bs-toggle="modal" data-bs-target="#novelty-{{ $data->id }}"
                                        title="Ver detalle novedad">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button type="submit" class="btn btn-gradient-success btn-rounded btn-icon mx-2"
                                        title="terminar novedad">
                                        <i class="mdi mdi-check-circle-outline fs-4"></i>
                                    </button>
                                @break

                                @default
                                    <button type="button" class="btn btn-gradient-info btn-rounded btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#novelty-{{ $data->id }}" title="Ver detalle novedad">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                            @endswitch
                        </form>
                    </div>
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
                                        @if ($data->type == 'ambiente')
                                            <div class="col-12 overflow-auto">
                                                @foreach ($data->images as $image)
                                                    <img class="my-1"
                                                        src="{{ asset('storage/NoveltyImage/' . $image->image) }}"
                                                        width="300" alt="">
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <h4>Fecha Novedad: {{ $dateFormat }}</h4>
                                            <h4>Notificado por: {{$data->instructor->name}}</h4>
                                            @if ($data->date_resolved !== null)
                                                <h4>Resuelto el {{ $dateFormatResolved }}</h4>
                                            @endif
                                            @if ($data->type == 'equipo')
                                                <p>Equipo:<b>{{ $data->computer->number_computer }}</b></p>
                                            @endif
                                            <p>Ambiente:<b>{{ $data->classroom->number_classroom }}</b></p>
                                            <p class="mb-0"><b>Descripción novedad:</b></p>
                                            {!! $data->description !!}
                                            @if ($data->details_procces !== null)
                                                <p class="mb-0"><b>Descripción Proceso:</b><br>
                                                    {{ $data->details_procces }}</p>
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
@endsection
