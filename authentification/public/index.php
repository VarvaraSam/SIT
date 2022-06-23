<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Meme\Authentification\Controller\Controller;
require_once dirname(__DIR__) . '/vendor/autoload.php';
$loader = new FilesystemLoader(dirname(__DIR__) . "/src/View/");
$twig = new Environment($loader);
$controller = new Controller($twig);

//<button name = "regbtn" onclick="window.location.href = 'http://46.101.239.77:82/registration'">Регистрация</button>
$controller->control();
//$uri = $_SERVER['REQUEST_URI'];
//if (isset($_COOKIE['Reglogin']))
//{
//    echo "Пользователь зарегестрирован </p>";
//}


