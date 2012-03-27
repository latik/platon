<?php

class Model_User extends Framework\Model {

    public function __construct($registry) {
        $this->_db   = $registry->db;
    }

    public function getname($id = 89) {

        $this->_data = $this->_db->getArray('SELECT * FROM users WHERE id = ' . (int)$id .' LIMIT 1');

        return $this->_data['username'];
    }
}
