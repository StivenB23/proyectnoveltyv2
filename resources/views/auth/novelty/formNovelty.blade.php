@extends('layout.dashboardLayout')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">REGISTRAR NOVEDAD AMBIENTE</h4>
                <form action="{{ route('novelty') }}" enctype="multipart/form-data" method="post" class="forms-sample">
                    @csrf
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Evidencia Fotográfica.(Minimo una imagen y maximo tres)</label>
                                <input type="file" multiple id="file-ip-1" accept="image/*" name="files[]"
                                    class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Cargar Imagen">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Cargar</button>
                                    </span>
                                </div>
                                @error('files')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn btn-gradient-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#imageUpload" id="btn-preview">
                                Previsualizar imagen
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="imageUpload" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">IMAGEN</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="d-flex modal-body object-fit-contain overflow-auto" id="content-image"
                                            style="width: 100%; height:500px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="col form-group">
                                <label for="photo">Seleccionar ambiente:<b class="text-danger">*</b></label>
                                <select class="form-control" name="classroom" id="">
                                    <option value="" disabled selected>Seleccionar</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->number_classroom }}</option>
                                    @endforeach
                                </select>
                                @error('classroom')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Descripción:<b class="text-danger">*</b></label>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <textarea class="form-control" name="description" id="editor" rows="3"
                                    placeholder="Escribe de manera concreta y crara cual es la novedad en el ambiente de formación"></textarea>
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
