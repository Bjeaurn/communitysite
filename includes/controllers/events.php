<?php
if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
}

$router = Router::start();
$routing = $router->getRouting();
if($_SERVER['REQUEST_METHOD']=="GET") {

  if($routing[1] && $routing[1]!=="new") {
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
  if(!$routing[1]) {
    if($data->user && $data->user->level > 0) {
      $event = new Event;
      $event->name = Security::sanitizeText($_POST['name']);
      $event->category = Security::sanitizeText($_POST['category']);
      $event->description = Security::sanitizeText($_POST['description']);

      $start = new DateTime($_POST['startDate']);
      if($start) {
        $event->startDateTime = $start->format('Y-m-d H:i');
      }
      $end = new DateTime($_POST['endDate']);
      if($end) {
        $event->endDateTime = $end->format('Y-m-d H:i');
      }

      $event->create($data->user->id);
      Router::Redirect('events/'.$event->id);
    } else {
      Router::Redirect('events');
    }
  } elseif($routing[1]) {
    if($data->user) {
      $eventID = $routing[1];
      $event = Event::FindById($eventID);
      $status = $_POST['status'];

      $attendance = new Attendance;
      $attendance->userID = $data->user->id;
      $attendance->eventID = $event->id;
      $attendance->status = $status;
      $attendance->update();
      Router::Redirect('events/'.$event->id);
    } else {
      Router::Redirect('events/'.$routing[1]);
    }
  }
}

$page->setData($data);
?>
