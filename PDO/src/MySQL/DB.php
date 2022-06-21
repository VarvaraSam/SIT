<?php

namespace Meme\Chat\MySQL;

use PDO;

class DB
{
    private $link;

    public function __construct()
    {
        $this->link = new PDO('mysql:host=localhost;dbname=sit', 'meme', 'memepass');
    }

    
    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }

    
}
