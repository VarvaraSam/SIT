<?php

use Meme\Chat\MySQL\DB;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


require_once dirname(__DIR__) . '/vendor/autoload.php';
$logsPath = "/var/www/html/chat/log/messages.log";
$loader = new FilesystemLoader(dirname(__DIR__) . "/twigTemplates/");
$log = new Logger('log');
$loggerHandler = new StreamHandler($logsPath, Logger::INFO);
$log->pushHandler($loggerHandler);
$twig = new Environment($loader);

echo $twig->render("main.html.twig");


$users = [
    "meme" =>"memepass",
    "koko"=>"kokopass"
];
if (isset($_GET['logs'])) {

    echo("Логи: ");
    $file = file_get_contents("/var/www/html/chat/log/messages.log");
    echo $file;
}


function add_mes_to_json($log2, $mes){
    $date = date('d.m.y h:i:s');
    $pdo = new DB();
    $mes_json = json_decode(file_get_contents("messages.json"),true);
    $mes_json['messages'] [] = ['date' => $date,'user'=>$log2, 'message' => $mes];
    file_put_contents("messages.json",json_encode($mes_json));
    $pdo->execute("insert into messages(date,user,massage) values ('$date  ',' $log2 ',' $mes ')");

}

function print_messages(){
    $mes_json = json_decode(file_get_contents("messages.json"),false);
    foreach ($mes_json->messages as $mes){
        echo '<p>' . $mes->date . '  ' . $mes->user . '  ' . $mes->message . '</p>';
    }
}

if ((string)$_GET['login'] !== '' && isset($_GET['login']) && isset($_GET['password']) && isset($_GET['message'])) {
    if ($users[(string)$_GET['login']] === (string)$_GET['password']) {
        add_mes_to_json((string)$_GET['login'],(string)$_GET['message']);
        $log->info('user send message',['user' => $_GET['login'], 'send' => $_GET['message']]);
        header('Refresh: 0; url=index.php');
    }
    else {
        echo "<script> alert(\"Неверный пароль\") </script>";
        $log->error('wrong password');
    }

}
print_messages();
?>

