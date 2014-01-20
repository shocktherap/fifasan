<?php 
  $this->input_data->delete_subtotal($id_project);
  $row_pekerjaan = $this->get_data->get_pekerjaan_rows(); 
  $total_count = 0;
  for ($i=2; $i <= $row_pekerjaan+1; $i++) { 
    $subpekerjaan_count = 0;
    $data[$i] = $this->get_data->project_sub_count($i, $id_project);
    foreach ($data[$i] as $key) {
      $subpekerjaan_count+=$key->pengeluaran;
    }
    $total_count+=$subpekerjaan_count;
    $this->input_data->input_subtotal($id_project, $i, $subpekerjaan_count);
  }
  $this->input_data->input_total($id_project, $total_count);
?>
<?php 
$session_data = $this->session->userdata('login');
  if ($session_data['level'] != 'manager') { ?>
  <?=anchor('subproject/edit/'.$id_project, 'Edit RAB', 'class="btn"');?>
<?php      
  }
?>

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
        <td class="span1">Satuan</td>
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
          <td><?=$pekerjaan_data->satuan; ?></td>
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
        <td><strong>Subtotal</strong></td>
        <?php 
          $pekerjaan_ids+=1;
        ?>
        <td><strong><?=number_format($count,2,",",".");?></strong></td>
        <?php $total+=$count;?>
      </tr>
  </table>
</section>
<?php } ?>
<?php $pengeluaran = $this->get_data->get_total($id_project);?>
<table class="table table-bordered">
  <tr>
    <td><h4>Total Kotor</h4></td>
    <td>Rp. <?=number_format($pengeluaran->total_kotor,2,",",".");?></td>
  </tr>
  <tr>
    <td><h4>Jasa</h4></td>
    <td>Rp. <?=$pengeluaran->jasa;?>%</td>
  </tr>
  <tr>
    <td><h4>Total Bersih</h4></td>
    <td>Rp. <?=number_format($pengeluaran->total_bersih,2,",",".");?></td>
  </tr>
  <tr>
    <td><h4>Pembulatan</h4></td>
    <td>Rp. <?=number_format($pengeluaran->pembulatan,2,",",".");?></td>
  </tr>
</table>
<?=anchor('subproject/pdf_output/'.$id_project, 'Cetak PDF', 'class ="btn btn-primary"');?>