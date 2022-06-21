<?php

namespace Meme\Chat\MySQL;

use PDO;

class DB
{
    private $l;

    public function __construct()
    {
        $this->l = new PDO('mysql:host=localhost;dbname=sit', 'meme', 'memepass');
    }


    public function execute($sql)
    {
        $sth = $this->l->prepare($sql);
        return $sth->execute();
    }

    
}
