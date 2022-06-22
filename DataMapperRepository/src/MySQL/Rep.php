<?php

namespace Meme\Chat\MySQL;
use Meme\Chat\MySQL\DM;


class Rep
{
    private DM $DM;

    public function __construct()
    {
        $this->DM = new DM();
    }

    public function getAll()
    {
        $result = $this->DM->MDGetAll();
        echo "<p>------------------------------</p>";

        foreach ($result as $record)
        {
            $id = $record['id'];
            $log = $record['login'];
            $pas = $record['pass'];
            echo "<p>" . $id . ' ' .$log . ' ' . $pas . "</p>" ;
        }
        echo "<p>------------------------------</p>";
    }

    public function getById($id)
    {
        echo "<p>------------------------------</p>";
        if ($this->DM->MDGetByID($id) === '')
        {
            echo "Записи с таким id нет";
        }
        else
        {
            echo $this->DM->MDGetByID($id);
        }
        echo "<p>------------------------------</p>";
    }

    public function getByLogin($log)
    {
        echo "<p>------------------------------</p>";
        echo $this->DM->MDGetByLogin($log);
        echo "<p>------------------------------</p>";
    }
    public function Add($log,$pas)
    {
        $this->DM->MDAdd($log,$pas);
    }
    public function Change($id,$newpas)
    {
        $this->DM->MDChange($id,$newpas);
    }
    public function Delete($id)
    {
        $this->DM->MDDelete($id);
    }

}