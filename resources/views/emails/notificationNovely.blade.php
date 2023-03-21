@extends('layout.structureEmail')
@section('contentEmail')
<div class="content-email">
    <h1>HAY UNA NUEVA NOVEDAD ESPERANDO SER RESUELTA</h1>
    <small>Fecha: {{$date}}</small>
    <p>El ambiente de formación presenta una novedad técnica. </p>
    <h2>DESCRIPCIÓN</h2>
    <p>{!!$description!!}</p>
    <a href="">Ir a AsisQuick</a>
</div>
@endsection