<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Meme\Authentification\Controller\Controller;
require_once dirname(__DIR__) . '/vendor/autoload.php';
$loader = new FilesystemLoader(dirname(__DIR__) . "/src/View/");
$twig = new Environment($loader);
$controller = new Controller($twig);

//$uri = $_SERVER['REQUEST_URI'];



$controller->control();
