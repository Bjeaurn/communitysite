<?php
if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
}

$router = Router::start();
$routing = $router->getRouting();
if($routing[1]) {
  // Show event
  $eventID = $routing[1];

  $data->attendingUser = Attendance::FindByEventAndUserID($eventID, $data->user->id);
  $data->event = Event::FindById($eventID);

  $page->setView('event_view');
} else {
  // All events
  if($data->user) {
    $data->events = Event::FindAll();
  } else {
    $data->events = Event::FindFuture();
  }
  $page->setView('events');
}

$page->setData($data);
?>
