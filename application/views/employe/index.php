<?php
  $session_data = $this->session->userdata('login');
?>
<?php if ($session_data['level'] == 'branch') { ?>
<?=anchor('employe/createemploye', 'Create Employe', 'class="btn"');?>
<?php } ?>
<table class="table table-bordered">
<thead>
  <th>No</th>
  <th>Nama</th>
  <th>Nomer Telepon</th>
  <th>Username</th>
</thead>
<tbody>
  <?php $number = 0;?>
  <?php foreach ($employe as $key) { ?>
  <tr>
    <td><?=$number+=1;?></td>
    <td><?=anchor('employe/show_project/'.$key->id, $key->name);?></td>
    <td><?=$key->phone_number;?></td>
    <td><?=$key->username;?></td>
    <td><a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a></td>
    <?php 
      $data['id'] = $key->id;
      $data['name'] = $key->name;
      $this->load->view('employe/modal_delete_employe', $data, FALSE);?>
    <td><?=anchor('employe/resetpassword/'.$key->id, 'Reset Password');?></td>
  </tr>  

  <?php }?>
</tbody>
</table>