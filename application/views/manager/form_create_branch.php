<?php
  if(!form_error('name')){
    $message1 = "";
  } else {
    $message1 = "has-error";
  }
  if(!form_error('address')){
    $message2 = "";
  } else {
    $message2 = "has-error";
  }
  if(!form_error('phone_number')){
    $message3 = "";
  } else {
    $message3 = "has-error";
  }
  if(!form_error('leader')){
    $message4 = "";
  } else {
    $message4 = "has-error";
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
<?=form_open('manager/createbranch', array('role' => 'form', 'class' => 'go-right'));?>
  <div class="form-group <?=$message1;?>">
    <label>Nama Cabang</label>
    <input class='form-control' type="text" id="inputname" name="name" value="<?php echo set_value('name');?>" required></input>
      <span class="help-inline"><?php echo form_error('name');?></span>  
  </div>
  <div class="form-group <?=$message2;?>">
    <label>Alamat Cabang</label>
    <input class='form-control' type="text" id="inputname" name="address" value="<?php echo set_value('address');?>" required></input>
      <span class="help-inline"><?php echo form_error('address');?></span>
  </div>
  <div class="form-group <?=$message3;?>">
    <label>No Telepon</label>
    <input class='form-control' type="text" id="inputname" name="phone_number" value="<?php echo set_value('phone_number');?>" required></input>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
  </div>
  <div class="form-group <?=$message4;?>">
    <label>Nama Pimpinan Cabang</label>
    <input class='form-control' type="text" id="inputname" name="leader" value="<?php echo set_value('leader');?>" required></input>
      <span class="help-inline"><?php echo form_error('leader');?></span>
  </div>
  <div class="form-group <?=$message5;?>">
    <label>Username Pimpinan Cabang</label>
    <input class='form-control' type="text" id="inputname" name="username" value="<?php echo set_value('username');?>" required></input>
      <span class="help-inline"><?php echo form_error('username');?></span>
  </div>
  <div class="form-group <?=$message6;?>">
    <label>Password Pimpinan Cabang</label>
    <input class='form-control' type="password" id="inputname" name="password" required></input>
      <span class="help-inline"><?php echo form_error('password');?></span>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
<?php form_close(); ?>
  </div>
<div class='col-md-4'></div>
</div>