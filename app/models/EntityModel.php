<?php
namespace TrackLab\Models;

class EntityModel {

    /**
     * Get model Id
     * @return String
     */
    public function getId() {
        return $this->_id->{'$id'};
    }
    /**
     * Set model Id
     * @param $id
     */
    public function setId($id) {
        if (get_class($id) == "MongoId") {
            $this->_id = $id;
        } else {
            $this->_id = new \MongoId($id);
        }
    }
}
