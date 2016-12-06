<?php
$user = User::checkLoggedIn();

if($_SERVER['REQUEST_METHOD']=="GET") {
    if($routing[2]) {
        $timestamp = date("Y-m-d H:i:s", $routing[2]/1000);
        $chats = Chat::getFromDate($timestamp);
        if($chats) {
            echo json_encode($chats);
        }
        die();
    }
}

if($_SERVER['REQUEST_METHOD']=="POST") {
    if($user) {
        $message = Security::sanitizeText(trim($_POST['message']));
        if(strlen($message)>0) {
            $chat = new Chat;
            $chat->body = $message;
            $id = $chat->create($user->id);
            new API($id, 200);
        }
        die();
    } else {
        API::error("Not authorized", 405);
    }
}
?>
