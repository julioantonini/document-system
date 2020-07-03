


<div class="col-sm-12 col-md-12">
    <h2>Gerenciamento de clientes</h2>

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
                  <th class="no-sort">Logotipo</th>
                  <th>Empresa</th>
                  <th>CNPJ</th>
                  <th>Func</th>
                  <th>Doc</th>
                  <th>Status</th>
                  <th class="no-sort" style="width:50px">Ações</th>
              </tr>
          </thead>
          <tbody>

              <?php foreach($clientes as $cliente){ ?>
              <tr>
                  <td><img class="img-table img-circle" src="<?php echo base_url()?>uploads/logotipos/<?php echo $cliente->logotipo ?>" /></td>
                  <td><?php echo $cliente->empresa ?></td>
                  <td><?php echo $cliente->cnpj ?></td>
                  <td><center><?php echo get_qtds('tbl_usuario','id_empresa',$cliente->id) ?></center></td>
                  <td><center><?php echo get_qtds('tbl_documento','id_cliente',$cliente->id) ?></center></td>
                  <td><?php echo get_status($cliente->status) ?></td>
                  <td><a class="link-table" href="<?php echo base_url()?>cliente/alterar/<?php echo $cliente->id ?>">Alterar</a>
                      <a class="link-table" href="<?php echo base_url()?>cliente/logotipo/<?php echo $cliente->id ?>">Logotipo</a>
                      <a class="link-table btn-delete" href="<?php echo base_url() ?>cliente/deletar/<?php echo $cliente->id ?>">Excluir</a>
                  </td>
              </tr>
              <?php };?>





          </tbody>
      </table>

</div>
