


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_cad_cliente" class="formulario" action="<?php echo base_url()?>cliente/cadastrar" method="post" enctype="multipart/form-data">
    <h2>Cadastro de cliente</h2>

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
    	<label>Nome</label>
    	<input name="empresa" value="<?php echo $this->input->post('empresa') ?>" class="formulario-campo" type="text">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>CNPJ</label>
    	<input name="cnpj" value="<?php echo $this->input->post('cnpj') ?>" class="formulario-campo cnpj" type="text" maxlength="18">
    </div>

    <div class="col-md-4 formulario-grupo">
						<label>CEP</label>
						<input name="cep" id="cep" value="<?php echo $this->input->post('cep') ?>"  class="formulario-campo cep" onblur="getEndereco();" type="text">
					</div>

					<div class="col-md-8 formulario-grupo">
						<label>Endereço</label>
						<input name="endereco" id="endereco" value="<?php echo $this->input->post('endereco') ?>"  class="formulario-campo"  type="text">
					</div>

					<div class="col-md-2 formulario-grupo">
						<label>Numero</label>
						<input name="numero" value="<?php echo $this->input->post('numero') ?>"   class="formulario-campo" type="text">
					</div>

					<div class="col-md-4 formulario-grupo">
						<label>Bairro</label>
						<input name="bairro" id="bairro" value="<?php echo $this->input->post('bairro') ?>"   class="formulario-campo" type="text">
					</div>

					<div class="col-md-6 formulario-grupo">
						<label>Cidade</label>
						<input name="cidade" id="cidade" value="<?php echo $this->input->post('cidade') ?>"   class="formulario-campo" type="text">
					</div>

					<div class="col-md-6 formulario-grupo">
						<label>Estado</label>
						<select class="select" name="estado" id="estado">
				 	  		<option value="selecione">Selecione</option>
                <?php $estados = get_estados();
                  foreach($estados as $estado){?>
				                <option value="<?php echo $estado->sigla ?>" <?php if($estado->sigla==$this->input->post('estado')){ ?>selected="selected"<?php }?>><?php echo $estado->nome ?></option>
                <?php }; ?>
				        </select>
					</div>

					<div class="col-md-6 formulario-grupo">
						<label>Complemento</label>
						<input name="complemento" value="<?php echo $this->input->post('complemento') ?>"   class="formulario-campo" type="text">
					</div>


    <div class="col-md-6 formulario-grupo">
    	<label>Telefone</label>
    	<input name="fone" value="<?php echo $this->input->post('fone') ?>"  class="formulario-campo celnumber" type="text">
    </div>

    <div class="col-md-6 formulario-grupo">
      <label>Status</label>
      <select class="select" name="status">
          <option value="">Selecione</option>
          <option value="1" <?php if($this->input->post('status')=='1'){ ?>selected="selected"<?php }?>> Ativo</option>
          <option value="0" <?php if($this->input->post('status')=='0'){ ?>selected="selected"<?php }?>> Inativo</option>
      </select>
    </div>

    <div class="col-md-12 formulario-grupo">
				<label>Logotipo</label>
				<input type="file" name="userfile" id="userfile" value="" class="inputfile inputfile-2" />
				<label  for="userfile"><span>Selecione o logotipo&hellip;</span></label>
		</div>

    <div class="col-md-12 text-right">
      <input type="hidden" name="acao" value="1" />
		  <input type="submit" class="button" value="Cadastrar" />
		</div>
  </form>
</div>
