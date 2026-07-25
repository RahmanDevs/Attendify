<?php

namespace App\Controllers;

class Home extends BaseController
{   
    // Controller View
    public function index(): string
    {
        return view('LandingPage');
    }
}
