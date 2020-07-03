


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_cad_documento" class="formulario" action="<?php echo base_url()?>documento/cadastrar" method="post" enctype="multipart/form-data">
    <h2>Cadastro de documento</h2>

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

    <div class="col-md-12 formulario-grupo">
      <label>Cliente</label>
      <select class="select" name="cliente">
          <option value="">Selecione</option>
          <?php foreach($empresas as $empresa){ ?>
            <option value="<?php echo $empresa->id ?>" <?php if($empresa->id == $this->input->post('cliente') ){ ?>selected="selected"<?php }?>><?php echo $empresa->empresa ?></option>
          <?php } ?>
      </select>
    </div>

    <div class="col-md-12 formulario-grupo">
      <label>Categoria</label>
      <select class="select" name="categoria" id="select-categoria">
          <option value="">Selecione</option>
          <?php foreach($categorias as $categoria){ ?>
            <option value="<?php echo $categoria->id ?>" <?php if($categoria->id == $this->input->post('categoria') ){ ?>selected="selected"<?php }?>><?php echo $categoria->nome ?></option>
          <?php } ?>
      </select>
    </div>

    <div class="col-md-12 formulario-grupo">
      <label>Tipo documento</label>
      <select class="select" name="tipo" id="tipo_documento">
          <option value="">Selecione a categoria</option>
      </select>
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Nome do documento</label>
    	<input name="nome" class="formulario-campo" value="<?php echo $this->input->post('nome')?>" type="text">
    </div>

    <div class="col-md-12 formulario-grupo">
				<label>Documento</label>
				<input type="file" name="userfile" id="userfile" class="inputfile inputfile-2" />
				<label  for="userfile"><span>Selecione o documento&hellip;</span></label>
		</div>


    <div class="col-md-12 text-right">
      <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>" />
      <input type="hidden" name="acao" value="1" />
			<input type="submit" class="button" value="Cadastrar" />
		</div>
  </form>
</div>
