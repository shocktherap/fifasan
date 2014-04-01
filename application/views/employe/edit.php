<?php
  if(!form_error('name')){
    $message1 = "";
  } else {
    $message1 = "error";
  }
  if(!form_error('phone_number')){
    $message3 = "";
  } else {
    $message3 = "error";
  }
  if(!form_error('username')){
    $message5 = "";
  } else {
    $message5 = "error";
  }
?>
<?=form_open('employe/update/'.$employe->id);?>
  <div class="control-group <?=$message1;?>">
    <label class="control-label" for="inputName">Nama Pegawai</label>
    <div class="controls">
      <input type="text" id="inputname" name="name" value="<?=$employe->name;?>" placeholder="Nama Pegawai"></input>
      <span class="help-inline"><?php echo form_error('name');?></span>
    </div>
  </div>
  <div class="control-group <?=$message3;?>">
    <label class="control-label" for="inputName">No Telepon</label>
    <div class="controls">
      <input type="text" id="inputname" name="phone_number" value="<?=$employe->phone_number;?>" placeholder="Nomer Telepon"></input>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
    </div>
  </div>
  <div class="control-group <?=$message5;?>">
    <label class="control-label" for="inputName">Username Pegawai</label>
    <div class="controls">
      <input type="text" id="inputname" name="username" value="<?=$employe->username;?>" placeholder="Username"></input>
      <span class="help-inline"><?php echo form_error('username');?></span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>