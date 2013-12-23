<?php 
  $pekerjaan_row = $this->get_data->get_pekerjaan_row();
  $count_sub = 0;
  for ($pekerjaan_id=2; $pekerjaan_id <= $pekerjaan_row+1; $pekerjaan_id++) { 
    $subpekerjaan_row = $this->get_data->get_project_subpekerjaan_row("pekerjaan_id", $pekerjaan_id, $id_project);
      for ($subpekerjaan_id=1; $subpekerjaan_id <= $subpekerjaan_row ; $subpekerjaan_id++) { 
        $count_sub+=1;
        echo "pekerjaan_id = ".$pekerjaan_id.", subpekerjaan_id = ".$subpekerjaan_id." id = ".$count_sub."<br />";
        ?>
        <script>
        function sumup<?=$count_sub;?>() {
          document.form.jumlah<?=$count_sub;?>.value = (document.form.harga_satuan<?=$count_sub;?>.value -0) * (document.form.volume<?=$count_sub;?>.value -0);
        }
        </script>
      <?php }
  }

?>
<h3>Daftar Subpekerjaan</h3>
<?=form_open('subproject/rab','name="form"');?>
<?php 
  $number_id = 0;
  $work_id = 1;
?>
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
      <?php $work_id+=1;?>
      <td><input id="sum_work<?=$work_id?>" type="text" value="" class="input-small" disabled></input></td>
    </tr>
</table>
<?php } ?>
<h2>Total semua pembelanjaan adalah : Rp xxx.xxx,xx </h2>
<button type="submit" class="button primary">Submit</button>
<?php form_close();?>