<?php

if($_SERVER['REQUEST_METHOD']=="POST") {
    $data->error = array();
    if($_POST['resultCheck'] !== sha1($_POST['control'])) {
        array_push($data->error, "Human verification failed.");
    }

    if(count($data->error)==0) {
        $name = Security::sanitizeText($_POST['name']);
        $email = Security::sanitizeEmail($_POST['email']);
        if(strlen($name)===0) {
            array_push($data->error, "Username is required.");
        }

        if(strlen($email)===0) {
            array_push($data->error, "Email is required.");
        }

        if(strlen($name)>0 && strlen($email) > 0 && User::NameEmailExists($name, $email)) {
            array_push($data->error, "Username or email is already taken");
        }
        $password = $_POST['password'];
        $confirm = $_POST['passwordConfirm'];
        if($password !== $confirm) {
            array_push($data->error, "Passwords do not match.");
        }
        if(!Security::checkPasswordRequirements($password)) {
            array_push($data->error, "Password does not meet the requirements.");
        }

        if(count($data->error)==0) {
            $data->user = User::Register($name, $email, $password);
            Router::Redirect('start');
        }
    }
}


$data->human1 = rand(1, 5);
$data->human2 = rand(1, 4);
$data->result = sha1($data->human1+$data->human2);

$page->setView('register');
$page->setName('register');
$page->setTitle('Register');
$page->setData($data);

?>
