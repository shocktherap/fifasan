<?php if ($pekerjaan) { ?>
<?=anchor('pekerjaan/create', "<span class='glyphicon glyphicon-new-window'></span> Buat Pekerjaan", 'class="btn btn-default"');?>
<div class='panel panel-default'>
  <div class="panel-heading"></div>
  <div class='panel-body'>
<table class="table bordered">
  <thead>
    <th>Jenis Pekerjaan</th>
  </thead>
  <?php foreach ($pekerjaan as $key) { ?>
  <tr>
    <td><?=anchor('subpekerjaan/show/'.$key->id, $key->nama );?></a></td>
    <td><i class="icon-edit"></i><?=anchor('pekerjaan/edit/'.$key->id, "<button type='button' class='btn btn-info btn-sm' title='Edit'>
          <span class='glyphicon glyphicon-edit'></span>
        </button>");?>
    <a data-toggle="modal" href="#myModal<?=$key->id;?>"><button type="button" class="btn btn-danger btn-sm" title="Delete">
          <span class='glyphicon glyphicon-trash'></span>
        </button></a></td>
  </tr>
  <?php $data['key'] = $key;
    $this->load->view('pekerjaan/modal_delete_pekerjaan', $data);
  ?>
  <?php } ?>
</table>  
<?php } else { ?>
  <h3>Data pekerjaan tidak ada</h3>
<?php } ?>
<div class="pagination">
<?#=$link;?>
</div>
</div>
</div>