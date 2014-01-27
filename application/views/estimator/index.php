<table class="table table-bordered">
  <thead>
    <th>No</th>
    <th>Link</th>
  </thead>
  <tbody>
    <?php $number = 0; ?>
    <?php foreach ($branch as $key) { ?>
    <tr>
      <td><?=$number+=1;?></td>
      <td><?=anchor('formula/'.$key->id, $key->name);?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>