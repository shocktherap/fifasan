<?php $nama_sub = $this->get_data->get_subpekerjaan_by_id($id_sub);
  echo "<h3>Daftar Rumus ".$nama_sub->nama." :</h3>";
?>
<?=anchor('formula/create/'.$id_sub, 'Create New Formula', 'button class="btn btn-primary"');?>
<table class="table table-hover">
<tr>
  <td>Rumus</td>
  <td>Satuan</td>
  <td>Nama Item</td>
  <!-- <td>harga Dasar</td> -->
  <!-- <td>Harga Item</td> -->
  <td>Jenis</td>
  <td>Actions</td>
</tr>
<?php $harga_satuan = 0; ?>
<?php foreach ($data as $key) {?>  
<?php $harga_satuan = $harga_satuan + $key->harga_item; ?>
<tr>
  <td><?=$key->rumus;?></td>
  <td><?=$key->satuan;?></td>
  <td><?=$key->nama_item;?></td>
  <!-- <td><?#=$key->harga_dasar;?></td> -->
  <!-- <td><?#=$key->harga_item;?></td> -->
  <td><?=$key->keterangan;?></td>
  <td><i class="icon-edit"></i><?=anchor('formula/edit/'.$key->id.'/'.$key->subpekerjaan_id, 'Edit');?> || <a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a>||<i class="icon-star"></i><?=anchor('formula/set_basic_price/'.$key->id, 'Set Harga');?></td>
  <?php 
  $data['id'] = $key->id;
  $data['id_sub'] = $key->subpekerjaan_id;
  $this->load->view('formula/modal_delete_formula', $data, FALSE);?>
</tr>
<?php } ?>
</table>

<?php 
// $branch = $this->managers->get_branch();
// foreach ($branch as $branch) {
//   $subpeker = $this->get_data->get_all_subpekerjaan();
//   foreach ($subpeker as $key) {
//     $hitung = 0;
//     $foru = $this->get_data->get_sub_in_formula($key->id);
//     foreach ($foru as $key2) {
//       $multiple = $this->get_data->get_multiple_by($branch->id, $key2->id);
//       // echo $multiple->harga_item; echo "<br \>";
//       $hitung += $multiple->harga_item;
//     }
//     $this->input_data->input_formula_branch($key->id, $branch->id, $hitung);
//     // echo $hitung;echo"----";echo $key->id;echo "branch: ".$branch->id;echo "<br \>";
//   }
// }

// $test = $this->get_data->get_multiple_by(22, 4); ?>
<?php #$this->input_data->input_harga_satuan($id_sub, $harga_satuan);?>
<!-- <h3>Harga Satuan: Rp. <?=$harga_satuan;?></h3> -->
<?=anchor('formula/index', 'Back', 'class="btn"');?>