<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\couchDB;

class Comments extends Controller
{
    public function add(Request $request, $id){
        $couchdb = new couchDB();
        $doc = $couchdb->get($id);
        if(isset($request->name) && isset($request->message) && isset($request->score)) {
            if (isset($doc->comment)) {
                array_push($doc->comment, ["author"=>$request->name, "value"=>$request->message, "score"=>$request->score, "date"=>(date("Y-m-d")." ".date("h:i:s"))]);
            }else{
                $doc->comment = [["author"=>$request->name, "value"=>$request->message, "score"=>$request->score, "date"=>(date("Y-m-d")." ".date("h:i:s"))]];
            }
            $couchdb->update($id, $doc);
        }
        return redirect("/recipe/".$id);
    }
}
