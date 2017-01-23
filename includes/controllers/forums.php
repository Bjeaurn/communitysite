<?php
if(User::isLoggedIn() && !$data->user) {
    $data->user = User::getUser();
} else {
  Router::Redirect('start');
}
$routing = Router::getRouting();

if(!$routing[1]) {
    $forums = Forum::FindAll();
    $data->forums = $forums;

    $page->setTitle('Forums');
    $page->setName('forums');
    $page->setData($data);
    $page->setView('forums');

} else {

    if($routing[1]=="add") {
        if($_SERVER['REQUEST_METHOD']=="POST") {
            if($_POST['EventName'] && $_POST['DateStart'] && $_POST['DateEnd'] && $_POST['TimeStart'] && $_POST['TimeEnd']) {
                $event = new Event;
                $event->name = Security::sanitizeText($_POST['EventName']);
                $dateStart = date("Y-m-d H:i", strtotime($_POST['DateStart']." ".$_POST['TimeStart']));
                $dateEnd = date("Y-m-d H:i", strtotime($_POST['DateEnd']." ".$_POST['TimeEnd']));
                $event->setStart($dateStart);
                $event->setEnd($dateEnd);

                $event->create($data->user->getID());
                Router::Redirect('events/'.$event->getID());
            } else {
                $session->error('Not all required fields have been filled out...');
            }
        } else {
            $page->setTitle('New forum');
            $page->setName('forums');
            $page->setData($data);
            $page->setView('forum_add');
        }
    } elseif($routing[1] && !$routing[2]) {
        $forum = Forum::FindById($routing[1]);
        $data->forum = $forum;
        $data->posts = $forum->FindPosts();
        $page->setTitle('Forum: '. $forum->name);
        $page->setName('forums');
        $page->setData($data);
        $page->setView('forum_view');
    } elseif($routing[1] && $routing[2] && $routing[2]!="create") {
        $forum = Forum::FindById($routing[1]);
        $data->forum = $forum;
        $data->post = Post::FindById($routing[2]);

        if($_SERVER['REQUEST_METHOD']=="POST" && $data->post) {
            if($_POST['NewReply']) {
                $reply = new PostReply;
                $reply->body = nl2br(Security::sanitizeText($_POST['NewReply']));
                $reply->author = $data->user;
                $reply->create($data->post->getID());
                Router::Redirect();
            }
        }

        $data->post->replies = $data->post->FindReplies();
        $page->setTitle('Post: '. $data->post->title);
        $page->setName('forums');
        $page->setData($data);
        $page->setView('forum_post');
    } elseif($routing[2]=="create" && $routing[1]) {
        $forum = Forum::FindById($routing[1]);
        $data->forum = $forum;

        if($_SERVER['REQUEST_METHOD']=="POST") {
            if($_POST['PostTitle'] && $_POST['PostBody']) {
                $post = new Post;
                $post->title = Security::sanitizeText($_POST['PostTitle']);
                $post->body = nl2br(Security::sanitizeText($_POST['PostBody']));
                $post->author = $data->user;
                $post->create($data->forum->getID());
                Router::Redirect('forums/'.$forum->getID().'/'.$post->getID());
            }
        }

        $page->setTitle('New post');
        $page->setName('forums');
        $page->setData($data);
        $page->setView('forum_post_new');
    }
}
?>
