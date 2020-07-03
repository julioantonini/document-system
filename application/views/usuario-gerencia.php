


<div class="col-sm-12 col-md-12">
    <h2>Gerenciamento de usuários</h2>

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


    <table  class="tbl-data display nowrap" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th class="no-sort" style="width:50px">Ações</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach($usuarios as $usuario){ ?>
              <tr>
                  <td><?php echo $usuario->nome ?></td>
                  <td><?php echo $usuario->email ?></td>
                  <td><a class="link-table" href="<?php echo base_url()?>usuario/alterar/<?php echo $usuario->id ?>">Alterar</a>
                      <a class="link-table btn-delete" href="<?php echo base_url()?>usuario/deletar/<?php echo $usuario->id ?>">Excluir</a>
                  </td>
              </tr>
          <?php }; ?>
          </tbody>
      </table>

</div>
