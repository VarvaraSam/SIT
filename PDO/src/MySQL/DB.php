<?php

namespace Meme\Chat\MySQL;

use PDO;

class DB
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $this->link = new PDO('mysql:host=localhost;dbname=sit', 'meme', 'memepass');
    }

    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }

    public function query($sql): array
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false)
            return [];

        return  $result;
    }
}