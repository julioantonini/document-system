


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_cad_usuario" class="formulario" action="<?php echo base_url() ?>usuario/cadastrar" method="post">
    <h2>Cadastro de usuário</h2>

    <?php if(validation_errors()){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-danger">
          <?php echo validation_errors('<div>', '</div>'); ?>
        </div>
      </div>
    <?php } ?>

    <?php if($this->session->flashdata('erro')){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-danger">">
          <?php echo $this->session->flashdata('erro'); ?>
        </div>
      </div>
    <?php } ?>

    <?php if($this->session->flashdata('aviso')){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-info">
          <?php echo $this->session->flashdata('aviso'); ?>
        </div>
      </div>
    <?php } ?>

    <?php if($this->session->flashdata('sucesso')){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-success">
          <?php echo $this->session->flashdata('sucesso'); ?>
        </div>
      </div>
    <?php } ?>



    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Nome</label>
    	<input name="nome" value="<?php echo $this->input->post('nome') ?>" class="formulario-campo" type="text">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>E-mail</label>
    	<input name="email" value="<?php echo $this->input->post('email') ?>" class="formulario-campo" type="text">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Senha</label>
    	<input name="senha" value="<?php echo $this->input->post('senha') ?>" class="formulario-campo" type="text" maxlength="20">
    </div>

    <div class="col-md-12 text-right">
      <input type="hidden" name="acao" value="1" />
			<input type="submit" class="button" value="Cadastrar" />
		</div>
  </form>
</div>
