<?php

namespace App\Services;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigController
{
    public function twig(): Environment
    {
        $twig = new FilesystemLoader("app/Views/");
        $view = new Environment($twig);
        $view->addGlobal('activeId', $_SESSION['activeId']);
        $view->addGlobal("url", $_SERVER["REQUEST_URI"]);
        return $view;
    }

}
