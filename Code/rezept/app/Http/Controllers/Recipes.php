<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Recipes extends Controller
{
    public function index(){
        return view('home', [
            'recipes'=>['asd','fgh','ioer']
        ]);
    }
}
