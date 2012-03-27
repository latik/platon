<?php

namespace Framework;

interface Database_driver {

    public function query($sql);
    public function getArray($sql);

}