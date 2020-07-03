


<div class="col-sm-12 col-md-12">
    <h2>Gerenciamento de documentos</h2>

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

    <form id="frm_select_empresas" name="frm_select_empresas" class="formulario"  action="<?php echo base_url() ?>documento" method="post">
      <div class="row">

        <div class="col-md-12 formulario-grupo">
          <label>Cliente</label>
          <select class="select" name="empresa">
              <option value="">Selecione</option>
              <?php foreach($empresas as $empresa){ ?>
                <option value="<?php echo $empresa->id ?>"
                  <?php if(@$cliente[0]->id == $empresa->id){ ?>selected="selected"<?php }?>
                  ><?php echo $empresa->empresa ?>  (<?php echo get_qtds('tbl_documento','id_cliente',$empresa->id); ?>)</option>
              <?php } ?>
          </select>
        </div>

      <div class="col-md-12 text-right">
        <input type="hidden" name="acao" value="1" />
  			<input type="submit" class="button" value="Listar documentos" />
  		</div>
      </div>
    </form>

    <?php if(isset($documentos)){?>

    <h3>Documentos da empresa: <br /><img class="img-table img-circle" src="<?php echo base_url()?>uploads/logotipos/<?php echo $cliente[0]->logotipo ?>" /> <b><?php echo $cliente[0]->empresa ?></b> </h3>



    <table  class="tbl-data display nowrap" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>Nome do arquivo</th>
                  <th>Categoria</th>
                  <th>Tipo documento</th>
                  <th class="no-sort">Data de cadastro</th>
                  <th class="no-sort" style="width:50px">Ações</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach($documentos as $documento){ ?>
              <tr>
                  <td><?php echo $documento->documento_nome ?></td>
                  <td><?php echo $documento->nome ?></td>
                  <td><?php echo get_categoria_nome($documento->id_categoria) ?></td>
                  <td><?php echo get_tipo_nome($documento->id_tipo) ?></td>
                  <td><?php echo data_br($documento->data_cad) ?></td>
                  <td><a class="link-table" href="<?php echo base_url() ?>documento/download/<?php echo $documento->id ?>">Baixar</a>
                      <a class="link-table btn-delete" href="<?php echo base_url() ?>documento/deletar/<?php echo $documento->id ?>">Excluir</a>
                  </td>
              </tr>
          <?php }; ?>
          </tbody>
      </table>
      <?php }; ?>

</div>
