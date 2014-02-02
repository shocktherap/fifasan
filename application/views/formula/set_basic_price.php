<?=form_open('formula/update_basic_price/'.$formula_id, 'name="formula"');
$formula_sub = $this->get_data->get_sub_formula($formula_id);
?>

<div class="accordion" id="accordion2">
<?php $branch = $this->branch->get_all_branch();
foreach ($branch as $key) { ?>
<script>
  function updatesum<?=$key->id;?>() {
    document.formula.total<?=$key->id;?>.value = (document.formula.rumus<?=$key->id;?>.value -0) * (document.formula.formula<?=$key->id;?>.value -0);
  }
</script>
<?php $multiple = $this->get_data->get_multiple_by($key->id, $formula_id);
?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$key->id?>">
        <?=$key->name;?>
      </a>
    </div>
    <div id="collapse<?=$key->id?>" class="accordion-body collapse">
      <div class="accordion-inner">
        <label>Rumus</label><input id="rumus<?=$key->id;?>" type="text" name="rumus<?=$key->id;?>" value="<?=$formula_sub->rumus;?>" disabled></input>
        <label>Harga Dasar</label><input id="formula<?=$key->id;?>"type="text" name="formula<?=$key->id;?>" value="<?=$multiple->harga_dasar;?>" onkeyup="updatesum<?=$key->id;?>()"></input>
        <label>Total Harga Item</label><input id="total<?=$key->id;?>"type="text" name="total<?=$key->id;?>" value="<?=$multiple->harga_item;?>"></input>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>