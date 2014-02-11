<?php if ($pekerjaan) { ?>
<?=anchor('pekerjaan/create', 'Create New Pekerjaan', 'class="btn btn-primary"');?>

<table class="table bordered">
  <thead>
    <th>Jenis Pekerjaan</th>
  </thead>
  <?php foreach ($pekerjaan as $key) { ?>
  <tr>
    <td><?=anchor('subpekerjaan/show/'.$key->id, $key->nama );?></a></td>
    <td><i class="icon-edit"></i><?=anchor('pekerjaan/edit/'.$key->id, 'Edit');?></td>
    <td><a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a></td>
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