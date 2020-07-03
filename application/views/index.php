<div class="col-md-12">

  <?php if(isset($this->session->usuario_logado['usuario_admin']) && ($this->session->usuario_logado['usuario_admin'] == true)){ ?>

    <h2>Painel administrativo</h2>

    <?php if($this->session->flashdata('sucesso')){ ?>

        <div class="alert alert-success">
          <?php echo $this->session->flashdata('sucesso'); ?>
        </div>

    <?php } ?>

  <?php }  ?>

  <?php if($this->session->usuario_logado['usuario_admin'] != true){ ?>
  <h2>Documentos</h2>

  <?php if($this->session->flashdata('sucesso')){ ?>

      <div class="alert alert-success">
        <?php echo $this->session->flashdata('sucesso'); ?>
      </div>

  <?php } ?>

  <?php if($this->session->flashdata('erro')){ ?>

      <div class="alert alert-danger">
        <?php echo $this->session->flashdata('erro'); ?>
      </div>

  <?php } ?>

</div>
<div class="col-sm-4 col-md-15 bloco-home">
  <img class="img-fluid" src="<?php echo base_url() ?>public/img/rh.jpg" />
  <ul>
    <?php if(!isset($cat_rh[0]->id)){ ?>
    <li><a href="javascript:void(0)">Nenhum documento cadastrado nesta categoria</a></li>
    <?php } ?>

    <?php foreach($cat_rh as $rh) {?>
    <li><a href="<?php echo base_url() ?>lista-documento/<?php echo $rh->id ?>"><?php echo $rh->nome ?></a></li>
    <?php } ?>
  </ul>
</div>

<div class="col-sm-4 col-md-15 bloco-home">
  <img class="img-fluid" src="<?php echo base_url() ?>public/img/financeiro.jpg" />
  <ul>
    <?php if(!isset($cat_fi[0]->id)){ ?>
    <li><a href="javascript:void(0)">Nenhum documento cadastrado nesta categoria</a></li>
    <?php } ?>

    <?php foreach($cat_fi as $fi) {?>
    <li><a href="<?php echo base_url() ?>lista-documento/<?php echo $fi->id ?>"><?php echo $fi->nome ?></a></li>
    <?php } ?>
  </ul>
</div>

<div class="col-sm-4 col-md-15 bloco-home">
  <img class="img-fluid" src="<?php echo base_url() ?>public/img/operacional.jpg" />
  <ul>
    <?php if(!isset($cat_op[0]->id)){ ?>
    <li><a href="javascript:void(0)">Nenhum documento cadastrado nesta categoria</a></li>
    <?php } ?>

    <?php foreach($cat_op as $op) {?>
    <li><a href="<?php echo base_url() ?>lista-documento/<?php echo $op->id ?>"><?php echo $op->nome ?></a></li>
    <?php } ?>
  </ul>
</div>


<div class="col-sm-4 col-md-15 bloco-home">
  <img class="img-fluid" src="<?php echo base_url() ?>public/img/ouvidoria.jpg" />
  <ul>
    <li><a href="javascript:void(0)">Fale com a Diretoria</a></li>
  </ul>
</div>

<div class="col-sm-4 col-md-15 bloco-home">
  <img class="img-fluid" src="<?php echo base_url() ?>public/img/sugestao.jpg" />
  <ul>
    <li><a href="javascript:void(0)">Enviar sugestão</a></li>
  </ul>
</div>

<?php } ?>
