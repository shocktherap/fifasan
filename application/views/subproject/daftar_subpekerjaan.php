<script>
<?php $data = $this->get_data->get_subpekerjaan_rows();
for ($i=1; $i < $data; $i++) { ?>
  function sumup<?=$i;?>() {
      document.form.jumlah<?=$i;?>.value = (document.form.harga_satuan<?=$i;?>.value -0) * (document.form.volume<?=$i;?>.value -0);
    }
<?php } ?>  
</script>

<h3>Daftar Subpekerjaan</h3>
<?=form_open('subproject/rab','name="form"');?>
<?php $number_id = 0;?>
<?php foreach ($pekerjaan as $key) { ?>
<h5><?=$key->nama; ?></h5>
<table class="table table-bordered">
  <thead>
    <tr>
      <td class="span1">#</td>
      <td class="span7">Subpekerjaan</td>
      <td class="span2">Harga Satuan</td>
      <td class="span1">Volume</td>
      <td class="span1">Jumlah</td>
    </tr>
  </thead>
    <?php $data = $this->get_data->get_subprojectpekerjaan2($this->uri->segment(3),$key->id);
      $number = 0;
      foreach ($data as $pekerjaan_data) { ?>
      <tr>
        <?php $number_id+=1; ?>
        <td><?=$number+=1;?></td>
        <td><?=$pekerjaan_data->nama; ?></td>
        <td><input id="harga_satuan<?=$number_id;?>" type="text" name="harga_satuan<?=$number_id;?>" class="input-small" value="<?=$pekerjaan_data->harga_satuan;?>" disabled></input></td>
        <td><input id="volume<?=$number_id;?>" type="text" name="volume<?=$number_id;?>" class="input-small" onkeyup="sumup<?=$number_id;?>()" value="" ></input></td>
        <td><input id="jumlah<?=$number_id;?>"type="text" name="jumlah<?=$number_id;?>" class="input-small" value="" disabled></input></td>
      </tr>
    <?php
      }
    ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Total Subpekerjaan</td>
      <td><input id="sum_work" type="text" value="" class="input-small" disabled></input></td>
    </tr>
</table>
<?php } ?>
<h2>Total semua pembelanjaan adalah : Rp xxx.xxx,xx </h2>
<button type="submit" class="button primary">Submit</button>
<?php form_close();?>