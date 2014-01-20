<?php 
  echo $map['js']; 
?>    
<?php 
  $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'entry');
  echo form_open('home/create_project', $attributes);
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
<?php
  if(!form_error('alamat')){
    $message6 = "";
  } else {
    $message6 = "error";
  }
?>

  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
      <input type="text" id="inputname" name="nama" value="<?php echo set_value('nama');?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
    </div>
  </div>
  <div class="control-group <?=$message2;?>">
    <label class="control-label" for="inputJenis">jenis</label>
    <div class="controls">
      <input type="text" id="inputjenis" name="jenis" value="<?php echo set_value('jenis');?>" placeholder="jenis"></input>
      <span class="help-inline"><?php echo form_error('jenis');?></span>
    </div>
  </div>
  <div class="control-group <?=$message3;?>">
    <label class="control-label" for="inputLokasi">lokasi</label>
    <div class="controls">
      <?php echo $map['html']; ?>
      <input type="text" id="inputlokasi" name="lokasi" value="<?php echo set_value('lokasi');?>" placeholder="lokasi"></input>
      <span class="help-inline"><?php echo form_error('lokasi');?></span>
    </div>
  </div>
  <div class="control-group <?=$message6;?>">
    <label class="control-label" for="inputLokasi">Alamat</label>
    <div class="controls">
      <input type="text" id="inputalamat" name="alamat" value="<?php echo set_value('alamat');?>" placeholder="alamat"></input>
      <span class="help-inline"><?php echo form_error('alamat');?></span>
    </div>
  </div>
  <div class="control-group <?=$message4;?>">
    <label class="control-label" for="inputOwner">owner</label>
    <div class="controls">
      <input type="text" id="inputowner" name="owner" value="<?php echo set_value('owner');?>" placeholder="owner"></input>
      <span class="help-inline"><?php echo form_error('owner');?></span>
    </div>
  </div>
  <div class="control-group <?=$message5;?>">
    <label class="control-label" for="inputTahun">tahun</label>
    <div class="controls">
      <input type="text" id="inputtahun" name="tahun" value="<?php echo set_value('tahun');?>" placeholder="tahun"></input>
      <span class="help-inline"><?php echo form_error('tahun');?></span>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit</button>
      <?=anchor('home/index', 'Cancel', 'class="btn"');?>
    </div>
  </div>
<?php form_close();?>