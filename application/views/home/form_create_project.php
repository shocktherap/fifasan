<?php 
  echo $map['js']; 
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
<div class='row'>
  <div class='col-md-4'></div>
  <div class='col-md-4'>
<?php 
  $attributes = array('id' => 'myform', 'name' => 'entry', 'role' => 'form');
  echo form_open('home/create_project', $attributes);
?>
  <div class="form-group <?=$message;?>">
    <label class="control-label" for="inputName">Name</label>
      <input class='form-control' type="text" id="inputname" name="nama" value="<?php echo set_value('nama');?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
  </div>
  <div class="form-group <?=$message2;?>">
    <label class="control-label" for="inputJenis">jenis</label>
      <input class='form-control' type="text" id="inputjenis" name="jenis" value="<?php echo set_value('jenis');?>" placeholder="jenis"></input>
      <span class="help-inline"><?php echo form_error('jenis');?></span>
  </div>
  <div class="form-group <?=$message3;?>">
    <label class="control-label" for="inputLokasi">lokasi</label>
      <?php echo $map['html']; ?>
      <input class='form-control' type="text" id="inputlokasi" name="lokasi" value="<?php echo set_value('lokasi');?>" placeholder="lokasi"></input>
      <span class="help-inline"><?php echo form_error('lokasi');?></span>
  </div>
  <div class="form-group <?=$message6;?>">
    <label class="control-label" for="inputLokasi">Alamat</label>
      <input class='form-control' type="text" id="inputalamat" name="alamat" value="<?php echo set_value('alamat');?>" placeholder="alamat"></input>
      <span class="help-inline"><?php echo form_error('alamat');?></span>
  </div>
  <div class="form-group <?=$message4;?>">
    <label class="control-label" for="inputOwner">owner</label>
      <input class='form-control' type="text" id="inputowner" name="owner" value="<?php echo set_value('owner');?>" placeholder="owner"></input>
      <span class="help-inline"><?php echo form_error('owner');?></span>
  </div>
  <div class="form-group <?=$message5;?>">
    <label class="control-label" for="inputTahun">tahun</label>
      <input class='form-control' type="text" id="inputtahun" name="tahun" value="<?php echo set_value('tahun');?>" placeholder="tahun"></input>
      <span class="help-inline"><?php echo form_error('tahun');?></span>
  </div>
  <div class="form-group ">
    <label class="control-label" for="inputTahun">Pimpinan Project</label>
      <select name="employe" id="employe" class='form-control'>
        <?php $session_data = $this->session->userdata('login');
        $user = $this->user->check_project('branch_id', $session_data['branch_id']);
        foreach ($user as $key) { ?>
          <option value="<?=$key->id;?>"><?=$key->name;?></option>  
        <?php }
        ?>
      </select>
      <span class="help-inline"><?php echo form_error('tahun');?></span>
    </div>
  <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
      <?=anchor('home/index', 'Cancel', 'class="btn"');?>
    </div>
<?php form_close();?>
</div>
<div class='col-md-4'></div>
</div>