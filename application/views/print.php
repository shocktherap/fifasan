<html>
  <head>
    <title>Print PDF Output</title>
  </head>
  <body>
<?php 
  $pekerjaan = $this->get_data->get_pekerjaan();
  $total = 0;
  foreach ($pekerjaan as $key) { ?>
  <h3><?=$key->nama;?></h3>
    <div>
      <table border="2">
        <thead>
          <tr>
            <td>#</td>
            <td>Subpekerjaan</td>
            <td>Satuan</td>
            <td>Harga Satuan</td>
            <td>Something</td>
            <td>Volume</td>
            <td>Jumlah</td>
          </tr>
        </thead>
        <tbody>
        <?php 
          $data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
          $number = 0;
          $count = 0;
          foreach ($data as $pekerjaan_data) { ?>
          <tr>
            <td><?=$number += 1;?></td>
            <td><?=$pekerjaan_data->nama;?></td>
            <td><?=$pekerjaan_data->satuan;?></td>
            <td><?=$pekerjaan_data->harga_satuan;?></td>
            <td><?=$pekerjaan_data->nama;?></td>
          <?php 
            $value = $this->get_data->get_row_value($id_project, $pekerjaan_data->subpekerjaan_id);
          ?>
            <td><?=$value->volume;?></td>
            <td><?=$value->pengeluaran;?></td>
          <?php
            $count += $value->pengeluaran;
           ?> 
          </tr>
        <?php } ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Subtotal</strong></td>
            <td><?=$count;?></td>
          </tr>
        </tbody>
      </table>
<?php } ?>
    </div>
    <div>
    <?php $pengeluaran = $this->get_data->get_total($id_project);?>
      <table border='2'>
        <tr>
          <td><h4>Total Kotor</h4></td>
          <td><h4><?=$pengeluaran->total_kotor;?></h4></td>
        </tr>
        <tr>
          <td><h4>Jasa</h4></td>
          <td><h4><?=$pengeluaran->jasa;?></h4></td>
        </tr>
        <tr>
          <td><h4>Total Bersih</h4></td>
          <td><h4><?=$pengeluaran->total_bersih;?></h4></td>
        </tr>
        <tr>
          <td><h4>Pembulatan</h4></td>
          <td><h4><?=$pengeluaran->pembulatan;?></h4></td>
        </tr>
      </table>
    </div>
    <div>
        
    </div>
  </body>
</html>