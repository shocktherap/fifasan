<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "error";
  }

?>
<?=form_open('pekerjaan/create');?>
  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
      <input type="text" id="inputname" name="nama" value="<?php echo set_value('nama');?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>