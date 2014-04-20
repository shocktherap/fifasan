<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "error";
  }

?>
<?=form_open('pekerjaan/create');?>
  <div class="form-group <?=$message;?>">
    <label>Name</label>
      <input class='form-control' type="text" id="inputname" name="nama" value="<?php echo set_value('nama');?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>