<?php
  if(!form_error('name')){
    $message1 = "";
  } else {
    $message1 = "has-error";
  }
  if(!form_error('phone_number')){
    $message3 = "";
  } else {
    $message3 = "has-error";
  }
  if(!form_error('username')){
    $message5 = "";
  } else {
    $message5 = "has-error";
  }
  if(!form_error('password')){
    $message6 = "";
  } else {
    $message6 = "has-error";
  }
?>
<div class='row'>
  <div class='col-md-4'></div>
  <div class='col-md-4'>
<?=form_open('employe/createemploye', array('role' => 'form' ));?>
  <div class="form-group <?=$message1;?>">
    <label for="inputName">Nama Pegawai</label>
      <input class='form-control' type="text" id="inputname" name="name" value="<?php echo set_value('name');?>" placeholder="Nama Pegawai"></input>
      <span class="help-inline"><?php echo form_error('name');?></span>
  </div>
  <div class="form-group <?=$message3;?>">
    <label for="inputName">No Telepon</label>
      <input class='form-control' type="text" id="inputname" name="phone_number" value="<?php echo set_value('phone_number');?>" placeholder="Nomer Telepon"></input>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
  </div>
  <div class="form-group <?=$message5;?>">
    <label for="inputName">Username Pegawai</label>
      <input class='form-control' type="text" id="inputname" name="username" value="<?php echo set_value('username');?>" placeholder="Username"></input>
      <span class="help-inline"><?php echo form_error('username');?></span>
  </div>
  <div class="form-group <?=$message6;?>">
    <label for="inputName">Password Pegawai</label>
      <input class='form-control' type="password" id="inputname" name="password" value="<?php echo set_value('password');?>" placeholder="Password"></input>
      <span class="help-inline"><?php echo form_error('password');?></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>
<div class='col-md-4'></div>
</div>
</div>