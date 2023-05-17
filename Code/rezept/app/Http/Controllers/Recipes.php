<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\couchDB;


class Recipes extends Controller
{
    public function home(Request $request){
        $couchdb = new couchDB();
        $recipes = array();

        foreach ($couchdb->get("*")->rows as $re) {
            if(!str_contains($re->doc->_id,"_design")) {
                //echo $re->doc->_id;
                array_push($recipes, $re->doc);
            }
        }

        return view('home', [
            'recipes'=>$recipes
        ]);
    }
    public function recipe($id){
        $couchdb = new couchDB();
        //echo var_dump($couchdb->get($id)->ingredient[0]->percent);
        return view('recipe', [
            'recipe'=>$couchdb->get($id)
        ]);
    }
}
