<?php require_once("menu.php"); ?>
<div class="col-md-12">
  <div class="col-md-12">
    <h2 style="padding-top: 0; margin-top: 0;"><?=$data->event->name?></h2>
    <h4><?=$data->event->category?></h4>
  </div>
  <div class="col-md-2">
    Starts: <?=$data->event->startText?>
  </div>
  <div class="col-md-2">
    Ends: <?=$data->event->endText?>
  </div>
  <?php if($data->event->description) {?>
  <div class="col-md-12">
    <p><?=$data->event->description?></p>
  </div>
  <?php } ?>
  <div class="col-md-12" style="margin-top: 1em;">
    <h4>Attending
      <a class="btn btn-success btn-xs " <?php if($data->attendingUser && $data->attendingUser->status==9) {?>disabled<?php }?>>Attending</a>
      <a class="btn btn-warning btn-xs" <?php if($data->attendingUser && $data->attendingUser->status==1) {?>disabled<?php }?>>Maybe</a>
      <a class="btn btn-danger btn-xs" <?php if($data->attendingUser && $data->attendingUser->status==0) {?>disabled<?php }?>>Not attending</a></h4>
    <?php if($data->event->attending) { ?>
    <ul>
    <?php foreach($data->event->attending as $attending) { ?>
      <li><?=$attending->user->name?> (<?=$attending->statusText?>)</li>
    <?php } ?>
    </ul>
    <?php } ?>
  </div>
</div>
