<div id="myModal<?=$key->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class='modal-dialog'>
    <div class='modal-content'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Confirmation</h3>
  </div>
  <div class="modal-body">
    <h5>Are you sure to delete?</h5>
  </div>
  <div class="modal-footer">
    <?=anchor('pekerjaan/delete/'.$key->id, '<i class="icon-trash icon-white"></i> Delete','class="btn btn-danger"');?>
    <button class="btn" data-dismiss="modal">Cancel</button>
  </div>
</div>
</div>
</div>