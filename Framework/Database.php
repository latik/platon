<?php

namespace Framework;

class Database {

    protected $_db;
    protected $_drv_name;
    protected $registry;

    public function __construct(Registry $registry) {

        $this->registry = $registry;

        $db_config = $this->registry->db_config;

        $this->_drv_name  = 'Framework\\Database_' . $db_config['db_type'];

    }

    public function __call($name, $arg) {

        try
        {
            if (!isset($this->_db))
            {
                $this->_db = new $this->_drv_name($this->registry);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

        return ($this->_db->$name($arg[0]));
    }
}
