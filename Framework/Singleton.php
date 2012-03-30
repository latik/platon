<?php

namespace Framework;

/*
 * Класс-одиночка, для гарантирования того, что только один экземпляр объекта будет существовать.
 * Пример использования:
 * $db1 = Singleton::getInstance();
 * $db2 = Singleton::getInstance();
 * В результате мы получаем экземпляр одного и того же объекта: $db1 === $db2
 */

abstract class Singleton {

    protected function __construct() {
    }

    final private function __clone() {
    }

    final public static function getInstance()
    {
        static $_instances = array();
        $calledClassName = get_called_class();

        if (!isset($_instances[$calledClassName]))
        {
            $_instances[$calledClassName] = new static();
        }

        return $_instances[$calledClassName];
    }

}
