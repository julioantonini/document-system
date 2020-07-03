


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_cad_cliente" class="formulario" action="<?php echo base_url()?>cliente/logotipo/<?php echo $cliente[0]->id ?>" method="post" enctype="multipart/form-data">
    <h2>Alteração de logotipo</h2>

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

    <?php if(isset($erro_upload)){ ?>
      <div class="col-md-12">
        <br />
        <div class="alert alert-danger">
          <?php echo $erro_upload ?>
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
    	<label>Empresa</label>
    	<input name="empresa" value="<?php echo $cliente[0]->empresa ?>" class="formulario-campo" disabled type="text">
    </div>


    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Logotipo atual</label>
    	<img class="img-circle" src="<?php echo base_url()?>uploads/logotipos/<?php echo $cliente[0]->logotipo ?>" />
    </div>




    <div class="col-md-12 formulario-grupo">
				<label>Logotipo</label>
				<input type="file" name="userfile" id="userfile" value="" class="inputfile inputfile-2" />
				<label  for="userfile"><span>Selecione o logotipo&hellip;</span></label>
		</div>

    <div class="col-md-12 text-right">
      <input type="hidden" name="id" value="<?php echo $cliente[0]->id ?>" />
      <input type="hidden" name="acao" value="1" />
		  <input type="submit" class="button" value="Alterar" />
		</div>
  </form>
</div>
