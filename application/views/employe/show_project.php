<table class="table table-bordered">
  <thead>
    <th>Nama Project</th>
    <th>Status</th>
    <th>Alamat</th>
  </thead>
  <tbody>
    <?php 
      $session_data = $this->session->userdata('login');
      foreach ($project as $key) { 
      $status = $this->get_data->get_nama_status($key->status_id);
      ?>
    <tr>
      <?php if ($session_data['level'] == 'branch') { ?>
        <td><?=anchor('subproject/show/'.$key->project_id, $key->nama , 'attributs');?></td>  
      <?php } elseif ($session_data['level'] == 'employe' || $session_data['level'] == 'estimator' && $key->status_id > 2) { ?>
        <td><?=anchor('subproject/show/'.$key->project_id, $key->nama , 'attributs');?></td>  
      <?php } elseif ($session_data['level'] == 'employe' || $session_data['level'] == 'estimator' && $key->status_id <= 2) { ?>
      <td><?=$key->nama;?></td>  
      <?php } ?>
      <td><?=$status->name;?></td>
      <td><?=$key->alamat;?></td>
    </tr>
    <?php }?>
  </tbody>
</table>