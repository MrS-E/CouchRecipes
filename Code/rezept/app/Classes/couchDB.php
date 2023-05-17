<?php

namespace App\Classes;

use GuzzleHttp\Client;

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
    public function get($id)
    {
        switch ($id){
            case "*":
                $uri = "http://".$this->user.":".$this->passwd."@".$this->server."/".$this->db."/_all_docs?include_docs=true";
                break;
            default:
                $uri = "http://".$this->user.":".$this->passwd."@".$this->server."/".$this->db."/".$id;
        }
        $client = new Client();
        return json_decode($client->request('GET', $uri)->getBody());
    }
    public function insert($id, $object){
        $object = json_encode($object, JSON_PRETTY_PRINT);
    }
    public function delete($id){

    }
    public function update($id, $change){

    }
    public function search($search){

    }

}
