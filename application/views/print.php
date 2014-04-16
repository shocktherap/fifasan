<html>
  <head>
    <title>Print PDF Output</title>
  </head>
  <body>
  <h1></h1>
  <div>  
    <table class="tg">
      <tr>
        <td class='tg-vn4c'>Nama Project</td>
        <td class='tg-vn4c'>Jenis Project</td>
        <td class='tg-vn4c'>Owner Project</td>
        <td class='tg-vn4c'>Alamat Project</td>
        <td class='tg-vn4c'>Tahun Anggaran Project</td>
        <td class='tg-vn4c'>Pekerja Project</td>
      </tr>
      <tr>
        <td class="tg-031e"><?=$data_project->nama;?></td>
        <td class="tg-031e"><?=$data_project->jenis;?></td>
        <td class="tg-031e"><?=$data_project->pemilik;?></td>
        <td class="tg-031e"><?=$data_project->alamat;?></td>
        <td class="tg-031e"><?=$data_project->tahun;?></td>
        <td class="tg-031e">   
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
  <table class='tg'>
  <?php foreach($pekerjaan as $key) { ?>
        <tr>
          <th class="tg-s6z2" colspan="6"><?php echo $key->nama;?></th>
        </tr>
        <tr>
          <td class='tg-vn4c'>#</td>
          <td class='tg-vn4c'>Subpekerjaan</td>
          <td class='tg-vn4c'>Satuan</td>
          <td class='tg-vn4c'>Harga Satuan</td>
          <td class='tg-vn4c'>Volume</td>
          <td class='tg-vn4c'>Jumlah</td>
        </tr>
        <?php
          $number = 0; 
          $count = 0;
          $data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
        ?>
        <?php foreach($data as $pekerjaan_data) { ?>
        <tr>
          <td class='tg-031e'><?=$number+=1;?></td>
          <td class='tg-031e'><?=$pekerjaan_data->nama;?></td>
          <td class='tg-031e'><?=$pekerjaan_data->satuan;?></td>
          <td class='tg-031e'><?=$pekerjaan_data->harga_satuan;?></td>

          <?php 
            $value = $this->get_data->get_row_value($id_project, $pekerjaan_data->subpekerjaan_id);
          ?>

          <td><?=$value->volume;?></td>
          <td><?=number_format($value->pengeluaran,0,",","."); $count += $value->pengeluaran;?></td>
        </tr>
        <?php } ?>
        <tr>
          <td class='ifyx' colspan="4"></td>
          <td class='ifyx'>Subtotal</td>
          <td class='ifyx'>Rp.<?=number_format($count,2,",",".");$total += $count;?></td>
        </tr>
        <tr>
          <td class="ifyx" colspan="6"></td>
        </tr>
  <?php } ?>
  </table>
      <?php $pengeluaran = $this->get_data->get_total($id_project);?>
      <table class='tg'>
        <tr>
          <th class='tg-s6z2'> Summary </th>
        </tr>
        <tr>
          <td class='tg-031e'>Total Kotor</td>
          <td class='tg-031e'>Rp.<?=number_format($pengeluaran->total_kotor,2,",",".");?></td>
        </tr>
        <tr>
          <td class='tg-031e'>Jasa</td>
          <td class='tg-031e'><?=$pengeluaran->jasa;?> %</td>
        </tr>
        <tr>
          <td class='tg-031e'>Total Bersih</td>
          <td class='tg-031e'>Rp.<?=number_format($pengeluaran->total_bersih,2,",",".");?></td>
        </tr>
        <tr>
          <td class='tg-031e'>Pembulatan</td>
          <td class='tg-031e'>Rp.<?=number_format($pengeluaran->pembulatan,2,",",".");?></td>
        </tr>
      </table>
      <br>
      <br>
      <p class="mycss">Moelia Graha Estetika</p>
      <br>
      <br>
      <br>
      <br>
      <p class="mycss"> Ir. Masyuri Kurniawan</p>
      <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#999;margin-bottom: 20px;}
        .tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
        .tg .tg-0ord{text-align:right}
        .tg .tg-ifyx{background-color:#D2E4FC;text-align:right}
        .tg .tg-s6z2{text-align:center}
        .tg .tg-vn4c{background-color:#D2E4FC;float: none;text-align: center}
        .mycss
        {
        font-weight:normal;color:#000000;letter-spacing:2pt;word-spacing:-1pt;font-size:12px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:2;width: 800px;
        }
      </style>
  </body>
</html>
