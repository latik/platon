<?php

namespace Framework;

/*
 * Класс для предоставляет "магические" методы для доступа переменным. 
 * Позволяет прозрачно работать со свойствами объектов.
 * Пример:
 * $user = new Storage();
 * Cохраняем в ранее неописанное свойство name
 * $user->name = 'Ваня';
 * Получаем свойство name
 * echo $user->name;
 */

class Storage {

    protected $_data = array();

    public function __get($key) {
        if (array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }
        else

            return null;
    }

    public function __set($key, $value) {
        $this->_data[$key] = $value;
    }
}
