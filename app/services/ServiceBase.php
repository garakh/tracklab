<?php

namespace TrackLab\Services;

class ServiceBase
{

    /**
     * @param string $collection
     * @param array $search_fields
     * @return array
     */
    public function find($collection, $search_fields = array())
    {
        $mongoCollection = $this->getMongoCollection($collection);

        $cursor = $mongoCollection->find($search_fields);
        return iterator_to_array($cursor);
    }

    /**
     * @param string $collection
     * @param array $search_fields
     * @return array
     */
    public function findFirst($collection, $search_fields = array())
    {
        $mongoCollection = $this->getMongoCollection($collection);

        $item = $mongoCollection->findOne($search_fields);
        return $item;
    }

    public function getMongoCollection($collection)
    {
        $mongo = new \MongoClient($this->config->mongo->connectionString);
        $mongoDb = $mongo->selectDb($this->config->mongo->dbname);
        $mongoCollection = new \MongoCollection($mongoDb, $collection);
        return $mongoCollection;
    }

    public function getDB()
    {
        $mongo = new \MongoClient($this->config->mongo->connectionString);
        $mongoDb = $mongo->selectDb($this->config->mongo->dbname);
        return $mongoDb;
    }

}
