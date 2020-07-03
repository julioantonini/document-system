


<div class="col-sm-12 col-md-12">

    <h2>Download de documentos</h2>

    <h3 class="setor"><img src="<?php echo base_url() ?>public/img/<?php echo get_foto_categoria($tipo[0]->id_categoria) ?>" /> <span><?php echo get_categoria_nome($tipo[0]->id_categoria) ?> - <?php echo $tipo[0]->nome ?></span></h3>


    <?php if(isset($documentos[0]->id)) { ?>

      <table  class="tbl-data display nowrap" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nome do arquivo</th>
                    <th class="no-sort">Data de cadastro</th>
                    <th class="no-sort" style="width:50px">Ações</th>
                </tr>
            </thead>
            <tbody>


              <?php  foreach($documentos as $doc){ ?>
                <tr>
                    <td><?php echo $doc->documento_nome ?></td>
                    <td><?php echo $doc->nome ?></td>
                    <td><?php echo data_br($doc->data_cad) ?></td>
                    <td><a class="link-table" href="<?php echo base_url() ?>download/<?php echo $doc->id ?>">Baixar</a></td>
                </tr>
            <?php }; ?>

            </tbody>
        </table>



    <?php } else {?>
      <h3>Nenhum documento encontrado</h3>
    <?php } ?>

</div>
