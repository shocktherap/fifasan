<script>
  function updatesum() {
    document.form.harga_item.value = (document.form.rumus.value -0) * (document.form.harga_dasar.value -0);
  }
</script>
<?php $nama_sub = $this->get_data->get_subpekerjaan_by_id($id_sub);
  echo "<h3>Rumus ".$nama_sub->nama." :</h3>";
?>
<?=form_open('formula/create/'.$id_sub,'name="form"');?>
<table class="table table-stripped">
  <tr>
    <td>Rumus</td>
    <td><input id="rumus" name="rumus" value="<?=set_value('rumus');?>" onkeyup="updatesum()" placeholder="Rumus"><?php echo form_error('rumus');?></input></td>
  </tr>
  <tr>
    <td>Satuan</td>
    <td><select name="satuan">
      <option value="org">Org</option>
      <option value="hr">hr</option>
      <option value="m3">m3</option>
      <option value="m2">m2</option>
      <option value="kg">kg</option>
      <option value="lbr">lbr</option>
      <option value="bh">bh</option>
      <option value="btg">btg</option>
    </select></td>
  </tr>
  <tr>
    <td>Nama Item</td>
    <td><input name="nama_item" value="<?=set_value('nama_item');?>" placeholder="Nama Item"><?php echo form_error('nama_item');?></td>
  </tr>
  <tr>
    <td>Harga Dasar</td>
    <td>Rp.<input id="harga_dasar" name="harga_dasar" value="<?=set_value('harga_dasar');?>" onkeyup="updatesum()" placeholder="Harga Dasar"><?php echo form_error('harga_dasar');?></td>
  </tr>
  <tr>
    <td>Harga Item</td>
    <td>Rp. <input id="harga_item" name="harga_item" value="<?=set_value('harga_item');?>" placeholder="Harga Item"><?php echo form_error('harga_item');?></input></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td><select name="keterangan">
      <option value="Upah">Upah</option>
      <option value="Bahan">Bahan</option>
    </select></td>
  </tr>
</table>
<button type="submit" class="btn">Submit</button>
<?php form_close(); ?>
