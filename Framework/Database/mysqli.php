<?php

namespace Framework;

class Database_mysqli implements  Database_driver {

    protected $_db;
    protected $_config;

    var $last_query;
    var $last_sql;

    public function __construct($registry) {
        $this->_config = $registry->db_config;
        $this->_connect();
    }

    private function _connect() {
        try
        {
             $this->_db = mysqli_connect($this->_config['db_host'], $this->_config['db_username'], $this->_config['db_password']);
                if (!$this->_db)
                {
                 throw new Exception('MySQL Connection Database Error: ' . mysql_error());
             }
             mysqli_select_db($this->_db, $this->_config['db_name']);
             $this->_query("SET NAMES ".$this->_config['db_charset']);
        }
        catch (Exception $e)
        {
                echo $e->getMessage();
        }
    }

    function __destruct()
    {
        @mysqli_close($this->_db);
    }

    private function _query($sql)
    {
        $this->last_sql = $sql;
        $this->last_query = mysqli_query($this->_db, $sql);

        return;
    }

    public function query($sql)
    {
        $this->_query($sql);

        return $this->last_query;
    }

    public function exec($sql)
    {
        $this->_query($sql);

        return $this->last_query;
    }

    public function getArray($sql)
    {
        $this->_query($sql);

        return mysqli_fetch_array($this->last_query);
    }

    public function getCount($sql)
    {
        $this->_query($sql);

        return mysqli_num_rows($this->last_query);
    }

}
