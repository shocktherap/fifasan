<?php 
  echo $map['js']; 
?>    
<?php $session_data = $this->session->userdata('login');?>
<?php echo $map['html']; ?>

  <?php $status = $this->get_data->get_nama_status($data_project->status_id);?>

<label>Progres</label>
<div class="progress progress-striped active">
  <div class="bar" style="width: <?=$data_project->status_id*20;?>%;"><?=$data_project->status_id*20;?>% | <?=$status->name?></div>
</div>
<?php if ($session_data['username'] != 'manager') { ?>
  <?=anchor('upload/form_new/'.$id_project, 'Upload File', 'class="btn btn-primary"');?>
<?php } ?>
<table class="table table-condensed">
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
</table>

<?php $session_data = $this->session->userdata('login');?>
<?php
  if ($storage) { ?>
    <table class="table table-bordered">
      <thead>
      <tr>
        <td>File</td>
        <td>Description</td>
        <td>Date</td>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($storage as $key) { ?>
        <tr>
          <td><?=$key->tipe;?></td>
          <td><?=$key->description;?></td>
          <td><?=substr($key->date, 0, 19);?></td>
          
          <td><?=anchor('home/download/'.$key->id, 'Download', 'class="btn"');?></td>
          <td><?=anchor('home/delete_file/'.$key->id.'/'.$id_project, 'Delete', 'attributs');?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table> 
  <? } else {
    echo "Tidak ada file";
  }
?>
<?php if ($session_data['username'] != 'manager') { ?>
<?=anchor('home/index', 'Back', 'class="btn btn-primary"');?>
<?php }?>