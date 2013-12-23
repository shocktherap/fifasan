<table class="table table-condensed">
<tr>
  <td>Nama Project</td>
  <td><?=$data_project->nama;?></td>
</tr>
<tr>
  <td>Jenis Project</td>
  <td><?=$data_project->jenis;?></td>
</tr>
<tr>
  <td>Lokasi Project</td>
  <td><?=$data_project->lokasi;?></td>
</tr>
<tr>
  <td>Owner Project</td>
  <td><?=$data_project->pemilik;?></td>
</tr>
<tr>
  <td>Tahun Anggaran Project</td>
  <td><?=$data_project->tahun;?></td>
</tr>
<tr>
  <td>Status Project</td>
  <td>
    <?php $status = $this->get_data->get_nama_status($data_project->status_id);
      echo $status->name;?>
  </td>
</tr>
</table>
<?=anchor('home/index', 'Back', 'class="btn btn-primary"');?>