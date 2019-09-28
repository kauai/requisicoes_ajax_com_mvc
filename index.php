<?php
use CoffeeCode\Router\Router;
use League\Plates\Engine;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(ROOT);
$router->namespace("Source\Controllers");

$router->group(null);
$router->get('/', "form:home", "form.home");
$router->post('/create', "form:create", "form.create");
$router->post('/delete', "form:delete", "form.delete");

$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}
