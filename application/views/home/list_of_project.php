<?php $session_data = $this->session->userdata('login');
if ($session_data['level'] == 'branch') { ?>
<?=anchor('home/create_project', "Buat Project Baru", 'class="btn btn-primary"');?>  
<?php }?>
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
      $session_data = $this->session->userdata('login');
      $number = 0;
      foreach ($list_project as $list) { 
    ?>
    <tr>
      <td><?=$number+=1;?></td>
      <?php if ($session_data['level'] == 'branch') { ?>
        <td><?=anchor('subproject/show/'.$list->project_id, $list->nama , 'attributs');?></td>
      <?php } elseif ($session_data['level'] == 'manager') { ?>
        <td><?=anchor('subproject/show/'.$list->project_id, $list->nama , 'attributs');?></td>  
      <?php } elseif ($session_data['level'] == 'employe' && $list->status_id > 2) { ?>
        <td><?=anchor('subproject/show/'.$list->project_id, $list->nama , 'attributs');?></td>  
      <?php } elseif ($session_data['level'] == 'employe' && $list->status_id <= 2) { ?>
      <td><?=$list->nama;?></td>  
      <?php } ?>
      <?php $milestone = $this->get_data->last_milestone($list->project_id);?>
      <td><?php $status = $this->get_data->get_nama_status($milestone->status_id);
      echo $status->name;
      ?></td>
      <?php 
      if($list->aggreement == 0){?>
        <td><span class="label label-waning">Not-approved</span></td>
      <?php } else {?>
        <td><span class="label label-success">Approved</span></td>
      <?php } ?>
        <td><?php if ($session_data['level'] == 'branch') { ?><a data-toggle="modal" href="#myModal<?=$list->project_id;?>"><i class="icon-trash"></i>Delete</a>||<?=anchor('home/edit_project/'.$list->project_id, '<i class="icon-edit"></i> Edit');?>||<?php }?><?=anchor('home/show_project/'.$list->project_id, '<i class="icon-eye-open"></i> Detail');?></td> 
    </tr>  
    <?php $data['list'] = $list;
    $this->load->view('home/modal_delete_project', $data);?>
    <?php }?>
  </table>

<?php
}
?>
