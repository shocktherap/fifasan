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
<?php $user = $this->user->getleaderby('id', $branch->leader_id);?>
<?=form_open('manager/edit_branch/'.$branch->id, array('role' => 'form', 'class' => 'go-right'));?>
  <div class="form-group <?=$message1;?>">
    <input class='form-control' type="text" id="inputname" name="name" value="<?=$branch->name;?>" required></input>
    <label>Nama Cabang</label>
      <span class="help-inline"><?php echo form_error('name');?></span>  
  </div>
  <div class="form-group <?=$message2;?>">
    <input class='form-control' type="text" id="inputname" name="address" value="<?=$branch->address;?>" required></input>
    <label>Alamat Cabang</label>
      <span class="help-inline"><?php echo form_error('address');?></span>
  </div>
  <div class="form-group <?=$message3;?>">
    <input class='form-control' type="text" id="inputname" name="phone_number" value="<?=$branch->phone_number;?>" required></input>
    <label>No Telepon</label>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
  </div>
  <div class="form-group <?=$message4;?>">
    <input class='form-control' type="text" id="inputname" name="leader" value="<?=$user->name;?>" required></input>
    <label>Nama Pimpinan Cabang</label>
      <span class="help-inline"><?php echo form_error('leader');?></span>
  </div>
  <div class="form-group <?=$message5;?>">
    <input class='form-control' type="text" id="inputname" name="username" value="<?=$user->username;?>" required></input>
    <label>Username Pimpinan Cabang</label>
      <span class="help-inline"><?php echo form_error('username');?></span>
  </div>
  <div class="form-group <?=$message6;?>">
    <input class='form-control' type="password" id="inputname" name="password" value="<?=$user->password;?>" required></input>
    <label>Password Pimpinan Cabang</label>
      <span class="help-inline"><?php echo form_error('password');?></span>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
<?php form_close(); ?>
  </div>
  <div class='col-md-4'></div>
</div>