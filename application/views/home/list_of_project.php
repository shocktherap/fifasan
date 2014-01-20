<?=anchor('home/create_project', "Buat Project Baru", 'class="btn btn-primary"');?>

<?php
if (!$list_project) { 
?>
  <h3>Data Project Belum Ada</h3>
<?php 
} else {?>  
  <table class="table table-stripped">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Status</th>
      <th>Keterangan</th>
      <th>Actions</th>
    </tr>
    <?php 
      $number = 0;
      foreach ($list_project as $list) { 
    ?>
    <tr>
      <td><?=$number+=1;?></td>
      <td><?=anchor('subproject/show/'.$list->project_id,$list->nama , 'attributs');?></td>
      <td><?php $status = $this->get_data->get_nama_status($list->status_id);
      echo $status->name;
      ?></td>
      <td><span class="label label-success">Approved</span></td>
      <td><?=anchor('home/show_project/'.$list->project_id, '<i class="icon-eye-open"></i> Detail');?> || <?=anchor('home/edit_project/'.$list->project_id, '<i class="icon-edit"></i> Edit');?> || <a data-toggle="modal" href="#myModal<?=$list->project_id;?>"><i class="icon-trash"></i>Delete</a></td>
    </tr>  
    <?php $data['list'] = $list;
    $this->load->view('home/modal_delete_project', $data);?>
    <?php }?>
  </table>

<?php
}
?>
