<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
        // echo "Hello World!";
    }

    public function coba()
    {
        echo "Hello World!";
    }
}
