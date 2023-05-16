<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\couchDB;


class Recipes extends Controller
{
    public function index(Request $request){
        $couchdb = new couchDB();
        echo $couchdb->auth();
        echo $couchdb->get("*");
        /*return view('home', [
            'recipes'=>['asd','fgh','ioer']
        ]);*/
    }
}
