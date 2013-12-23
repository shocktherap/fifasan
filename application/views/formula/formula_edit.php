<script>
  function updatesum() {
    document.form.harga_item.value = (document.form.rumus.value -0) * (document.form.harga_dasar.value -0);
  }
</script>
<?php $nama_sub = $this->get_data->get_subpekerjaan_by_id($data_sub_formula->subpekerjaan_id);
  echo "<h3>Rumus ".$nama_sub->nama." :</h3>";
?>
<?=form_open('formula/edit/'.$data_sub_formula->id.'/'.$data_sub_formula->subpekerjaan_id,'name="form"');?>
<table class="table table-stripped">
  <tr>
    <td>Rumus</td>
    <td><input id="rumus" name="rumus" onkeyup="updatesum()" value="<?=$data_sub_formula->rumus;?>" placeholder="Rumus"><?php echo form_error('rumus');?></input></td>
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
    <td><input name="nama_item" value="<?=$data_sub_formula->nama_item;?>" placeholder="Rumus"><?php echo form_error('nama_item'); ?></input></td>
  </tr>
  <tr>
    <td>Harga Dasar</td>
    <td>Rp. <input name="harga_dasar" onkeyup="updatesum()" id="harga_dasar" value="<?php echo $data_sub_formula->harga_dasar;?>" placeholder="Harga Dasar"><?php echo form_error('harga_dasar'); ?></input></td>
  </tr>
  <tr>
    <td>Harga Item</td>
    <td>Rp. <input name="harga_item" id="harga_item" value="" placeholder="Harga item" ><?php echo form_error('harga_item'); ?></input></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td><select name="keterangan">
      <option value="Upah">Upah</option>
      <option value="Bahan">Bahan</option>
    </select></td>
  </tr>
  <tr>
    <td><button type="submit" class="btn btn-primary">Edit</button></td>
    <td><?=anchor('formula/show/'.$data_sub_formula->subpekerjaan_id, 'Back', 'class="btn"');?></td>
  </tr>
</table>
<?php form_close(); ?>


</body>