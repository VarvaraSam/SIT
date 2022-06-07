<div>
<form action="/" method="GET">
    <p>Логин</p>
    <input name="login" value="">
    <p>Пароль</p>
    <input name="password" value="">
    <p>Сообщение</p>
    <input name="message">
    <button>Отправить</button>
</form>
</div>
<?php
$users = [
        "meme" =>"memepass",
        "koko"=>"kokopass"
];
function add_mes_to_json($log, $mes){
    $mes_json = json_decode(file_get_contents("messages.json"),true);
    $mes_json['messages'] [] = ['date' => date('d.m.y h:i:s'),'user'=>$log, 'message' => $mes];
    file_put_contents("messages.json",json_encode($mes_json));
}

function print_messages(){
    $mes_json = json_decode(file_get_contents("messages.json"),false);
    foreach ($mes_json->messages as $mes){
        echo '<p>' . $mes->date . '  ' . $mes->user . '  ' . $mes->message . '</p>';
    }
}

if (isset($_GET['login']) && isset($_GET['password']) && isset($_GET['message'])) {
    if ($users[(string)$_GET['login']] === (string)$_GET['password']) {
        add_mes_to_json((string)$_GET['login'],(string)$_GET['message']);
    }
    else {
        echo "<script> alert(\"Неверный пароль\") </script>";
    }
}

print_messages();
?>

