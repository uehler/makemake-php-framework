<?php

namespace App\Controller;

use Core\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->view->assign('headline', 'Hello World!');
    }


    public function test()
    {
        $this->view->assign('headline', 'This is the headline of the test action');
        $this->view->assign('content', 'This test was successful!');
    }


    public function override()
    {
        $this->view->assign('headline', 'Now wie use the index/index.php to show the content of the override action');
        $this->view->loadTemplate('index/index.php');
    }
}