<?php

namespace controllers;


class HomeController
{
    public function indexAction($f3)
    {
       $f3->set('content','index.php');
       //echo \Template::instance()->render('layout.htm');
       echo \View::instance()->render('layout.php');
    }
}