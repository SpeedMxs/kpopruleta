<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Roulette.js Demo</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
	</link>
	<link rel="stylesheet" href="{{asset('css/bootstrsap-responsive.css')}}">
	</link>
	<link rel="stylesheet" href="{{asset('css/demo.css')}}">
	</link>
	<link rel="stylesheet" href="{{asset('css/bootstrap2.css')}}">
	</link>
</head>

<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="{{ url("/") }}">
				Mi bias
			</a>
		</div>
	</nav>
	<div class="container">
		<h1 align="center" style="color: deeppink">{{$name}}</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="roulette_container">
					<div class="roulette" style="display:none;">
						@foreach ($integrantes as $integrante)
						@if($integrante->nombre=="LOGO")
						<img src="{{asset('upload/'.$integrante->name)}}" alt="$integrante->id">
						@endif
						@endforeach
						@foreach ($integrantes as $integrante)
						@if($integrante->nombre!="LOGO")
						<img src="{{asset('upload/'.$integrante->name)}}" alt="$integrante->id">
						@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="btn_container">
					<p>
						@foreach ($tipo as $tipos)
						@if ($tipos->tipo === 0)
						<button class="button2 start">COMENZAR</button>
						@else
						<button class="button start">COMENZAR</button>
						@endif
						@endforeach


					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container d-flex justify-content-center">
		<div class="row">
		@foreach ($integrantes as $integrante)
		@if($integrante->nombre!="LOGO")
		<div class="card" style="width: 8rem;">
			<img src="{{asset('upload/'.$integrante->name)}}" alt="$integrante->id">
			<h5 class="card-title">{{$integrante->nombre}}</h5>
		</div>
		@endif
		@endforeach
	</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
	<script src="{{asset('js/roulette.js')}}"></script>
	<script src="{{asset('js/demo.js')}}"></script>

</body>

</html>