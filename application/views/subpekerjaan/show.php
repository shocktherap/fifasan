<?=anchor('subpekerjaan/create/'.$pekerjaan_id, 'Create New Subpekerjaan', 'class="btn btn-primary"');?>
<?php if ($sub) { ?>
  <table class="table table-stripped">
  <thead>
    <th>Nama Subpekerjaan</th>
    <th>Keterangan</th>
    <th>Satuan</th>
  </thead>
  <?php foreach ($sub as $key) { ?>
    <tr>
      <td><?=$key->nama;?></td>
      <td><?=$key->keterangan_peraturan;?></td>
      <td><?=$key->satuan;?></td>
      <td><i class="icon-edit"></i><?=anchor('subpekerjaan/edit/'.$key->id.'/'.$key->pekerjaan_id, 'Edit');?></td>
      <td><a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a></td>
    </tr>
    <?php 
    $data['pekerjaan_id'] = $key->pekerjaan_id;
    $data['key'] = $key;
      $this->load->view('subpekerjaan/modal_delete_subpekerjaan', $data);
    ?>
    </tr>
  <?php } ?>
</table>  
<?php } else { ?>
  <h3>Data subpekerjaan tidak ada</h3>
<?php } ?>
