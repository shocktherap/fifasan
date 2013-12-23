<h3>Pilih Rumus dari Subpekerjaan</h3>
<div class="accordion" id="accordion2">
  <?php $number = 0;
  foreach ($pekerjaan as $key) {
  ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$key->id;?>">
        <?=$number+=1;?>. <?=$key->nama;?>
      </a>
    </div>
    <div id="collapse<?=$key->id;?>" class="accordion-body collapse" style="height: 0px;">
      <div class="accordion-inner">
        <table class="table table-bordered">
        <?php $number2 = 0;
        $data = $this->get_data->get_subpekerjaan_by($key->id);
          foreach ($data as $pekerjaan_data) { ?>
              <tr>
                <td><?=$number2+=1;?></td>
                <td><name="data_subpekerjaan" id="<?=$pekerjaan_data->id;?>"/><?=$pekerjaan_data->nama;?></td>
                <td><a data-toggle="modal" href="#myModal<?=$pekerjaan_data->id;?>"><i class="icon-chevron-up"></i>Lihat Rumus</a> </td>
              </tr>
            <?php $data['pekerjaan_data'] = $pekerjaan_data;
            $this->load->view('formula/modal', $data);?>
        <?php
          }
        ?>
        </table>
      </div>
    </div>
  </div>
  <?php
  }?>
</div>