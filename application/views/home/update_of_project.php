<?php 
  $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'update');
  echo form_open('home/edit_project/'.$data_project->project_id, $attributes);
?>
<?php
  if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
  }
?>
<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "error";
  }
?>
<?php
  if(!form_error('jenis')){
    $message2 = "";
  } else {
    $message2 = "error";
  }
?>
<?php
  if(!form_error('lokasi')){
    $message3 = "";
  } else {
    $message3 = "error";
  }
?>
<?php
  if(!form_error('owner')){
    $message4 = "";
  } else {
    $message4 = "error";
  }
?>
<?php
  if(!form_error('tahun')){
    $message5 = "";
  } else {
    $message5 = "error";
  }
?>
  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
      <input type="text" id="inputname" name="nama" value="<?php echo $data_project->nama;?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
    </div>
  </div>
  <div class="control-group <?=$message2;?>">
    <label class="control-label" for="inputJenis">jenis</label>
    <div class="controls">
      <input type="text" id="inputjenis" name="jenis" value="<?php echo $data_project->jenis;?>" placeholder="jenis"></input>
      <span class="help-inline"><?php echo form_error('jenis');?></span>
    </div>
  </div>
  <div class="control-group <?=$message3;?>">
    <label class="control-label" for="inputLokasi">lokasi</label>
    <div class="controls">
      <input type="text" id="inputlokasi" name="lokasi" value="<?php echo $data_project->lokasi;?>" placeholder="lokasi"></input>
      <span class="help-inline"><?php echo form_error('lokasi');?></span>
    </div>
  </div>
  <div class="control-group <?=$message4;?>">
    <label class="control-label" for="inputOwner">owner</label>
    <div class="controls">
      <input type="text" id="inputowner" name="owner" value="<?php echo $data_project->pemilik;?>" placeholder="owner"></input>
      <span class="help-inline"><?php echo form_error('owner');?></span>
    </div>
  </div>
  <div class="control-group <?=$message5;?>">
    <label class="control-label" for="inputTahun">tahun</label>
    <div class="controls">
      <input type="text" id="inputtahun" name="tahun" value="<?php echo $data_project->tahun;?>" placeholder="tahun"></input>
      <span class="help-inline"><?php echo form_error('tahun');?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputTahun">Status</label>
    <div class="controls">
      <select name="status">
        <?php 
        foreach ($status as $key) { ?>
        <option value="<?=$key->id;?>"><?=$key->name;?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">Update</button>
      <?=anchor('home/index', 'Cancel', 'class="btn"');?>
    </div>
  </div>
<?php form_close();?>