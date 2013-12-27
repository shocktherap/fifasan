<h3>Pilih Subpekerjaan</h3>
<?=form_open('subproject/save_sub_pekerjaan/'.$this->uri->segment(3));?>
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
        <?php $data = $this->get_data->get_subpekerjaan_by($key->id);
          foreach ($data as $pekerjaan_data) { ?>
          <label class="checkbox">
            <input type="checkbox" name="data_subpekerjaan[]" id="inlineCheckbox<?=$pekerjaan_data->id;?>" value="<?=$pekerjaan_data->id?>"/><?=$pekerjaan_data->nama;?>
          </label>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
  <?php
  }?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php form_close();?>