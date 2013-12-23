<?php
  if(!form_error('nama')){
    $message = "";
  } else {
    $message = "error";
  }
?>
<?=form_open('subpekerjaan/edit/'.$subpekerjaan->id.'/'.$subpekerjaan->pekerjaan_id);?>
  <div class="control-group <?=$message;?>">
    <label class="control-label" for="inputName">Nama Subpekerjaan</label>
    <div class="controls">
      <input type="text" id="inputname" name="nama" value="<?php echo $subpekerjaan->nama;?>" placeholder="nama subpekerjaan"></input>
      <span class="help-inline"><?php echo form_error('nama');?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Keterangan</label>
    <div class="controls">
      <input type="text" id="inputname" name="keterangan" value="<?php echo $subpekerjaan->keterangan_peraturan;?>" placeholder="Keterangan"></input>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php form_close(); ?>