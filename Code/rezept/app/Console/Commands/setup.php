<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\couchDB;
use App\Classes\files;

class setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup for the couchdb';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = (new files())->get();
        $db = new couchDB();
        //setup
        $db->create();
        $db->insert_by_id("_design/validator", ["validate_doc_update"=>"function(newDoc, oldDoc, userCtx) {function require(field, message) {message = message || \"Document must have a \" + field;if (!newDoc[field]) throw({forbidden : message});}if(newDoc){require(\"name\");require(\"category\");require(\"date\");require(\"ingredient\");require(\"manual\");require(\"image\");}}"]);
        $db->insert_by_id("_design/search", ["fulltext"=>["by_title"=>["index"=>"function(doc) { var ret=new Document(); ret.add(doc.ingredient.name); return ret }"]]]);
        $db->replication(["source"=>["url"=>"http://127.0.0.1:5984/rezepte-stix-simeon","auth"=>["basic"=>["username"=>"admin", "password"=>"admin"]]], "target"=>["url"=>"http://127.0.0.1:5984/rezepte-stix-simeon-repli","auth"=>["basic"=>["username"=>"root","password"=>"toor"]]],"create_target"=>true,"continuous"=>true]);
        //insert
        foreach ($files as $file){
            $db->insert(json_decode($file));
        }
    }
}
