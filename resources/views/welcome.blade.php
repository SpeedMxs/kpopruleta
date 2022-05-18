<!DOCTYPE html>
<html>

<head>
    <title>Agregar integrantes de {{$nombre}}</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/cropper.css')}}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
    img {
        display: block;
        max-width: 50%;
        max-height: 50%
    }

    .preview {
        overflow: hidden;
        width: 300px;
        height: 300px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: auto !important;
        max-height: auto !important;
    }
</style>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url("/") }}">
                Mi bias
            </a>
            <a class="navbar-brand" href="{{ url("/grupos") }}">
                Agregar grupo
            </a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card">
            <h2 class="card-header">NUEVO INTEGRANTE DE {{$nombre}}</h2>
            <div class="card-body">
                <h5 class="card-title">SELECCIONA IMAGEN</h5>
                <input type="file" name="image" class="image" accept="image/png, image/gif, image/jpeg">
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">AGREGAR INTEGRANTE
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" height="50%"
                                    width="50%">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <H5>NOMBRE</H5>
                <input type="text" id="nombre" name="nombre" onkeyup="this.value = this.value.toUpperCase();"
                    placeholder="NOMBRE">
                @foreach ($nombres as $item)
                <input type="hidden" value="{{$item->id}}" id="grupo" name="grupo">
                @endforeach
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="container" align="center">
        <div class="row">

            @foreach($integrantes as $integrante)
            <div class="col-4">
                <div class="card2">
                    <img src="{{asset('upload/'.$integrante->name)}}" alt="Avatar" style="width:100%">
                    <div class="container2">
                        <h4><b>{{$integrante->nombre}}</b></h4>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e){
        var files = e.target.files;
        var done = function (url) {
        image.src = url;
        $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
        file = files[0];
        if (URL) {
        done(URL.createObjectURL(file));
        } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
        done(reader.result);
        };
        reader.readAsDataURL(file);
        }
        }
        });
        $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
        });
        }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        });
        $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
        width: 600,
        height: 600,
        });
        canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob); 
        reader.onloadend = function() {
        var base64data = reader.result;
        var nombre = document.getElementById('nombre').value;
        var grupo = document.getElementById('grupo').value;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/imagen",
            data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data,'nombre': nombre, 'grupo': grupo},
            success: function(data){
                console.log(data);
                $modal.modal('hide');
                alert("Integrante agregado correctamente");
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.statusText);
                alert(thrownError);
            }
        });
        }
        });
        })
    </script>
</body>

</html>