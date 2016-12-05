<?php
if($_SERVER['REQUEST_METHOD']!=="GET") {
    if($_SERVER['REQUEST_METHOD']=="POST") {
        $user = User::Login($_POST['name'], $_POST['password']);
        if($user) {
            $data->user = $user;
        }
    }
}

if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
}

$data->chat = Chat::getChat();

$page->setTitle(__UNIT_NAME);
$page->setData($data);
$page->setName('default');
$page->setView('default');
?>
