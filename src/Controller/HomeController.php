<?php

namespace App\Controller;

class HomeController {
    function index(){
        echo view('home');
        //view ('users.index')
    }
}
