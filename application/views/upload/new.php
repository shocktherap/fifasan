<?php
  if(!form_error('description')){
    $message = "";
  } else {
    $message = "has-error";
  }
?>
<?php if ($error) { ?>  
  <div class="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Warning!</strong> <?=$error;?>
  </div>
<?php } ?>
<?php 
  $attributes = array('id' => 'myform', 'name' => 'upload', 'role' => 'form');
  echo form_open_multipart('upload/form_new/'.$id_project, $attributes);
?>
  <div class="form-group <?=$message;?>">
    <label for="inputName">Description</label>
      <textarea class='form-control' type="text" id="textareadesc" name="description" value="<?php echo set_value('description');?>" placeholder="Description" rows="3"></textarea>
      <span class="help-inline"><?php echo form_error('description');?></span>
  </div>
  <div class="form-group">
    <label for="inputJenis">File</label>
      <input type="file" id="inputfile" name="userfile" value="<?php echo set_value('userfile');?>"></input>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
<?php form_close();?>