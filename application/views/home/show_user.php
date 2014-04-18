 <?php
  if(!form_error('old_password')){
    $message = "";
  } else {
    $message = "has-error";
  }
?>
<?php
  if(!form_error('new_password')){
    $message1 = "";
  } else {
    $message1 = "has-error";
  }
?>
<?php
  if(!form_error('confirm_password')){
    $message2 = "";
  } else {
    $message2 = "has-error";
  }
?>
<div class='row-fluid'>
  <div class='col-md-2'></div>
  <div class='col-md-8'>
    <div class='well'>
      <ul class='list-group'>
        <li class='list-group-item'>
          <dl class='dl-horizontal'>
           <dt>Nama</dt><dd><?php print_r($user->name);?></dd>
          </dl>
        </li>
        <li class='list-group-item'>
          <dl class='dl-horizontal'>
           <dt>Nomer Telepon</dt><dd><?php print_r($user->phone_number);?></dd>
          </dl>
        </li>
      </ul>
       <?=form_open('home/show_user/', array('role' => 'form'));?>
      <table class="table table-hover">
        <tr>
          <td><h5>Ubah Password</h5></td>
        </tr>
        <tr>
          <td>
            <div class="form-group <?=$message;?>">
            <label for="inputOldPassword">Password Lama</label>
              <input class='form-control' type="password" id="inputname" name="old_password" value="<?php echo set_value('old_password');?>" placeholder="Password Lama"></input>
              <span class="help-inline"><?php echo form_error('old_password');?></span>
          </div>  
          </td>
        </tr>
        <tr>
          <td>
          <div class="form-group <?=$message1;?>">
            <label for="inputnewpassword">Password Baru</label>
              <input class='form-control' type="password" id="inputnewpassword" name="new_password" value="<?php echo set_value('new_password');?>" placeholder="Password Baru"></input>
              <span class="help-inline"><?php echo form_error('new_password');?></span>
          </div>
          </td>
        </tr>
        <tr>
          <td>
          <div class="form-group <?=$message2;?>">
            <label for="inputconfirmasi_password">Confirmasi Password</label>
              <input class='form-control' type="password" id="inputconfirmasi_password" name="confirm_password" value="<?php echo set_value('confirm_password');?>" placeholder="Confirmasi Password"></input>
              <span class="help-inline"><?php echo form_error('confirm_password');?></span>
          </div>
          </td>
        </tr>
        <tr>
          <td><button type="submit" class="btn btn-primary">Save</button></td>
        </tr>
      </table>

    <?php form_close();?>
    </div>
  </div>
  <div class='col-md-2'></div>
</div>