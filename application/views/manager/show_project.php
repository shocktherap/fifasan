<?php
if (!$list_project) { 
?>
  <h3>Data Project Belum Ada</h3>
<?php 
} else { ?>  
  <table class="table table-stripped">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Status</th>
      <th>Keterangan</th>
      <th>Actions</th>
    </tr>
    <?php $number=0; ?>
    <?php foreach ($list_project as $key) { ?>
    <tr>
      <td><?=$number+=1;?></td>
      <?php if ($key->status_id > 1) { ?>
        <td><?=anchor('subproject/show/'.$key->project_id, $key->nama);?></td>
      <?php } else { ?>
        <td><?php print_r($key->nama);?></td>
      <?php } ?>
      <td><?php $status = $this->get_data->get_nama_status($key->status_id); echo $status->name;?></td>
      <?php if($key->aggreement == 0){?>
        <td><span class="label label-waning">Not-approved</span></td>
      <?php } else {?>
        <td><span class="label label-success">Approved</span></td>
      <?php } ?>
      <td><?=anchor('home/show_project/'.$key->project_id, "<span class='glyphicon glyphicon-eye-open'></span> ");?></td>
      
    </tr>  
    <?php } ?>
  </table>
<?php
}
?>