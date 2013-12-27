<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "error";
  }

?>
<?=form_open('subpekerjaan/create/'.$pekerjaan_id);?>
  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Name</label>
    <div class="controls">
      <input type="text" id="inputname" name="nama" value="<?php echo set_value('nama');?>" placeholder="nama"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Keterangan</label>
    <div class="controls">
      <input type="text" id="inputname" name="keterangan" value="<?php echo set_value('keterangan');?>" placeholder="Peraturan"></input>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Satuan</label>
    <div class="controls">
      <select name="satuan">
        <option value="m2">M2</option>
        <option value="m3">M3</option>
        <option value="buah">Buah</option>
        <option value="Kg">Kg</option>
        <option value="Unit">Unit</option>
        <option value="Titik">Titik</option>
      </select>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>