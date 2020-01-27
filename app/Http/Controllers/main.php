<?php


namespace App\Http\Controllers;


use GraphAware\Neo4j\Client\Client;
use GraphAware\Neo4j\Client\ClientBuilder;
class main extends Controller
{

public static function get(){
self::getResult(self::getClint());
}

    /**
     * @param Client $client
     */
private static function getResult(Client $client){
    $query = 'MATCH (n:Person) RETURN n';
    $result = $client->run($query);
    foreach ($result->getRecords() as $record) {
        dd($record->get('n')->value('name')) ;
    }
}

private static function getClint(){
    $client = ClientBuilder::create()
        ->addConnection('default', 'http://neo4j:123@localhost:7474') // Example for HTTP connection configuration (port is optional)
        ->addConnection('bolt', 'bolt://neo4j:123@localhost:7687') // Example for BOLT connection configuration (port is optional)
        ->build();
    /** @var Client $client */
    return $client;
}

    /**
     * @param $client
     * @return bool
     */
private static function addAlex($client){
    $client->run('CREATE (n:Person) SET n += {infos}', ['infos' => ['name' => 'Ales', 'age' => 34]]);
    return true;
}


}
