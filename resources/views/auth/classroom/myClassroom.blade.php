@extends('layout.dashboardLayout')
@section('content')
@if (count($classroom) == 0)
    <h1>Lo sentimos, pero no tiene ambientes asignados</h1>
@else
    <h1 class="fs-2 fw-bold" >Ambiente {{$classroom[0]->number_classroom}}</h1>
    <div class="d-flex flex-wrap gap-1">
        @foreach ($classroom as $data)
                <div class=" rounded-1 shadow-sm bg-white p-3">
                    <h1 class="text-primary" >{{ $data['number_classroom'] }}</h1>
                    <a href="/miambientehistorial/{{$data->id}}">Ver novedades</a>
                </div>
        @endforeach
    </div>
@endif
@endsection