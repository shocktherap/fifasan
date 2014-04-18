<?php $userdata = $this->session->userdata('login');
if ($userdata['level'] == 'manager') {?>
<?=anchor('manager/createbranch', 'Create Branch', 'class ="btn btn-primary"');?>
<?php  
}
?>
</br>
<div class='panel panel-default'>
  <div class="panel-heading"></div>
  <div class='panel-body'>
    <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nama Cabang</th>
      <th>Alamat</th>
      <th>Nomer Telepon Cabang</th>
      <th>Leader</th>
      <th>Username</th>
      <th>Actions</th>
    </thead>
    <tbody>
      <?php $number = 0; ?>
      <?php foreach ($branch as $key) { ?>
      <tr>
        <?php $user = $this->user->getleaderby('id', $key->leader_id);?>
        <td><?=$number+=1;?></td>
        <td><?=anchor('manager/show_project/'.$key->id, $key->name);?></td>
        <td><?=$key->address;?></td>
        <td><?=$key->phone_number;?></td>
        <td><?=$user->name;?></td>
        <td><?=$user->username;?></td>
        <td>
          <?=anchor('manager/edit_branch/'.$key->id, "<button type='button' class='btn btn-info btn-sm' title='Edit'>
          <span class='glyphicon glyphicon-edit'></span>
        </button>");?>
        <a data-toggle="modal" href="#myModal<?=$key->id;?>"><button type="button" class="btn btn-danger btn-sm" title="Delete">
          <span class='glyphicon glyphicon-trash'></span>
        </button></a></td>
          <?php 
            $data['id'] = $key->id;
            $data['name'] = $key->name;
            $this->load->view('manager/modal_delete_branch', $data, FALSE);
          ?>
      </tr>
      <?php } ?>
    </tbody>
    </table>
  </div>
</div>