<?php

namespace Meme\Chat\MySQL;

use Meme\Chat\MySQL\DMdata;
//use PDO;

class DM
{
    public DMdata $DMdata;

    public function __construct()
    {
        $this->DMdata = new DMdata();
    }

    public function MDGetAll()
    {
        return $this->DMdata->data;
    }

    public function MDGetByID($id)
    {
        $table = $this->DMdata->data;
        $result ='';
        foreach ($table as $record)
        {
            if ($record['id'] === $id)
            {
                $result = $record['id'] .' '. $record['login'];
            }
        }
        return $result;
    }

    public function MDGetByLogin($log)
    {
        $table = $this->DMdata->data;
        $result ='<p>';
        foreach ($table as $record)
        {
            if ($record['login'] === $log)
            {
                $result = $result . ' ' . $record['id'] . " " . $record['login'] ."</p>" ;
            }
        }
        return $result;
    }

    public function MDAdd($log,$pas)
    {
        $this->DMdata->Command("insert into logPas(login,pass) values ('$log','$pas')");
    }

    public function MDChange($id,$newpas) {
        $this->DMdata->Command("update logPas set  pass = '$newpas' where id = $id");
    }

    public function MDDelete($id) {
        $this->DMdata->Command("delete from logPas where id = $id");

    }


}
