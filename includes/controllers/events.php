<?php
if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
}

$router = Router::start();
$routing = $router->getRouting();
if($routing[1]) {
  // Show event
  $eventID = $routing[1];
} else {
  // All events
}
?>
