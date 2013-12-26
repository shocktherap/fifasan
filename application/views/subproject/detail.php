<?=anchor('subproject/edit/'.$id_project, 'Edit RAB', 'class="btn"');?>
<h3>Rencana Anggaran Biaya <?=$project->nama;?></h3>
<?php 
  $number_id = 0;
  $work_id = 1;
  $pekerjaan_ids = 0;
  $total = 0;
?>
<?php foreach ($pekerjaan as $key) { ?>
<section id="<?=$key->id;?>">
  <div class="page-header">
    <h5><?=$key->nama; $work_id+=1;?></h5>
  </div>
  <table class="table table-stripped">
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
        $count = 0;
        foreach ($data as $pekerjaan_data) { ?>
        <tr>
          <?php $value = $this->get_data->get_row_value($id_project, $pekerjaan_data->subpekerjaan_id);?>
          <?php $count+=$value->pengeluaran;?>
          <?php $number_id+=1; 
          $number+=1;
          ?>
          <td><?=$number;?></td>
          <td><?=$pekerjaan_data->nama; ?></td>
          <td><?=$pekerjaan_data->harga_satuan;?></td>
          <td><?=$value->volume;?></td>
          <td><?=number_format($value->pengeluaran,0,",",".");?></td>
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
        <td><?=number_format($count,2,",",".");?></td>
        <?php $total+=$count;?>
      </tr>
  </table>
</section>
<?php } ?>
<h2>Total semua pembelanjaan adalah : Rp <?=number_format($total,2,",",".");?> </h2>
<?=anchor('subproject/output/'.$id_project, 'Print', 'class="btn btn-primary"');?>