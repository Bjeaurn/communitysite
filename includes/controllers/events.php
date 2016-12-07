<?php
if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
}

$router = Router::start();
$routing = $router->getRouting();
if($_SERVER['REQUEST_METHOD']=="GET") {
  if(is_int($routing[1])) {
    // Show event
    $eventID = $routing[1];

    $data->attendingUser = Attendance::FindByEventAndUserID($eventID, $data->user->id);
    $data->event = Event::FindById($eventID);

    if(!$data->event) { Router::Redirect('events'); }

    $page->setView('event_view');
  } elseif($routing[1]=="new") {
    if($data->user && $data->user->level > 0) {
      $now = new DateTime('now');
      $data->start = $now->format('d-m-Y H:i');
      $data->end = $now->format('d-m-Y H:i');
      $page->setView('event_new');
    } else {
      Router::Redirect('events');
    }
  } else {
    // All events
    if($data->user) {
      $data->events = Event::FindAll();
    } else {
      $data->events = Event::FindFuture();
    }
    $page->setView('events');
  }
}

if($_SERVER['REQUEST_METHOD']=="POST") {
  print_r($_POST);
}

$page->setData($data);
?>
