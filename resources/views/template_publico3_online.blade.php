<!DOCTYPE html>
<html lang="en">
<head>
<title>GRUPOTRIBUNA</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="DirectoryPlus template project">
<meta name="viewport" content="width=device-width, initial-scale=1">



<meta name="_token" content="{!! csrf_token() !!}"/>



<link rel="icon" href="http://atdigital.com.br/cadastro/images/favicon.ico">
<link href="http://atdigital.com.br/cadastro/vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.3.4/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
</head>
<body>

<!-- Menu -->

<div class="menu">
	<div class="menu_container text-right">
		<div class="menu_close">Fechar X</div>
		<nav class="menu_nav">
			<ul>
				<li><a href="#">Ramais</a></li>
				<li><a target="_blank" href="http://atdigital.com.br/assinatura/">Assinatura</a></li>
				<li><a href="http://atdigital.com.br/cadastro/ramais/cadastro">Cadastro</a></li>
				<li><a href="login">Login</a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_overlay"></div>
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			
			<!-- Logo -->
			<div class="logo">

                <a class="navbar-brand" href="http://atdigital.com.br/cadastro/ramais/">
                    <img src= "{{ ('http://atdigital.com.br/cadastro/images/logo-grupo.png')}}" alt="Logo GrupoTribuna"/>
                </a>

			</div>



			<!-- Header Nav -->
			<div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
				<nav class="main_nav">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li class="active"><a href="https://www.atribuna.com.br/" target="_blank">A TRIBUNA ONLINE</a></li>
						<li><a target="_blank" href="http://codigodeeticagrupotribuna.com.br/">Código de Ética</a>
						</li>
						<li><a target="_blank" href="http://atdigital.com.br/assinatura/">Assinatura</a></li>
						<li><a target="_blank" href="http://atdigital.com.br/cadastro/ramais/faq">Como utilizar o aparelho</a></li>
						<li><a target="_blank" href="http://atdigital.com.br/cadastro/ramais/cadastro">Cadastrar</a></li>
					</ul>
				</nav>
				<div class="add_listing text-center trans_200"><a href="http://atdigital.com.br/cadastro/ramais/login">Login</a></div>
				<div class="hamburger">
					<i class="fa fa-bars trans_200"></i>
				</div>
			</div>

		</div>
	</header>


	<div class="super_container_inner">
		<div class="super_overlay"></div>



		<!-- Home -->

		<div class="home3">

			@include($page)

		</div>
		<!-- Home -->


		<!-- Clients --><!--Espaçador Vertical--> 

		<div class="clients">
			<div class="container">
				<div class="row">
					<div class="col">

						<!-- Clients Slider -->
						<div class="clients_slider_container">

						</div>
					</div>
				</div>
			</div>
		</div>



		<!-- Footer -->

		<footer class="footer container_custom">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_container d-flex flex-md-row flex-column align-items-center justify-content-md-start justify-content-center">
							<div class="copyright order-md-1 order-2">
								<span>Direitos Reservados © GRUPO<strong>TRIBUNA</strong> 2019</span>
							</div>
							<nav class="footer_nav ml-md-auto order-md-2 order-1">
								<ul class="d-flex flex-row align-items-center justify-content-start">
									<li class="active"><a href="https://www.atribuna.com.br/" target="_blank">A TRIBUNA ONLINE</a></li>
									<li><a target="_blank" href="http://codigodeeticagrupotribuna.com.br/">Código de Ética</a></li>
									<li><a target="_blank" href="http://atdigital.com.br/cadastro/ramais/faq">Como utilizar o aparelho</a></li>
									<li><a target="_blank" href="http://atdigital.com.br/cadastro/ramais/login">Login</a></li>
									<li><a target="_blank"href="http://atdigital.com.br/cadastro/ramais/cadastro">Cadastrar</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
		
</div>


<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/ramais.js') }}"></script>
<script src="{{ asset('plugins/OwlCarousel2-2.3.4/owl.carousel.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>