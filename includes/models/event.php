<?php
class Event extends Model {
  public $id, $name, $category, $description, $userID, $startDateTime, $endDateTime, $startText, $endText;

  public function FillObject($row) {
    parent::FillObject($row);
    $this->startText = dateToText($row['EventStartDateTime']);
    $this->startEnd = dateToText($row['EventEndDateTime']);
  }

  public static function FindFuture() {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM events WHERE EventEndDateTime >= NOW() ORDER BY EventStartDateTime");
    $result->execute();
    $events = array();
    while($row = $result->fetch()) {
      $event = new Event;
      $event->FillObject($row);
      array_push($events, $event);
    }
    return $events;
  }

  public static function FindById($eventID) {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM events WHERE EventID = :eventID");
    $result->bindParam(":eventID", $eventID);
    $result->execute();
    if($result->rowCount() == 1) {
      $row = $result->fetch();
      $event = new Event;
      $event->FillObject($row);
      return $event;
    }
    return false;
  }

}
