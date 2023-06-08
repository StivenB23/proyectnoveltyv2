@extends('layout.dashboardLayout')
@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">REGISTRAR NOVEDAD EQUIPO</h4>
                <form action="{{ route('noveltycomputer') }}" enctype="multipart/form-data" method="post" class="forms-sample">
                    @csrf
                    <div class="row ">
                        <div class="col-12 ">
                            <div class="form-group">
                                <div id="reader"></div>
                                <input type="number" class="form-control form-control-lg mb-1" name="code"
                                    id="inputCodeComputer" placeholder="código del equipo"
                                    value="{{ old('code') }}">
                                <button type="button" id="buttonScann" class="btn btn btn-gradient-primary mb-2" >
                                    Escanear código
                                </button>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="mb-12">
                                <label for="" class="form-label">Descripción:<b class="text-danger">*</b></label>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <textarea class="form-control" name="description" id="editor" rows="3"
                                    placeholder="Escribe de manera concreta y crara cual es la novedad en el ambiente de formación" value="{{ old('description') }}"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="block-inline mx-auto">
                        <button type="submit" class="block btn btn-gradient-primary ">Registrar Novedad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/hwmrt8clrbojrvcwv76ey23z7hq7hrt93os3bhnceg2crkk2/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor',
            skin: 'bootstrap',
            statusbar: false,
            plugins: 'lists, link, image, media',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
            menubar: true,
            spellchecker_languages: 'US English=en_US,UK English=en_GB,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Norwegian=nb,Brazilian Portuguese=pt,Iberian Portuguese=pt_PT,Spanish=es,Swedish=sv',
            spellchecker_dialog: true,
            spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
        });
    </script>
@endsection
