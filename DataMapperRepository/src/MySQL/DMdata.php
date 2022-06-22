<?php

namespace Meme\Chat\MySQL;

use PDO;

class DMdata
{
    private $l;
    public array $data = [];

    public function __construct()
    {
        $this->l = new PDO('mysql:host=localhost;dbname=sit', 'meme', 'memepass');
        $this->SetData();

    }
    public function SetData()
    {
        $command = "select * from logPas";
        $sql = $this->l->prepare($command);
        $sql->execute();
        $this->data = $sql->fetchAll();

    }

    public function Command($command)
    {
        $sql = $this->l->prepare($command);
        $sql->execute();
        $this->SetData();
    }

}