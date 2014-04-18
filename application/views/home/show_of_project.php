<?php 
  error_reporting(1);
  echo $map['js']; 
?>    
<?php $session_data = $this->session->userdata('login');?>
<?php echo $map['html']; ?>
  <?php $status = $this->get_data->get_nama_status($data_project->status_id);?>
<label>Progres</label>
<div class="progress progress-striped active">
      <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_project->status_id*20;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$data_project->status_id*20;?>%"></div>
      <?=$data_project->status_id*20;?>% <?=$status->name?>
</div>
<table class="table table-striped">
  <thead>
    <th>Status</th>
    <th>Tanggal</th>
  </thead>
  <tbody>
    <?php $row = $this->get_data->status_row();
    for ($i=1; $i <= $row; $i++) { 
      $miles = $this->get_data->get_milestone($data_project->project_id, $i);
      $status2 = $this->get_data->get_nama_status($miles->status_id);
    ?>
    <tr>
      <td><?=$status2->name;?></td>
      <td><?=$miles->tanggal;?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <?php if($data_project->aggreement == 0 && $session_data['level'] == 'manager'){ ?>
    <?=anchor('home/agreement/'.$id_project, 'Setujui', 'class="btn btn-success"');?>
  <?php } ?>
<table class="table table-hover">
<tr>
  <td>Nama Project</td>
  <td><?=$data_project->nama;?></td>
</tr>
<tr>
  <td>Jenis Project</td>
  <td><?=$data_project->jenis;?></td>
</tr>
<tr>
  <td>Lokasi Project</td>
  <td><?=$data_project->lokasi;?></td>
</tr>
<tr>
  <td>Alamat Project</td>
  <td><?=$data_project->alamat;?></td>
</tr>
<tr>
  <td>Owner Project</td>
  <td><?=$data_project->pemilik;?></td>
</tr>
<tr>
  <td>Tahun Anggaran Project</td>
  <td><?=$data_project->tahun;?></td>
</tr>
<tr>
  <td>Status Project</td>
  <td>   
      <?=$status->name;?>
  </td>
</tr>
<tr>
  <td>Pekerja Project</td>
  <td>   
      <?php $pengguna = $this->user->getleaderby('id', $data_project->employe_id);?>
      <?=$pengguna->name;?>
  </td>
</tr>
<tr>
  <td>Keterangan</td>
  <?php if($data_project->aggreement == 0){?>
    <td><span class="label label-waning">Not-approved</span></td>
  <?php } else {?>
    <td><span class="label label-success">Approved</span></td>
  <?php } ?>
</tr>
</table>

<?=anchor('upload/form_new/'.$id_project, '<span class="glyphicon glyphicon-upload"></span> Upload File', 'class="btn btn-default"');?>
<?php
  if ($storage) { ?>
    <table class="table table-bordered">
      <thead>
      <tr>
        <td>Name</td>
        <td>File</td>
        <td>Description</td>
        <td>Date</td>
      </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($storage as $key) { ?>
        <tr>
          <?php $pengguna = $this->user->getleaderby('id', $key->user_id);?>
          <td><?=$pengguna->name;?></td>
          <td><?=$key->tipe;?></td>
          <td><?=$key->description;?></td>
          <td><?=substr($key->date, 0, 19);?></td>
          <td>
            <?=anchor("home/download/$key->id", '<span class="glyphicon glyphicon-download"></span>', 'class="btn"');?>
            <?=anchor('home/delete_file/'.$key->id.'/'.$id_project, '<span class="glyphicon glyphicon-trash"></span>', 'attributs');?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table> 
  <?php } ?>
<?php if ($session_data['username'] != 'manager') { ?>
<?php } ?>
<?=form_open('home/createcomment/'.$id_project.'/'.$session_data['id']);?>
<?=form_input('comment', '');?>
<?=form_submit('mysubmit', 'Submit Comment!');?>
<?php form_close();?>
<?php $comments = $this->get_data->get_comment_using('project_id', $id_project);
?>
<div class="panel panel-default">
  <div class="panel-heading"><span class="glyphicon glyphicon-comment"></span> Comment</div>
  <div class="panel-body">
      <div class="list-group">
      <?php foreach ($comments as $key) { ?>
        <?php $user = $this->get_data->get_detail_user($key->user_id);?>
        <a href="#" class="list-group-item">
          <blockquote>
            <p><?=$key->comment;?></p>
            <small><?=$user->name;?> <cite title="Source Title"><?=$key->time;?></cite></small>
          </blockquote>
        </a>      
      <?php }?>
      </div>  
  </div>
</div>

