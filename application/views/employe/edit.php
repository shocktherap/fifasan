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
<div class='row'>
  <div class='col-md-4'></div>
  <div class='col-md-4'>
<?=form_open('employe/update/'.$employe->id, array('role' => 'form', 'class' => 'go-right'));?>
  <div class="form-group <?=$message1;?>">
    <input class='form-control' type="text" id="inputname" name="name" value="<?=$employe->name;?>" required></input>
    <label>Nama Pegawai</label>
      <span class="help-inline"><?php echo form_error('name');?></span>
  </div>
  <div class="form-group <?=$message3;?>">
    <input class='form-control' type="text" id="inputname" name="phone_number" value="<?=$employe->phone_number;?>" required></input>
    <label>No Telepon</label>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
  </div>
  <div class="form-group <?=$message5;?>">
    <input class='form-control' type="text" id="inputname" name="username" value="<?=$employe->username;?>" required></input>
    <label>Username Pegawai</label>
      <span class="help-inline"><?php echo form_error('username');?></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>
  </div>
<div class='col-md-4'></div>
</div>