<?php require_once("menu.php"); ?>
<div class="col-md-12">
    <div class="col-md-8">
        <table class="table table-condensed">
            <?php if($data->user) { ?>
            <tr>
                <td colspan="2" style="border-top: none;">
                    <input type="text" name="Chat" class="form-control" id="ChatMessage" placeholder="Leave a message, press enter." />
                    <script>
                        var chat = document.getElementById("ChatMessage");
                        chat.addEventListener('keyup', function(e) {
                            if ((e.keyCode || e.which) == 13) {
                                $.post('api/chat/', { message: chat.value });
                                chat.value = '';
                            }
                        });
                    </script>
                </td>
            </tr>
            <?php } ?>
            <?php foreach($data->chat as $message) {?>
            <tr id="chat-<?=$message->id?>">
                <td valign="top" align="left"><img src="images/logo-16.png" /> <?=$message->user->name?><br />
                    <small title="<?=$message->datetime?>"><?php echo dateToText($message->datetime); ?></small></td>
                <td valign="top"><?=$message->body?></td>
            </tr>
            <?php } ?>
        </table>
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
