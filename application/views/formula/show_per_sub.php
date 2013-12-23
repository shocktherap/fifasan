<?php $nama_sub = $this->get_data->get_subpekerjaan_by_id($id_sub);
  echo "<h3>Daftar Rumus ".$nama_sub->nama." :</h3>";
?>
<?=anchor('formula/create/'.$id_sub, 'Create New Formula', 'button class="btn btn-primary"');?>
<table class="table">
<tr>
  <td>Rumus</td>
  <td>Satuan</td>
  <td>Nama Item</td>
  <td>harga Dasar</td>
  <td>Harga Item</td>
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
  <td><?=$key->harga_dasar;?></td>
  <td><?=$key->harga_item;?></td>
  <td><?=$key->keterangan;?></td>
  <td><?=anchor('formula/edit/'.$key->id.'/'.$key->subpekerjaan_id, 'Edit');?> || <a data-toggle="modal" href="#myModal<?=$key->id;?>"><i class="icon-trash"></i>Delete</a></td>
  <?php 
  $data['id'] = $key->id;
  $data['id_sub'] = $key->subpekerjaan_id;
  $this->load->view('formula/modal_delete_formula', $data, FALSE);?>
</tr>
<?php } ?>
</table>
<?php $this->input_data->input_harga_satuan($id_sub, $harga_satuan);?>
<h3>Harga Satuan: Rp. <?=$harga_satuan;?></h3>
<?=anchor('formula/index', 'Back', 'class="btn"');?>