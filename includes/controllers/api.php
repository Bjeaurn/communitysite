<?php
$router = Router::Start();
$routing =  $router->getRouting();
if($routing[1]) {
    $file = $routing[1];
}
// No route = authentication?

/*$token = apache_request_headers()["Authorization"];
if(!$token) {
    API::error("No authentication token", 401);
    die();
}

$user = Authentication::Verify($token);
if(!$user) {
    API::error("Invalid authentication token", 401);
    die();
}
*/
$request = API::GetInput();

try {
    require_once("api/".$file.".php");
} catch(Exception $e) {
    API::error("No valid route", 404);
}
die();
?>
