<div id="myModal<?=$pekerjaan_data->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class='modal-dialog'>
    <div class='modal-content'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Formula</h3>
  </div>
  <div class="modal-body">    
    <?php $data = $this->get_data->get_sub_formula_all($pekerjaan_data->id);?>
    <?php if ($data) { ?>
    <h4>Beberapa attribut penghitungan RAB</h4>
    <ul>
      <?php foreach ($data as $key) { ?>
        <li>
          <p><?=$key->nama_item;?></p>
      </li>
      <?php } ?>
    </ul>
    <div class="modal-footer">
      <?=anchor('formula/show/'.$pekerjaan_data->id, '<i class="icon-edit icon-white"></i> Lihat Rumus','class="btn btn-primary"');?>
      <button class="btn" data-dismiss="modal">Close</button>
    </div>
    <?php } else { ?>
    <div class="alert">
      <strong>Data Belum Diisi!</strong> silahkan click tombol untuk mengisi data.
    </div>
    <div class="modal-footer">
      <?=anchor('formula/create/'.$pekerjaan_data->id, '<i class="icon-edit icon-white"></i> Buat Rumus','class="btn btn-primary"');?>
      <button class="btn" data-dismiss="modal">Close</button>
    </div>
    <?php } ?>
    <hr>
  </div>
  </div>
</div>
</div>