 <?=form_open('home/show_user/');?>
 <?php
  if(!form_error('old_password')){
    $message = "";
  } else {
    $message = "error";
  }
?>
<?php
  if(!form_error('new_password')){
    $message1 = "";
  } else {
    $message1 = "error";
  }
?>
<?php
  if(!form_error('confirm_password')){
    $message2 = "";
  } else {
    $message2 = "error";
  }
?>
<td><h4>Nama : <?php print_r($user->name);?></h4></td>
  <table class="table">
    <tr>
      <td><h5>Ubah Password</h5></td>
    </tr>
    <tr>
      <td>
        <div class="control-group <?=$message;?>">
        <label class="control-label" for="inputOldPassword">Password Lama</label>
      
        <div class="controls">
          <input type="text" id="inputname" name="old_password" value="<?php echo set_value('old_password');?>" placeholder="Password Lama"></input>
          <span class="help-inline"><?php echo form_error('old_password');?></span>
        </div>
      </div>  
      </td>
    </tr>
    <tr>
      <td>
      <div class="control-group <?=$message1;?>">
        <label class="control-label" for="inputnewpassword">Password Baru</label>
      
        <div class="controls">
          <input type="text" id="inputnewpassword" name="new_password" value="<?php echo set_value('new_password');?>" placeholder="Password Baru"></input>
          <span class="help-inline"><?php echo form_error('new_password');?></span>
        </div>
      </div>
      </td>
    </tr>
    <tr>
      <td>
      <div class="control-group <?=$message2;?>">
        <label class="control-label" for="inputconfirmasi_password">Confirmasi Password</label>
      
        <div class="controls">
          <input type="text" id="inputconfirmasi_password" name="confirm_password" value="<?php echo set_value('confirm_password');?>" placeholder="Confirmasi Password"></input>
          <span class="help-inline"><?php echo form_error('confirm_password');?></span>
        </div>
      </div>
      </td>
    </tr>
    <tr>
      <td><button type="submit" class="btn btn-primary">Save changes</button></td>
    </tr>
  </table>

<?php form_close();?>