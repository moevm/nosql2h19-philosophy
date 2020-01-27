<?php

namespace App;

use GraphAware\Neo4j\Client\Client;
use GraphAware\Neo4j\Client\ClientBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ph extends Model
{
    /**
     * get client
     * @return Client|\GraphAware\Neo4j\Client\ClientInterface
     */
    private static function getClint()
    {
        $client = ClientBuilder::create()
            ->addConnection('default', 'http://neo4j:123@localhost:7474') // Example for HTTP connection configuration (port is optional)
            ->addConnection('bolt', 'bolt://neo4j:123@localhost:7687') // Example for BOLT connection configuration (port is optional)
            ->build();
        /** @var Client $client */
        return $client;
    }


    /**
     * run neo4j request
     * @param $query
     * @return \GraphAware\Common\Result\Result|null
     */
    private static function runQuery($query)
    {
        $client = self::getClint();
        return $client->run($query);
    }

    /**
     * export
     */
    public static function download_db()
    {
        $result['Philosopher'] = [];
        $q = "MATCH (n) RETURN n.name LIMIT 25";
        $res = self::runQuery($q);
        foreach ($res->records() as $r) {
            foreach ($r->values() as $i => $value) {
                array_push($result['Philosopher'], $value);
            }
        }
        Storage::put(str_random(15) . '-export.json', json_encode($result));
    }


    /**
     * clear db
     */
    public static function drop_db()
    {
        $q = "MATCH (n) DETACH DELETE n";
        self::runQuery($q);
    }


    /**
     * import
     * @param $data
     */
    public static function import($data)
    {
        foreach ($data['Philosopher'] as $name => $value) {
            self::add_philop($name, $value['info']);
        }
        foreach ($data['School'] as $name => $value) {
            self::add_school($name, $value['info']);
        }
    }

    public static function import_def($data)
    {
        foreach ($data['def'] as $k=>$v){
            self::add_def($k,$v['info'],$v['author'],$v['child']);
        }
    }

    public static function add_def($name, $info, $author='',$child=[])
    {
        $query = "MATCH (n:Definitions) where n.name = '" . $name . "' RETURN n";
        if (empty(self::runQuery($query)->records())) {
            $q = "CREATE (a:Definitions { name : '" . $name . "', info : '" . $info . "'})";
            self::runQuery($q);
        }

        if ($author){
            $query = "MATCH p=(a:Philosopher {name:'" . $author . "'})-[r:school]->(b:School{name:'" . $name . "'}) RETURN p";
            if (empty(self::runQuery($query)->records())){
                $q = "MATCH (a:Philosopher {name:'" . $author . "'}), (b:Definitions {name:'" . $name . "'}) CREATE (a)-[:def]->(b)";
                self::runQuery($q);
            }
            $query = "MATCH p=(b:School{name:'" . $name . "'})-[r:school]->(a:Philosopher {name:'" . $author . "'}) RETURN p";
            if (empty(self::runQuery($query)->records())){
                $q = "MATCH (a:Philosopher {name:'" . $author . "'}), (b:Definitions {name:'" . $name . "'}) CREATE (a)-[:def]->(b)";
                self::runQuery($q);
            }
        }

        if (!empty($child)){
            foreach ($child as $c){
                $q = "MATCH (a:Definitions {name:'" . $name . "'}), (b:Definitions {name:'" . $c . "'}) CREATE (a)-[:def_c]->(b)";
                self::runQuery($q);
            }
        }
        return true;
    }




    /**
     * add philop
     * @param $name
     * @param $info
     * @param string $school
     * @return bool
     */
    public static function add_philop($name, $info, $school = '')
    {
        $query = "MATCH (n:Philosopher) where n.name = '" . $name . "' RETURN n";
        if (empty(self::runQuery($query)->records())) {
            $q = "CREATE (a:Philosopher { name : '" . $name . "', info : '" . $info . "'})";
            self::runQuery($q);
            return true;
        }
        if ($school) {
            $q = "MATCH p=(a:Philosopher {name:'" . $name . "'})-[r:school]->(b:School{name:'" . $school . "'}) RETURN p";
            if (empty(self::runQuery($q)->records())) {
                $query = "MATCH (a:Philosopher {name:'" . $name . "'}), (b:School {name:'" . $school . "'}) CREATE (a)-[:school]->(b)";
                self::runQuery($query);
            }
            $q = "MATCH p=(b:School{name:'" . $school . "'})-[r:school]->(a:Philosopher {name:'" . $name . "'}) RETURN p";
            if (empty(self::runQuery($q)->records())) {
                $query = "MATCH (b:School{name:'" . $school . "'}),(a:Philosopher {name:'" . $name . "'}) CREATE (b)-[:school]->(a)";
                self::runQuery($query);
            }

        }
        return true;
    }

    public static function add_school($name, $info, $philops = [])
    {
        $query = "MATCH (n:School) where n.name = '" . $name . "' RETURN n";
        if (empty(self::runQuery($query)->records())) {
            $q = "CREATE (a:School { name : '" . $name . "', info : '" . $info . "'})";
            self::runQuery($q);
        }
        foreach ($philops as $ph) {
            $q = "MATCH p=(b:School{name:'" . $name . "'})-[r:school]->(a:Philosopher {name:'" . $ph . "'}) RETURN p";
            if (empty(self::runQuery($q)->records())){
                $query = "MATCH (a:School {name:'" . $name . "'}), (b:Philosopher {name:'" . $ph . "'}) CREATE (a)-[:school]->(b)";
                self::runQuery($query);
            }
            $q = "MATCH p=(a:Philosopher {name:'" . $ph . "'})-[r:school]->(b:School{name:'" . $name . "'}) RETURN p";
            if (empty(self::runQuery($q)->records())){
                $query = "MATCH (a:School {name:'" . $name . "'}), (b:Philosopher {name:'" . $ph . "'}) CREATE (b)-[:school]->(a)";
                self::runQuery($query);
            }
        }
        return true;
    }

    public static function get_all_school()
    {
        $query = "MATCH (n:School) RETURN n";
        $result = self::runQuery($query);
        $school = [];
        foreach ($result->records() as $ph) {
            $school[] = $ph->get('n')->value('name');
        }
        return $school;
    }

    public static function get_all_philop()
    {
        $query = "MATCH (n:Philosopher) RETURN n";
        $result = self::runQuery($query);
        $school = [];
        foreach ($result->records() as $ph) {
            $school[] = $ph->get('n')->value('name');
        }
        return $school;
    }

    public static function get_all_def(){
        $query = "MATCH (n:Definitions) RETURN n";
        $result = self::runQuery($query);
        $def=[];
        foreach ($result->records() as $d){
            $def[$d->get('n')->value('name')]['info']=$d->get('n')->value('info');
        }
        foreach ($def as $k=>$v){
            $q = 'MATCH p=(a:Definitions {name:"' .$k. '"})-[r:def_c]->(b:Definitions) RETURN b';
            if (!empty(self::runQuery($q)->records())){
                foreach (self::runQuery($q)->records() as $ch){
                    $def[$k]['child'][$ch->get('b')->value('name')]['info']=$ch->get('b')->value('info');
                }
            }
        }
        return $def;
    }

    /**
     * get philosopher
     * @param $data
     * @return array
     */
    public static function get_philop($data)
    {
        $query = "MATCH (n:Philosopher) where n.name = '" . $data["name"] . "' RETURN n";
        $result = self::runQuery($query);
        $philop = [];
        foreach ($result->records() as $ph) {
            $philop[$ph->get('n')->value('name')]['info'] = $ph->get('n')->value('info');
        }
        if ($data['with_school'] == 1) {
            $q = 'MATCH p=(a:Philosopher {name:"' . $data['name'] . '"})-[r:school]->(b:School) RETURN b';
            foreach (self::runQuery($q)->records() as $school) {
                $philop[$data['name']]['school'][] = $school->get('b')->value('name');
            }
        }
        if ($data['with_defin'] == 1) {
            $q = 'MATCH p=(a:Philosopher {name:"' . $data['name'] . '"})-[r:def]->(b:Definitions) RETURN b';
            foreach (self::runQuery($q)->records() as $def) {
                $philop[$data['name']]['def'][ $def->get('b')->value('name')] = $def->get('b')->value('info');
            }
        }
        return $philop;
    }




    public static function get_sch($data)
    {
        $result = [];
        if ($data['oper'] == 3) {
            $q = 'MATCH p=(a:School)-[r:school]->(b:Philosopher {name:"' . $data['ph'] . '"}) RETURN a';
            foreach (self::runQuery($q)->records() as $record) {
                $result[$record->get('a')->value('name')]['info'] = $record->get('a')->value('info');
            }
        } elseif ($data['oper'] == 2) {
            $q = 'MATCH p=(a:School {name:"' . $data['sh'] . '"})-[r:school]->(b:Philosopher) RETURN a';
            foreach (self::runQuery($q)->records() as $record) {
                $result[$record->get('a')->value('name')]['info'] = $record->get('a')->value('info');
            }
            $q = "MATCH (n:School)-[r:school]->(a:Philosopher) WHERE n.name = '" . $data['sh'] . "' RETURN COUNT(r) as count";
            foreach (self::runQuery($q)->records() as $record) {
                $result[$data['sh']]['count'] = $record->get('count');
            }
        } elseif ($data['oper'] == 1) {
            $q = 'MATCH (s:School)-[:school]->(p:Philosopher) WITH s,count(p) as count, collect(s) as ss WHERE count > ' . $data['countic'] . ' RETURN ss';
            foreach (self::runQuery($q)->records() as $record) {
                $result[$record->get('ss')[0]->value('name')]['info'] = $record->get('ss')[0]->value('info');
            }
        }
        return $result;
    }

    /**
     *
     */
    public static function add_Connection()
    {
        $query = "MATCH (n:Philosopher {name:'Денис'}), (b:Philosopher {name:'Тима'}) CREATE (n)-[:friends]->(b)";
        $q = "MATCH (n)-[r]-() RETURN type(r)";
        $res = self::runQuery($q);
        dd($res);
    }


}
