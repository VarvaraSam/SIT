<?php

namespace Meme\Authentification\Controller;
use Twig\Environment;
use Meme\Authentification\Model\Model;

class Controller
{
    private $twig;
    private $url = 'http://46.101.239.77:82';
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function control()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '')
        {
            if ($uri ==='/out?')
            {
                setcookie('login', '');
                setcookie('cookiehacker', '');
                echo $this->twig->render('logging.html.twig');
                echo $this->twig->render('registr.html.twig');

                setcookie('login', '');
                setcookie('cookiehacker', '');
            }
            else  if ($uri ==='/login'){
                $this->CookieHacker();
                $this->getInfo();
                echo $this->twig->render('login.html.twig');
            }

        }
        else {


            switch ($uri) {
                case '/':
                {
                    echo $this->twig->render('logging.html.twig');
                    echo $this->twig->render('registr.html.twig');
                    break;
                }
                case '/registration?':
                {
                    echo $this->twig->render('registration.html.twig');
                    //$this->runreg();

                    break;
                }
                case '/login':
                {
                    $this->CookieHacker();
                    $this->getInfo();
                    $this->runlogin();
                    echo $this->twig->render('login.html.twig');

                    break;
                }
                case '/registrationfinal':
                {
                    //echo $_POST['loginreg'];
                    $this->runreg();

                    break;
                }
                case '/out?':
                {
                    setcookie('login', '');
                    setcookie('cookiehacker', '');
                    echo $this->twig->render('logging.html.twig');
                    echo $this->twig->render('registr.html.twig');

                    setcookie('login', '');
                    setcookie('cookiehacker', '');

                    break;
                }
            }
        }
    }

    private function runreg()
    {
        if ((trim($_POST['loginreg']) !== '') && (trim($_POST['passwordreg']) !== ''))
        {
           $model = new Model();
           $model->setLogin(trim($_POST['loginreg']));
           $model->setPass(trim($_POST['passwordreg']));
           $Saccesed = $model->RegisterUser();
           if ($Saccesed)
           {
               echo "Регистрация прошла успешно</p>";
           }
           else
           {
               echo "Регистрация не произошла</p>";
           }

            echo $this->twig->render('logging.html.twig');
            echo $this->twig->render('registr.html.twig');

        }

    }

    private function runlogin()
    {
        if ((trim($_POST['login']) !== '') && (trim($_POST['password']) !== ''))
        {

            $model = new Model();
            $model->setLogin(trim($_POST['login']));
            $model->setPass(trim($_POST['password']));
            $result = $model->SearchByLoginAndPassword();

            if($result === 1)
            {
                setcookie('login',$model->getLogin(), time() + 300);
                setcookie('cookiehacker',$model->gethash($model->getLogin()), time() + 300);

                //echo $this->twig->render('login.html.twig');
            }
            else
            {
                echo "Попробуйте еще раз";
                echo $this->twig->render('logging.html.twig');
                echo $this->twig->render('registr.html.twig');
            }


        }
    }

    public function CookieHacker()
    {
        $model = new Model();
        if (isset($_COOKIE['cookiehacker']) && isset($_COOKIE['login']))
        {
            if ($_COOKIE['cookiehacker'] !== $model->gethash($_COOKIE['login']))
            {
                echo "хм..";
                setcookie('login','');
                setcookie('cookiehacker','');
                echo $this->twig->render('logging.html.twig');
                echo $this->twig->render('registr.html.twig');
            }
        }

    }

    public function getInfo()
    {
        $model = new Model();
        $model->setLogin($_COOKIE['login']);
        $model->getPass();
        echo $_COOKIE['login'] ."   ". $model->getPass();;
    }


}