<div class='row'>

<h3>Pilih Rumus dari Subpekerjaan</h3>
<div class="panel-group" id="accordion2">
  <?php $number = 0;
  foreach ($pekerjaan as $key) {
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class='panel-title'>
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$key->id;?>">
          <?=$number+=1;?>. <?=$key->nama;?>
        </a>
    </div>
    <div id="collapse<?=$key->id;?>" class="panel-collapse collapse" style="height: 0px;">
      <div class="panel-body">
        <table class="table table-hover">
        <?php $number2 = 0;
        $data = $this->get_data->get_subpekerjaan_by($key->id);
          foreach ($data as $pekerjaan_data) { ?>
              <tr>
                <td><?=$number2+=1;?></td>
                <td><name="data_subpekerjaan" id="<?=$pekerjaan_data->id;?>"/><?=$pekerjaan_data->nama;?></td>
                <td><a data-toggle="modal" href="#myModal<?=$pekerjaan_data->id;?>"><button type='button' class='btn btn-default btn-sm' title='Detail'>
          <span class='glyphicon glyphicon-eye-open'></span>
        </button></a> </td>
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
</div>