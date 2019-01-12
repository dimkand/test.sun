<?php

abstract class Component
{
    public function __get($class_name)
    {
        $class_name = ucfirst($class_name);
        return new $class_name;
    }
}