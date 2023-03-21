@extends('layout.structureEmail')
@section('contentEmail')
<div class="content-email">
    <h1>USTED HA SOLICITADO RESTAURAR SU CONTRASEÑA</h1>
    <p>AsisQuick ha iniciado el proceso de restaurar contraseña, para continuar el proceso ingrese al enlace de abajo. </p>
    <a href="/restaurarcontraseña/{{$document}}">Ir a AsisQuick</a>
</div>
@endsection