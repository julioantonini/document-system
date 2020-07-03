


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_altera_senha" class="formulario" action="" method="post">
    <h2>Alterar senha</h2>

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
        <div class="alert alert-danger">
          <?php echo $this->session->flashdata('erro'); ?>
        </div>
      </div>
    <?php } ?>

    <?php if(isset($erro)){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-danger">
          <?php echo $erro ?>
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
    	<label>Digite sua senha atual</label>
    	<input name="senha" class="formulario-campo" type="password" maxlength="20">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Digite a nova senha</label>
    	<input name="novasenha" id="novasenha" class="formulario-campo" type="password" maxlength="20">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Repita a nova senha</label>
    	<input name="novasenha2" class="formulario-campo" type="password" maxlength="20">
    </div>

    <div class="col-md-12 text-right">
      <input type="hidden" name="acao" value="1" />
			<input type="submit" class="button" value="Alterar" />
		</div>
  </form>
</div>
