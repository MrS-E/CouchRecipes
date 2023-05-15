<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class couchDB
{
    private $server;
    private $user;
    private $passwd;
    private $db;
    function __construct(){
        $port = (env('COUCHDB_PORT') !== null && env('COUCHDB_PORT') !== '')?env("COUCHDB_PORT"):"5984";
        $this->server=(env('COUCHDB_SERVER') !== null && env('COUCHDB_SERVER') !== '')?env("COUCHDB_SERVER").":".$port:"127.0.0.1:".$port;
        $this->user=(env('COUCHDB_USER') !== null && env('COUCHDB_USER') !== '')?env("COUCHDB_USER"):"admin";
        $this->passwd=(env('COUCHDB_PASSWORD') !== null && env('COUCHDB_PASSWORD') !== '')?env("COUCHDB_PASSWORD"):"admin";
        $this->db=(env('COUCHDB_DB') !== null && env('COUCHDB_DB') !== '')?env("COUCHDB_DB"):"";
    }
    public function auth(){
        Http::post('http://'.$this->server.'/_session', [
            'name' => $this->user,
            'password' => $this->passwd,
        ]);
    }
    public function get($id){
        switch ($id){
            case "*":
                $response = Http::get('http://'.$this->server.'/'.$this->db.'/_all_docs');
                break;
            default:
                $response = Http::get('http://'.$this->server.'/'.$this->db.'/'.$id);
        }
        return $response->body();
    }
    public function insert($id, $object){

    }
    public function delete($id){

    }
    public function update($id, $change){

    }
    public function search($search){

    }

}
