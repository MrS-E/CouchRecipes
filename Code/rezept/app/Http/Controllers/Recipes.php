<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Recipes extends Controller
{
    public function index(Request $request){

        return view('home', [
            'recipes'=>['asd','fgh','ioer']
        ]);
    }
}
