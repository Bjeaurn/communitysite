<?php require_once("menu.php"); ?>
<div class="col-md-12">
  <table class="table table-condensed">
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Starts in</th>
    </tr>
    <?php if($data->events) {?>
    <?php foreach($data->events as $event) { ?>
    <tr>
      <td><a href="events/<?=$event->id?>"><?=$event->name?></a></td>
      <td><?=$event->category?></td>
      <td><?=$event->startText?></td>
    </tr>
    <?php }
    } else {?>
    <tr>
      <td colspan="3">No events planned yet.</td>
    </tr>
    <?php } ?>
  </table>
</div>
