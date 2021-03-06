


<div class="col-sm-12 col-md-offset-3 col-md-6">
  <form id="form_cad_funcionario" class="formulario" action="<?php echo base_url() ?>funcionario/cadastrar"  method="post">
    <h2>Cadastro de funcionário</h2>

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
      <select class="select" name="empresa">
          <option value="">Selecione</option>
          <?php foreach($empresas as $empresa){ ?>
            <option value="<?php echo $empresa->id ?>" <?php if($empresa->id == $this->input->post('empresa')){ ?>selected="selected"<?php }?>><?php echo $empresa->empresa ?></option>
          <?php } ?>
      </select>
    </div>


    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Nome</label>
    	<input name="nome" class="formulario-campo" value="<?php echo $this->input->post('nome')?>" type="text">
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>E-mail</label>
    	<input name="email" class="formulario-campo" value="<?php echo $this->input->post('email')?>" type="text">
    </div>

    <div class="col-md-6 formulario-grupo">
    	<label>Telefone</label>
    	<input name="fone" class="formulario-campo celnumber" value="<?php echo $this->input->post('fone')?>" type="text">
    </div>

    <div class="col-md-6 formulario-grupo">
      <label>Status</label>
      <select class="select" name="status">
          <option value="">Selecione</option>
          <option value="1" <?php if($this->input->post('status')=='1'){ ?>selected="selected"<?php }?>> Ativo</option>
          <option value="0" <?php if($this->input->post('status')=='0'){ ?>selected="selected"<?php }?>> Inativo</option>
      </select>
    </div>

    <div class="col-sm-12 col-md-12 formulario-grupo">
    	<label>Senha</label>
    	<input name="senha" class="formulario-campo" type="text"  value="<?php echo $this->input->post('senha')?>" maxlength="20">
    </div>




    <div class="col-md-12 text-right">
      <input type="hidden" name="acao" value="1" />
			<input type="submit" class="button" value="Cadastrar" />
		</div>
  </form>
</div>
