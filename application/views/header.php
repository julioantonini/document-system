<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Documentos - Área administrativa</title>

	<link href="<?php echo base_url() ?>public/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/jquery.dataTables.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/component-file.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/sweetalert2.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/buttons.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet">

	<script src="<?php echo base_url() ?>public/js/modernizr-latest.js"></script>

</head>

<body>

	<!-- inicio container -->
	<div class="container conteudo">

		<header>
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<a class="logo" href="">
						<img src="<?php echo base_url() ?>public/img/logo.png" alt="Tae seguranca" />
					</a>
				</div>
				<div class="col-sm-6 col-md-6 text-center">
				<?php if($this->session->usuario_logado['usuario_admin']) : ?>
					<h1>ADMINISTRAÇÃO</h1>
				<?php else : ?>
					<h1>ÁREA DO CLIENTE</h1>
				<?php endif ?>


				</div>
				<div class="col-sm-3 col-md-3">
					<div class="usuario-nome">
						Olá <b><?php echo $this->session->usuario_logado['usuario_nome'] ?></b>
					</div>
					<div class="usuario-foto">
						<img class="img-circle" src="<?php echo base_url()?>uploads/logotipos/<?php echo get_logotipo($this->session->usuario_logado['usuario_id_empresa']) ?>" alt="cliente" />
					</div>
				</div>
			</div>

			<div class="row">
				<nav>

					<div class="visible-xs col-md-12 text-right"><a class="menu-mobile" href="" title="Menu"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-md-12 menu-container">
						<ul class="menu">
							<li><a href="<?php echo base_url() ?>" title="">Home</a></li>

							<?php if(isset($this->session->usuario_logado['usuario_admin']) && $this->session->usuario_logado['usuario_admin'] == true) { ?>
							<li><a href="javascript:void(0)" title="">Usuário</a>
								<ul class="menu-sub">
									<li><a href="<?php echo base_url() ?>usuario/cadastrar" title="">Cadastrar</a></li>
									<li><a href="<?php echo base_url() ?>usuario" title="">Gerenciar</a></li>
								</ul>
							</li>

							<li><a href="javascript:void(0)" title="">Cliente</a>
								<ul class="menu-sub">
									<li><a href="<?php echo base_url() ?>cliente/cadastrar" title="">Cadastrar</a></li>
									<li><a href="<?php echo base_url() ?>cliente" title="">Gerenciar</a></li>
								</ul>
							</li>

							<li><a href="javascript:void(0)" title="">Funcionário</a>
								<ul class="menu-sub">
									<li><a href="<?php echo base_url() ?>funcionario/cadastrar" title="">Cadastrar</a></li>
									<li><a href="<?php echo base_url() ?>funcionario" title="">Gerenciar</a></li>
								</ul>
							</li>

							<li><a href="javascript:void(0)" title="">Documento</a>
								<ul class="menu-sub">
									<li><a href="<?php echo base_url() ?>documento/cadastrar" title="">Cadastrar</a></li>
									<li><a href="<?php echo base_url() ?>documento" title="">Gerenciar</a></li>
								</ul>
							</li>
							<?php } ?>


						</ul>




						<ul class="menu menu-usuario">
							<li class=""><a href="<?php echo base_url() ?>alterar-senha">Alterar senha</a></li>
							<li><a href="<?php echo base_url() ?>sair">Sair</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</header>



		<div class="row">
