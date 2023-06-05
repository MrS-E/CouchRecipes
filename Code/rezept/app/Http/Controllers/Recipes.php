<?php

namespace App\Http\Controllers;

use App\Classes\couchDB;


class Recipes extends Controller
{
    public function home(){
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
    public function search($string){
        $couchdb = new couchDB();
        $search=[
            /*"name" => [
              "\$regex"=> "(?i)".$string
            ],*/
            "ingredient" => [
                "\$elemMatch"=> [
                    "name"=>[
                        "\$regex"=> "(?i)".$string
                    ]
                ]
            ]
        ];
        $recipes = array();
        foreach ($couchdb->search($search)->docs as $re) {
            if(!str_contains($re->_id,"_design")) {
                //echo $re->doc->_id;
                array_push($recipes, $re);
            }
        }
        return view('home', [
            'recipes'=>$recipes
        ]);
    }
    public function add(){
        return view('new_recipe', []);
    }
}
