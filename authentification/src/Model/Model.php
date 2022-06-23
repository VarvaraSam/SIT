<?php
namespace Meme\Authentification\Model;

use PDO;
class Model
{
    private $login;
    private $pass;
    private $salt = "hrkwgy37874fhbl";
    private PDO $l;

    public function __construct()
    {
        $this->l = new PDO('mysql:host=localhost;dbname=sit', 'meme', 'memepass');
    }

    public function RegisterUser()
    {
        $result = $this->SearchByLogin();
        if ($result === 0)
        {

            $command = "insert into AUlogpass(login,password) values('$this->login','$this->pass')";
            $sql = $this->l->prepare($command);
            $sql->execute();
            return true;
        }
        else
        {
            echo "Пользователь с таким логином уже существует</p>";
        }
        return false;

    }
    public function SearchByLogin()
    {
        $command = "select * from AUlogpass where login ='$this->login'";
        $sql = $this->l->prepare($command);
        $sql->execute();
        $result = count($sql->fetchAll());
        return $result;
    }
    public function SearchByLoginAndPassword()
    {
        $command = "select * from AUlogpass where password = '$this->pass' and login='$this->login'";
        $sql = $this->l->prepare($command);
        $sql->execute();
        $result = count($sql->fetchAll());
        return $result;
    }

    public function gethash($l)
    {
        return  md5($l . $this->salt);
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getPass()
    {
        $command = "select password from AUlogpass where login ='$this->login'";
        $sql = $this->l->prepare($command);
        $sql->execute();
        $result = $sql->fetchAll()[0];
        return $result[0];
        //return $this->pass;
    }
    public function setPass($pass)
    {
        $this->pass = $this->gethash($pass);
    }


}