
<?php 
  $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'upload');
  echo form_open_multipart('upload/form_new/'.$id_project, $attributes);
?>
<?php
  if(!form_error('description')){
    $message = "";
  } else {
    $message = "error";
  }
?>
<?php if ($error) { ?>  
  <div class="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Warning!</strong> <?=$error;?>
  </div>
<?php } ?>
  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Description</label>
    <div class="controls">
      <textarea type="text" id="textareadesc" name="description" value="<?php echo set_value('description');?>" placeholder="Description" rows="3"></textarea>
      <span class="help-inline"><?php echo form_error('description');?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputJenis">File</label>
    <div class="controls">
      <input type="file" id="inputfile" name="userfile" value="<?php echo set_value('userfile');?>"></input>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit</button>
      <?=anchor('home/index', 'Cancel', 'class="btn"');?>
    </div>
  </div>
<?php form_close();?>