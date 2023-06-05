<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\couchDB;
use Illuminate\Support\Facades\Auth;

class Comments extends Controller
{
    public function add(Request $request, $id){
        $couchdb = new couchDB();
        $user = Auth::user();
        $doc = $couchdb->get($id);
        if(isset($request->message) && isset($request->score)) {
            if (isset($doc->comment)) {
                array_push($doc->comment, ["author"=>$user->name, "value"=>$request->message, "score"=>$request->score, "date"=>(date("Y-m-d")." ".date("h:i:s"))]);
            }else{
                $doc->comment = [["author"=>$request->name, "value"=>$request->message, "score"=>$request->score, "date"=>(date("Y-m-d")." ".date("h:i:s"))]];
            }
            $couchdb->update($id, $doc);
        }
        return redirect("/recipe/".$id);
    }
}
