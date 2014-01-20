<?php
  if(!form_error('name')){
    $message1 = "";
  } else {
    $message1 = "error";
  }
  if(!form_error('address')){
    $message2 = "";
  } else {
    $message2 = "error";
  }
  if(!form_error('phone_number')){
    $message3 = "";
  } else {
    $message3 = "error";
  }
  if(!form_error('leader')){
    $message4 = "";
  } else {
    $message4 = "error";
  }
  if(!form_error('username')){
    $message5 = "";
  } else {
    $message5 = "error";
  }
  if(!form_error('password')){
    $message6 = "";
  } else {
    $message6 = "error";
  }
?>
<?php $user = $this->user->getleaderby('id', $branch->leader_id);?>
<?=form_open('manager/edit_branch/'.$branch->id);?>
  <div class="control-group <?=$message1;?>">
    <label class="control-label" for="inputName">Nama Cabang</label>
    <div class="controls">
      <input type="text" id="inputname" name="name" value="<?=$branch->name;?>" placeholder="Nama Cabang"></input>
      <span class="help-inline"><?php echo form_error('name');?></span>
    </div>
  </div>
  <div class="control-group <?=$message2;?>">
    <label class="control-label" for="inputName">Alamat Cabang</label>
    <div class="controls">
      <input type="text" id="inputname" name="address" value="<?=$branch->address;?>" placeholder="Alamat Cabang"></input>
      <span class="help-inline"><?php echo form_error('address');?></span>
    </div>
  </div>
  <div class="control-group <?=$message3;?>">
    <label class="control-label" for="inputName">No Telepon</label>
    <div class="controls">
      <input type="text" id="inputname" name="phone_number" value="<?=$branch->phone_number;?>" placeholder="Nomer Telepon"></input>
      <span class="help-inline"><?php echo form_error('phone_number');?></span>
    </div>
  </div>
  <div class="control-group <?=$message4;?>">
    <label class="control-label" for="inputName">Nama Pimpinan Cabang</label>
    <div class="controls">
      <input type="text" id="inputname" name="leader" value="<?=$user->name;?>" placeholder="Pimpinan Cabang"></input>
      <span class="help-inline"><?php echo form_error('leader');?></span>
    </div>
  </div>
  <div class="control-group <?=$message5;?>">
    <label class="control-label" for="inputName">Username Pimpinan Cabang</label>
    <div class="controls">
      <input type="text" id="inputname" name="username" value="<?=$user->username;?>" placeholder="Username"></input>
      <span class="help-inline"><?php echo form_error('username');?></span>
    </div>
  </div>
  <div class="control-group <?=$message6;?>">
    <label class="control-label" for="inputName">Password Pimpinan Cabang</label>
    <div class="controls">
      <input type="password" id="inputname" name="password" value="<?php echo set_value('password');?>" placeholder="Password"></input>
      <span class="help-inline"><?php echo form_error('password');?></span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>