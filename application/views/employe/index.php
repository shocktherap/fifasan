<?php
  $session_data = $this->session->userdata('login');
?>
<?php if ($session_data['level'] == 'branch') { ?>
<?=anchor('employe/createemploye', "<span class='glyphicon glyphicon-new-window'></span> Buat Pegawai", "class='btn btn-default'");?>
<?php } ?>
<div class='panel panel-default'>
  <div class="panel-heading"></div>
  <div class='panel-body'>
  <table class="table table-hover">
  <thead>
    <th>No</th>
    <th>Nama</th>
    <th>Nomer Telepon</th>
    <th>Username</th>
    <th>Actions</th>
  </thead>
  <tbody>
    <?php $number = 0;?>
    <?php foreach ($employe as $key) { ?>
    <tr>
      <td><?=$number+=1;?></td>
      <td><?=anchor('employe/show_project/'.$key->id, $key->name);?></td>
      <td><?=$key->phone_number;?></td>
      <td><?=$key->username;?></td>
      <td><a data-toggle="modal" href="#myModal<?=$key->id;?>"><button type="button" class="btn btn-danger btn-sm" title="Delete">
          <span class='glyphicon glyphicon-trash'></span>
        </button></a>
      <?php 
        $data['id'] = $key->id;
        $data['name'] = $key->name;
        $this->load->view('employe/modal_delete_employe', $data, FALSE);?>
      <?=anchor('employe/edit/'.$key->id, "<button type='button' class='btn btn-info btn-sm' title='Edit'>
          <span class='glyphicon glyphicon-edit'></span>
        </button>");?>
      <?=anchor('employe/resetpassword/'.$key->id, "<button type='button' class='btn btn-default btn-sm' title='Reset Password'>
          <span class='glyphicon glyphicon-time'></span>
        </button>");?></td>
    </tr>  

    <?php }?>
  </tbody>
  </table>
</div>
</div>