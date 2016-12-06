<?php require_once("menu.php"); ?>
<div class="col-md-12">
    <div class="col-md-8">
            <?php if($data->user) { ?>
            <?php } ?>
            <script>
              <?php if($data->user) {?>var user = <?php echo json_encode($data->user); ?>; <?php }?>
              var chat = <?php echo json_encode($data->chat); ?>;
            </script>
            <chat></chat>
    </div>
    <div class="col-md-4">
        <div>
            Agenda
        </div>
        <div>
            <div id="ts3viewer_1093657" style=""> </div>
        </div>
    </div>
</div>
