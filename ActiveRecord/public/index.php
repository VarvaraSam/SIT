<?php

use Meme\Chat\MySQL\DB;
use Meme\Chat\MySQL\AR;
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
    header('Refresh: 0;');
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
    if ($users[(string)$_GET['login']] == (string)$_GET['password']) {
        add_mes_to_json((string)$_GET['login'],(string)$_GET['message']);
        $log->info('user send message',['user' => $_GET['login'], 'send' => $_GET['message']]);
        header('Refresh: 0; url=index.php');
    }
    else {
        echo "<script> alert(\"Неверный пароль\") </script>";
        $log->error('wrong password');
    }

}

$tableRecord = new AR();
if (isset($_GET['ARGetAll']))
{
    $result = $tableRecord->ARGetAll();
    echo "<p>------------------------------</p>";
    foreach ($result as $record){
        $date = $record["date"];
        $user = $record["user"];
        $message = $record["massage"];

        echo "<p> $date $user $message</p>";

    }
    echo "<p>------------------------------</p>";
}
if (isset($_GET['ARGetByID']) && isset($_GET['ID']) && (string)$_GET['ID'] !== '')
{
    $id = $_GET['ID'];
    $result = $tableRecord->ARGetByID($id);
    echo "<p>------------------------------</p>";
    if(is_null($result))
    {
        echo "Записи с таким id нет";
    }
    else
    {
        $date = $result->getDate();
        $user = $result->getUser();
        $message = $result->getMassage();

        echo "<p> $date $user $message</p>";
    }
    echo "<p>------------------------------</p>";
}

if (isset($_GET['ARGetByName']) && isset($_GET['Newuser']))
{
    $name = $_GET['Newuser'];
    $result = $tableRecord->ARGetByName($name);
    echo "<p>------------------------------</p>";
    foreach ($result as $record){
        $date = $record["date"];
        $user = $record["user"];
        $message = $record["massage"];

        echo "<p> $date $user $message</p>";

    }
    echo "<p>------------------------------</p>";
}

if (isset($_GET['ARAdd']) && isset($_GET['Newdate'])&& isset($_GET['Newuser'])&& isset($_GET['Newmessage']))
{
    $date = $_GET['Newdate'];
    $name = $_GET['Newuser'];
    $message = $_GET['Newmessage'];
    $addRecord = new AR();
    $addRecord->setDate($date);
    $addRecord->setUser($name);
    $addRecord->setMassage($message);
    $addRecord->ARAdd();

}

if (isset($_GET['ARChange']) && isset($_GET['Newmessage'])&& isset($_GET['ID']) && (string)$_GET['ID'] !== '')
{
    $message = $_GET['Newmessage'];
    $id = $_GET['ID'];
    $result = $tableRecord->ARGetByID($id);
    $result->setMassage($message);
    $result->ARChange();

}

if (isset($_GET['ARDelete']) && isset($_GET['ID']) && (string)$_GET['ID'] !== '')
{
    $id = $_GET['ID'];
    $result = $tableRecord->ARGetByID($id);
    $result->ARDelete();
}
print_messages();
?>

