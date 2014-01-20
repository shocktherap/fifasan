<div id="myModal<?=$id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Confirmation</h3>
  </div>
  <div class="modal-body">
    <h5>Are you sure to delete Branch <?=$name;?>?</h5>
  </div>
  <div class="modal-footer">
    <?=anchor('manager/delete_branch/'.$id, '<i class="icon-trash icon-white"></i> Delete','class="btn btn-danger"');?>
    <button class="btn" data-dismiss="modal">Cancel</button>
  </div>
</div>