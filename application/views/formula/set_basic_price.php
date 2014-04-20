<?=form_open('formula/update_basic_price/'.$formula_id, 'name="formula"');
$formula_sub = $this->get_data->get_sub_formula($formula_id);
?>
<div class="panel-group" id="accordion">
  <?php $branch = $this->branch->get_all_branch();
    foreach ($branch as $key) { ?>
    <script>
      function updatesum<?=$key->id;?>() {
        document.formula.total<?=$key->id;?>.value = (document.formula.rumus<?=$key->id;?>.value -0) * (document.formula.formula<?=$key->id;?>.value -0);
      }
    </script>
    <?php $multiple = $this->get_data->get_multiple_by($key->id, $formula_id);
    ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key->id;?>" class="collapsed">
          <?=$key->name;?>
        </a>
      </h4>
    </div>
    <div id="collapse<?=$key->id;?>" class="panel-collapse collapse" style="height: 0px;">
      <div class="panel-body">
        <label>Rumus</label><input class='form-control' id="rumus<?=$key->id;?>" type="text" name="rumus<?=$key->id;?>" value="<?=$formula_sub->rumus;?>" disabled></input>
        <label>Harga Dasar</label><input class='form-control' id="formula<?=$key->id;?>"type="text" name="formula<?=$key->id;?>" value="<?=$multiple->harga_dasar;?>" onkeyup="updatesum<?=$key->id;?>()"></input>
        <label>Total Harga Item</label><input class='form-control' id="total<?=$key->id;?>"type="text" name="total<?=$key->id;?>" value="<?=$multiple->harga_item;?>"></input>
      </div>
    </div>
  </div>      
  <?php } ?>
</div>
<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>