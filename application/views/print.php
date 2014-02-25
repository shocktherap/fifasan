<html>
  <head>
    <title>Print PDF Output</title>
  </head>
  <body>
  <div>  
    <table>
      <tr>
        <td>Nama Project</td>
        <td>Jenis Project</td>
        <td>Owner Project</td>
        <td>Alamat Project</td>
        <td>Tahun Anggaran Project</td>
        <td>Pekerja Project</td>
      </tr>
      <tr>
        <td><?=$data_project->nama;?></td>
        <td><?=$data_project->jenis;?></td>
        <td><?=$data_project->pemilik;?></td>
        <td><?=$data_project->alamat;?></td>
        <td><?=$data_project->tahun;?></td>
        <td>   
          <?php $pengguna = $this->user->getleaderby('id', $data_project->employe_id);?>
          <?=$pengguna->name;?>
        </td>
      </tr>
    </table>
  </div>
  <?php 
    $pekerjaan = $this->get_data->get_pekerjaan();
    $total = 0;
  ?>
  
  <?php foreach($pekerjaan as $key) { ?>
    <br><?php echo $key->nama;?>
    <table border="2">
      <thead>
        <tr>
          <td>#</td>
          <td>Subpekerjaan</td>
          <td>Satuan</td>
          <td>Harga Satuan</td>
          <td>Volume</td>
          <td>Jumlah</td>
        </tr>
      </thead>
      <tbody>
        <?php
          $number = 0; 
          $count = 0;
          $data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
        ?>
        <?php foreach($data as $pekerjaan_data) { ?>
        <tr>
          <td><?=$number+=1;?></td>
          <td><?=$pekerjaan_data->nama;?></td>
          <td><?=$pekerjaan_data->satuan;?></td>
          <td><?=$pekerjaan_data->harga_satuan;?></td>

          <?php 
            $value = $this->get_data->get_row_value($id_project, $pekerjaan_data->subpekerjaan_id);
          ?>

          <td><?=$value->volume;?></td>
          <td><?=$value->pengeluaran; $count += $value->pengeluaran;?></td>
        </tr>
        <?php } ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Subtotal</td>
          <td><?=$count; $total += $count; ?></td>
        </tr>
      </tbody>
    </table>
  <?php } ?>
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
  </body>
</html>