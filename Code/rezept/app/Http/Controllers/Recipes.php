<?php

namespace App\Http\Controllers;

use App\Classes\couchDB;
use Exception;
use Illuminate\Http\Request;

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
    public function create(Request $request){
        try {
            $couchdb = new couchDB();
            $inc = [];
            $incr = explode("/", $request->ingredient);
            for ($i = 0; $i < sizeof($incr) - 1; $i++) {
                array_push($inc, [
                    "name" => explode(",", $incr[$i])[0],
                    "percent" => floatval(explode(",", $incr[$i])[1])
                ]);
            }
            $data = [
                "name" => isset($request->name) ? $request->name : throw new Exception("required"),
                "category" => isset($request->category) ? $request->category : throw new Exception("required"),
                "date" => (date("Y-m-d") . " " . date("h:i:s")),
                "manual" => isset($request->manuel) ? $request->manuel : throw new Exception("required"),
                "image" => isset($request->img) ? $request->img : throw new Exception("required"),
                "ingredient" => $inc,
            ];
            return redirect("/recipe/" . $couchdb->insert($data));
        }catch (Exception $e){
            return redirect("/");
        }
    }
}
