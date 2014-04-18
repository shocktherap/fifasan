<?php $session_data = $this->session->userdata('login');
if ($session_data['level'] == 'branch') { ?>
<?=anchor('home/create_project', "<span class='glyphicon glyphicon-new-window'></span> Buat Project", 'class="btn btn-default"');?>  
<?php }?>
<?php
if (!$list_project) { 
?>
  <h3>Data Project Belum Ada</h3>
<?php 
} else {?>  
<div class='panel panel-default'>
  <div class="panel-heading"></div>
  <div class='panel-body'>
  <table class="table table-hover">
    <thead>
      <th>No</th>
      <th>Nama</th>
      <th>Status</th>
      <th>Keterangan</th>
      <th>Actions</th>
    </thead>
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
        <td><span class="label label-warning"><span class="glyphicon glyphicon-remove-circle"></span> Belum Disetujui</span></td>
      <?php } else {?>
        <td><span class="label label-success"><span class="glyphicon glyphicon-ok-circle"></span> Disetujui</span></td>
      <?php } ?>
        <td><?php if ($session_data['level'] == 'branch') { ?>
          <a data-toggle="modal" href="#myModal<?=$list->project_id;?>"><button type="button" class="btn btn-danger btn-sm" title="Delete">
          <span class='glyphicon glyphicon-trash'></span>
        </button></a>
          <?=anchor('home/edit_project/'.$list->project_id, "<button type='button' class='btn btn-info btn-sm' title='Edit'>
          <span class='glyphicon glyphicon-edit'></span>
        </button>");?><?php }?>
          <?=anchor('home/show_project/'.$list->project_id, "<button type='button' class='btn btn-default btn-sm' title='Detail'>
          <span class='glyphicon glyphicon-eye-open'></span>
        </button>");?>
        </td> 
    </tr>  
    <?php $data['list'] = $list;
    $this->load->view('home/modal_delete_project', $data);?>
    <?php }?>
  </table>
  </div>
</div>
<?php
}
?>
