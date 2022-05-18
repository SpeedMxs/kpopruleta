<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inicio</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap2.css')}}">
  </link>
</head>

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
  <br>
  <br>
  <div class="container d-flex justify-content-center">
    <div class="row">

      @foreach($datgrupos as $grupos)


      <div class="col-3">
        <div class="card2">
          <a href="ruleta/{{$grupos->nameg}}">
            <img src="{{asset('upload/'.$grupos->name)}}" alt="Avatar" style="width:100%">
            <div class="container2">
              <h4><b>{{$grupos->nameg}}</b></h4>
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</body>

</html>