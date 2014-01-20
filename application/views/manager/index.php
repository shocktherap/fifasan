<?=anchor('manager/createbranch', 'Create Branch', 'class ="btn"');?>
<table class="table table-bordered">
<thead>
  <th>#</th>
  <th>Nama Cabang</th>
  <th>Alamat</th>
  <th>Nomer Telepon</th>
  <th>Leader</th>
  <th>Username</th>
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
    <td><?=anchor('manager/edit_branch/'.$key->id, 'Edit');?></td>
    <td><a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a></td>
    <?php 
      $data['id'] = $key->id;
      $data['name'] = $key->name;
      $this->load->view('manager/modal_delete_branch', $data, FALSE);?>
  </tr>
  <?php } ?>
</tbody>
</table>