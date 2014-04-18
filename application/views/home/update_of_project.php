<?php 
  echo $map['js']; 
?>    
<?php
  if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
  }
?>
<?php
  if(!form_error('alamat')){
    $message6 = "";
  } else {
    $message6 = "has-error";
  }
?>
<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "has-error";
  }
?>
<?php
  if(!form_error('jenis')){
    $message2 = "";
  } else {
    $message2 = "has-error";
  }
?>
<?php
  if(!form_error('lokasi')){
    $message3 = "";
  } else {
    $message3 = "has-error";
  }
?>
<?php
  if(!form_error('owner')){
    $message4 = "";
  } else {
    $message4 = "has-error";
  }
?>
<?php
  if(!form_error('tahun')){
    $message5 = "";
  } else {
    $message5 = "has-error";
  }
?>
<div class='row'>
  <div class='col-md-4'></div>
  <div class='col-md-4'>
    <?php 
      $attributes = array('id' => 'myform', 'name' => 'update', 'role' => 'form');
      echo form_open('home/edit_project/'.$data_project->project_id, $attributes);
    ?>
      <div class="form-group <?=$message;?>">
        <label for="inputName">Name</label>
          <input class='form-control' type="text" id="inputname" name="nama" value="<?php echo $data_project->nama;?>" placeholder="nama"></input>
          <span class="help-inline"><?php echo form_error('nama');?></span>
      </div>
      <div class="form-group <?=$message2;?>">
        <label for="inputJenis">jenis</label>
          <input class='form-control' type="text" id="inputjenis" name="jenis" value="<?php echo $data_project->jenis;?>" placeholder="jenis"></input>
          <span class="help-inline"><?php echo form_error('jenis');?></span>
      </div>
      <div class="form-group <?=$message3;?>">
        <label for="inputLokasi">lokasi</label>
          <?php echo $map['html']; ?>
          <input class='form-control' type="text" id="inputlokasi" name="lokasi" value="<?php echo $data_project->lokasi;?>" placeholder="lokasi"></input>
          <span class="help-inline"><?php echo form_error('lokasi');?></span>
      </div>
      <div class="form-group <?=$message6;?>">
        <label for="inputLokasi">Alamat</label>
          <input class='form-control' type="text" id="inputalamat" name="alamat" value="<?php echo $data_project->alamat;?>" placeholder="alamat"></input>
          <span class="help-inline"><?php echo form_error('alamat');?></span>
      </div>
      <div class="form-group <?=$message4;?>">
        <label for="inputOwner">owner</label>
          <input class='form-control' type="text" id="inputowner" name="owner" value="<?php echo $data_project->pemilik;?>" placeholder="owner"></input>
          <span class="help-inline"><?php echo form_error('owner');?></span>
      </div>
      <div class="form-group <?=$message5;?>">
        <label for="inputTahun">tahun</label>
          <input class='form-control' type="text" id="inputtahun" name="tahun" value="<?php echo $data_project->tahun;?>" placeholder="tahun"></input>
          <span class="help-inline"><?php echo form_error('tahun');?></span>
      </div>
      <div class="form-group">
          <select name="status" class='form-control'>
            <?php 
            foreach ($status as $key) { ?>
            <option value="<?=$key->id;?>"><?=$key->name;?></option>
            <?php
            }
            ?>
          </select>
        </div>
      <button type="submit" class="btn btn-primary">Update</button>
      </div>
    <?php form_close();?>
  </div>
  <div class='col-md-4'></div>
</div>
