<?php

namespace App\Classes;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

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
        try {
            return json_decode($client->request('GET', $uri)->getBody());
        }
        catch (ClientException $e){
            error_log($e);
            unset($client);
            abort(404);
        }
        catch (ServerException|BadResponseException|Exception $e) {
            error_log($e);
            unset($client);
            abort(500);
        }

    }
    public function search($search){
        $client = new Client();
        $uri = "http://".$this->user.":".$this->passwd."@".$this->server."/".$this->db."/_find";
        try {
            return json_decode($client->request('POST', $uri, ['json' => ["selector" => $search]])->getBody());
        }
        catch (ClientException $e){
            error_log($e);
            unset($client);
            abort(404);
        }
        catch (ServerException|BadResponseException|Exception $e) {
            error_log($e);
            unset($client);
            abort(500);
        }
    }

    public function insert($object){
        $docs = $this->get("*");
        //$last_id = $docs->rows[sizeof($docs->rows)-3]->id;
        $url = "http://".$this->user.":".$this->passwd."@".$this->server."/".$this->db."/";
        $client = new Client();
        try {
            return json_decode($client->request('POST', $url, ['json'=>$object])->getBody())->id;
        }
        catch (ClientException $e){
            error_log($e);
            unset($client);
            abort(404);
        }
        catch (ServerException|BadResponseException|Exception $e) {
            error_log($e);
            unset($client);
            abort(500);
        }
    }
    public function delete($id){

    }
    public function update($id, $object){
        $client = new Client();
        $uri = "http://".$this->user.":".$this->passwd."@".$this->server."/".$this->db."/".$id;
        if(isset($object->_id)) unset($object->_id);
        if(isset($object->_rev)) unset($object->_rev);
        $object = json_decode(json_encode($object), true);
        try {
            return $client->request('PUT', $uri, ['json' => array_merge(["_id"=>$id,"_rev"=>$this->get($id)->_rev], $object)])->getStatusCode();
        }
        catch (ClientException $e){
            error_log($e);
            unset($client);
            abort(500);
        }
    }
}
