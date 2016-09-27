<?php

namespace App\Controller;

use App\Model\User;
use Core\Controller;

class Index extends Controller
{
    public function index()
    {
        /** sets a variable for the view */
        $this->view->assign('headline', 'Hello World!');
    }


    public function test()
    {

        // get a \App\Model
        /** @var User $userModel */
        $userModel = $this->getModel('user');


        // examples

        // send data to db
        $userModel->createUser('foo', 'bar', rand(10000, 99999) . '@foobar.de');


        // how to get data from the db

//        echo '<pre style="border: 1px solid red">';
//        print_r($userModel->getUserMails());
//        echo '</pre>';
//
//        echo '<pre style="border: 1px solid red">';
//        print_r($userModel->getUsers());
//        echo '</pre>';
//
//        echo '<pre style="border: 1px solid red">';
//        print_r($userModel->getUserById(2));
//        echo '</pre>';
//
//        echo '<pre style="border: 1px solid red">';
//        print_r($userModel->getUserIdByMail('m@uli.io'));
//        echo '</pre>';

        $this->view->assign('headline', 'This is the headline of the test action');
        $this->view->assign('content', 'This test was successful!');
    }


    public function override()
    {
        $this->view->assign('headline', 'Now wie use the index/index.php to show the content of the override action');
        $this->view->loadTemplate('index/index.php');
    }
}