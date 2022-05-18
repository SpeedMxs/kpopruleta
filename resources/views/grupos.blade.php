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
    <hr>

    <div class="container">
        <H4 align="center">AGREGAR NUEVO GRUPO</H4>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <form action="{{ url("/grupos")}}" method="POST">
                    <div class="mb-3 align-items-center">
                        <label for="nombregrupo" class="form-label">NOMBRE DEL GRUPO</label>
                        <input type="text" class="form-control" id="nombregrupo" name="nombregrupo"
                            onkeyup="this.value = this.value.toUpperCase();" required>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <br>
                            <select class="form-select" id="tipo" name="tipo" aria-label="Floating label select example" required>
                                <option value="1">GIRL GROUP</option>
                                <option value="2">BOY GROUP</option>
                              </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="gruponoexiste" required>
                        <label class="form-check-label" for="gruponoexiste">ACEPTO QUE EL GRUPO NO EXISTE EN LA BASE DE DATOS</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    <br>
    <br>
    <hr>
    <div class="container" align="center">
        <h4>GRUPOS EXISTENTES</h4>
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th scope="col">Nombre</th>
                    <th scope="col">Integrantes</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                <tr class="table-primary">
                    <th scope="row">{{$grupo->name}}</th>
                    <td>@php
                         $exist= false;
                        @endphp
                        @foreach($datgrupos as $num)
                            @if($num->nameg == $grupo->name)
                                {{$num->num}}
                                @foreach ($integrantes as $item)
                                    @if ($item->grupo_id ==$grupo->id)    
                                     {{$item->nombre}},
                                    @endif
                                @endforeach


                                @php
                                    $exist=true;
                                @endphp
                            @endif
                        @endforeach
                        @if($exist==false)
                            0
                        @endif
                    </td>
                    <td><a href="{{url('agregaintegrantes/'.$grupo->name)}}" class="btn btn-primary">Editar integrantes</a></td>
                </tr>
                @endforeach
            </tbody>

    </div>
</body>

</html>