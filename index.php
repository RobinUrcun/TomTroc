<?php

require_once(__DIR__ . "/Router/Router.php");
require_once(__DIR__ . "/autoload.php");


session_start();

$router = new Router();

$router->routing();
