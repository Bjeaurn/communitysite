<?php
class Chat extends Model {

    public $id, $userID, $body, $datetime;

    public function FillObject($row) {
        parent::FillObject($row);
        $this->userID = $row['UserID'];
        if($row['UserName']) {
            $this->user = new User;
            $this->user->FillObject($row);
        }
        $this->datetime = $row['ChatDateTime'];
    }

    public static function getChat() {
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT c.*, u.UserID, u.UserName FROM chatbox c, users u WHERE u.UserID = c.UserID GROUP BY c.ChatID ORDER BY ChatDateTime DESC LIMIT 20");
        $result->execute();
        $chats = array();
        while($row = $result->fetch()) {
            $chat = new Chat;
            $chat->FillObject($row);
            array_push($chats, $chat);
        }
        return $chats;
    }

    public function create($userID) {
        if($this->body) {
            $db = DatabasePDO::start();
            $result = $db->prepare("INSERT INTO chatbox (UserID, ChatBody, ChatDateTime) VALUES (:userID, :body, NOW())");
            $result->bindParam(":userID", $userID);
            $result->bindParam(":body", $this->body);
            $result->execute();
            return $db->lastInsertId();
        }
        return false;
    }
}

function pluralize( $count, $text ) {
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
}

function dateToText($datetime) {
    $datetime = new DateTime(date($datetime));
    //$datetime = strtotime($datetime);
    $interval = date_create('now')->diff( $datetime );
    $suffix = ( $interval->invert ? ' ago' : '' );
    $last = false;
    if ( $v = $interval->y >= 1 ) { echo pluralize( $interval->y, 'year' ); $last = true; }
    if ( $v = $interval->m >= 1 ) { if($last) { echo ", "; } echo pluralize( $interval->m, 'month' ); $last = true; }
    if ( $v = $interval->d >= 1 ) { if($last) { echo ", "; } echo pluralize( $interval->d, 'day' ); $last = true; }
    if($interval->d<=0 && $interval->m==0 && $interval->y==0) {
        if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' ) . $suffix;
        if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' ) . $suffix;
        return pluralize( $interval->s, 'second' ) . $suffix;
    } else {
        echo $suffix;
    }
}
