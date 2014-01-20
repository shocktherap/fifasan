<?php 
  $pekerjaan_row = $this->get_data->get_pekerjaan_row();
  $pekerjaan_row;
  $count_sub = 0;
  for ($pekerjaan_id=2; $pekerjaan_id <= $pekerjaan_row+1; $pekerjaan_id++) { 
    $subpekerjaan_row = $this->get_data->get_project_subpekerjaan_row("pekerjaan_id", $pekerjaan_id, $id_project);?>

      <?php for ($subpekerjaan_id=1; $subpekerjaan_id <= $subpekerjaan_row ; $subpekerjaan_id++) { 
        $count_sub+=1;
      ?>
        <script>
        function sumup<?=$count_sub;?>() {
          document.form.jumlah_<?=$pekerjaan_id;?>_<?=$subpekerjaan_id;?>.value = (document.form.harga_satuan<?=$count_sub;?>.value -0) * (document.form.volume<?=$count_sub;?>.value -0);
        }
        function count_sub<?=$pekerjaan_id;?>() {
          data<?=$pekerjaan_id;?> = [];
          <?php for ($i=1; $i <= $subpekerjaan_row ; $i++) { ?>
            data<?=$pekerjaan_id;?>[<?=$i;?>] = document.form.jumlah_<?=$pekerjaan_id;?>_<?=$i;?>.value
          <?php } ?>

          document.form.sum_work<?=$pekerjaan_id;?>.value = data<?=$pekerjaan_id;?>.reduce(function(pv, cv){return parseInt(pv)+parseInt(cv);});
        }
        </script>

      <?php }
  }
?>
<script>
  function call() {
    totali = [];
      <?php for ($i=2; $i <= $pekerjaan_row+1 ; $i++) { ?>
        totali[<?=$i;?>] = document.form.sum_work<?=$i;?>.value
      <?php } ?>
      document.form.total_kotor.value = totali.reduce(function(pv, cv){return parseInt(pv)+parseInt(cv);});
  }
  function jasa_product() {
    total_bersih = (document.form.jasa.value / 100) * (document.form.total_kotor.value - 0) + (document.form.total_kotor.value - 0);
    document.form.total_bersih.value = total_bersih
    document.form.pembulatan.value = total_bersih
  }
</script>

<h3>Daftar Subpekerjaan</h3>
<?=form_open('subproject/rab/'.$id_project,'name="form"');?>
<?php 
  $number_id = 0;
  $work_id = 1;
  $pekerjaan_ids = 1;
?>
<?php foreach ($pekerjaan as $key) { $pekerjaan_ids+=1;?>
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
        <?php $value = $this->get_data->get_row_value($id_project, $pekerjaan_data->subpekerjaan_id);?>
        <?php $number_id+=1; 
        $number+=1;
        ?>
        <td><?=$number;?></td>
        <td><?=$pekerjaan_data->nama; ?></td>
        <td><input id="harga_satuan<?=$number_id;?>" type="text" name="harga_satuan_<?=$work_id;?>_<?=$number;?>" class="input-small" value="<?=$pekerjaan_data->harga_satuan;?>" disabled></input></td>
        <td><input id="volume<?=$number_id;?>" type="text" name="volume_<?=$work_id;?>_<?=$number;?>" class="input-small" onkeyup="sumup<?=$number_id;?>()" onblur="count_sub<?=$pekerjaan_ids;?>()" value="0" ></input></td>
        <td><input id="jumlah_<?=$work_id;?>_<?=$number;?>"type="text" name="jumlah_<?=$work_id;?>_<?=$number;?>" class="input-small" value="0" ></input></td>
      </tr>
    <?php
      }
    ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Subtotal</td>
      <td><input id="sum_work<?=$pekerjaan_ids;?>" type="text" value="0" class="input-small" onclick="count_sub<?=$pekerjaan_ids;?>()" ></input></td>
    </tr>
</table>
<?php } ?>

<label>Total Kotor: </label><input id="total_kotor" type="text" name="total_kotor" onclick="call()" value=""></input>
<label>Jasa : </label><input id="jasa" type="text" name="jasa" value="" onkeyup="jasa_product()">%</input>
<label>Total Bersih: </label><input id="total_bersih" type="text" name="total_bersih" value=""></input>
<label>Pembulatan: </label><input id="pembulatan" type="text" name="pembulatan" value=""></input>
<div class="form-actions">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php form_close(); ?>