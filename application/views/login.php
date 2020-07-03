<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Documentos - Área administrativa</title>

	<link href="<?php echo base_url() ?>public/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet">

	<script src="<?php echo base_url() ?>public/js/modernizr-latest.js"></script>

</head>

<body>

	<div class="login-box">
		<div class="login-logo">
			<img src="<?php echo base_url() ?>public/img/logo-g.png" alt="Tae Segurança" />
		</div>

		<div class="login-box-login">
			<div class="login-box-top">
				Área do cliente
			</div>

			<div class="login-box-form">

				<?php if(validation_errors()){ ?>
		        <div class="alert alert-danger">
		          <?php echo validation_errors('<div>', '</div>'); ?>
		        </div>
		    <?php } ?>

		    <?php if($this->session->flashdata('erro')){ ?>
		        <div class="alert alert-danger">
		          <?php echo $this->session->flashdata('erro'); ?>
		        </div>
		    <?php } ?>

				<?php if(isset($erro)){ ?>
						<div class="alert alert-danger">
							<?php echo $erro ?>
						</div>
				<?php } ?>

		    <?php if($this->session->flashdata('aviso')){ ?>
		        <div class="alert alert-info">
		          <?php echo $this->session->flashdata('aviso'); ?>
		        </div>
		    <?php } ?>

				<?php if($this->session->flashdata('sucesso')){ ?>
		        <div class="alert alert-success">
		          <?php echo $this->session->flashdata('sucesso'); ?>
		        </div>
		    <?php } ?>




				<form id="form_login" class="formulario" action="<?php echo base_url() ?>entrar" method="post">

			    <div class="formulario-grupo">
			    	<label>E-mail</label>
			    	<input name="email" value="<?php echo $this->input->post('email') ?>" class="formulario-campo" type="text">
			    </div>

			    <div class="formulario-grupo">
			    	<label>Senha</label>
			    	<input name="senha" class="formulario-campo" type="password" maxlength="20">
			    </div>

			    <div class="text-right">
							<input type="hidden" name="acao" value="1" />
							<input type="submit" class="button" value="Entrar" />
					</div>

					<p>Usuário e senha de demonstração (Administração):</p>
					<p>Usuário: <b>admin@admin.com.br</b></p>
					<p>Senha: <b>123123</b></p>
					<hr />
					<p>Usuário e senha de demonstração (Área do cliente):</p>
					<p>Usuário: <b>f1@cocacola.com.br</b></p>
					<p>Senha: <b>123123</b></p>
			  </form>

			</div>

		</div>
	</div>






	<script src="<?php echo base_url() ?>public/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>public/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>public/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>public/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url() ?>public/js/maskedinput.js"></script>
	<script src="<?php echo base_url() ?>public/js/custom-file-input.js"></script>
	<script src="<?php echo base_url() ?>public/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url() ?>public/js/scripts.js"></script>

</body>

</html>
