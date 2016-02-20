<?php

namespace TrackLab\Models;

class ModelBase extends \Phalcon\Mvc\Collection
{

    /**
     * Получение Id записи
     * @return String
     */
    public function getId()
    {
        return $this->_id->{'$id'};
    }

    public function setDb($dbname)
    {
        $this->setSchema($dbname);
    }

}
