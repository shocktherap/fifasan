<?php 
  $pekerjaan_row = $this->get_data->get_pekerjaan_row();
  $count_sub = 0;
  for ($pekerjaan_id=2; $pekerjaan_id <= $pekerjaan_row+1; $pekerjaan_id++) { 
    $subpekerjaan_row = $this->get_data->get_project_subpekerjaan_row("pekerjaan_id", $pekerjaan_id, $id_project);
      for ($subpekerjaan_id=1; $subpekerjaan_id <= $subpekerjaan_row ; $subpekerjaan_id++) { 
        $count_sub+=1;
        // echo "pekerjaan_id = ".$pekerjaan_id.", subpekerjaan_id = ".$subpekerjaan_id." id = ".$count_sub."<br />";
        ?>
        <script>
        function sumup<?=$count_sub;?>() {
          document.form.jumlah_<?=$pekerjaan_id;?>_<?=$subpekerjaan_id;?>.value = (document.form.harga_satuan<?=$count_sub;?>.value -0) * (document.form.volume<?=$count_sub;?>.value -0);
        }
        function sum_sub<?=$pekerjaan_id;?>() {
          document.form.sum_work<?=$pekerjaan_id?>.value = (document.form.jumlah_<?=$pekerjaan_id;?>_<?=$subpekerjaan_id;?>.value -0);
        }
        </script>
      <?php }
  }
?>
<script type="text/javascript">
  function sum_subpekerjaan() {
    var bank = [];
    for (var i = 1; i <= 10; i++) {
      bank[i] = document.form.jumlah_2_1.value
    };
  }
</script>
<h3>Daftar Subpekerjaan</h3>
<?=form_open('subproject/rab/'.$id_project,'name="form"');?>
<?php 
  $number_id = 0;
  $work_id = 1;
  $pekerjaan_ids = 0;
?>
<?php foreach ($pekerjaan as $key) { ?>
<h5><?=$key->nama; $work_id+=1;?></h5>
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
    <?php $data = $this->get_data->get_subprojectpekerjaan2($id_project,$key->id);
      $number = 0;
      foreach ($data as $pekerjaan_data) { ?>
      <tr>
        <?php $number_id+=1; 
        $number+=1;
        ?>
        <td><?=$number;?></td>
        <td><?=$pekerjaan_data->nama; ?></td>
        <td><input id="harga_satuan<?=$number_id;?>" type="text" name="harga_satuan_<?=$work_id;?>_<?=$number;?>" class="input-small" value="<?=$pekerjaan_data->harga_satuan;?>" disabled></input></td>
        <td><input id="volume<?=$number_id;?>" type="text" name="volume_<?=$work_id;?>_<?=$number;?>" class="input-small" onkeyup="sumup<?=$number_id;?>()" value="0" ></input></td>
        <td><input id="jumlah_<?=$work_id;?>_<?=$number;?>"type="text" name="jumlah_<?=$work_id;?>_<?=$number;?>" class="input-small" value="0"></input></td>
      </tr>
    <?php
      }
    ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Subtotal</td>
      <?php 
        $pekerjaan_ids+=1;
      ?>
      <td><input id="sum_work<?=$pekerjaan_ids?>" type="text" value="" class="input-small" onclick="sum_sub<?=$pekerjaan_ids?>()" ></input></td>
    </tr>
</table>
<?php } ?>
<h2>Total semua pembelanjaan adalah : Rp xxx.xxx,xx </h2>
<button type="submit" class="button primary">Submit</button>
<?php form_close();?>