<?php

class Database_pdo implements Database_driver {

    protected $_db = null;
    protected $_config;

    var $query;
    var $last_sql;

    public function __construct($registry) {
        $this->_config = $registry->db_config;
        $this->_connect();
    }

    private function _connect() {
        try {
            $this->_db = new \PDO('mysql:host='.$this->_config['db_host'].';dbname='.$this->_config['db_name'], $this->_config['db_username'], $this->_config['db_password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function __destruct() {
        $this->_db = null;
    }

    public function query($sql) {
       $this->last_sql = $sql;

       return $this->_db->query($sql);
    }

    public function getArray($sql) {
       $this->last_sql = $sql;
       $this->query = $this->_db->query($sql);

       return $this->query->fetch();
    }
}
