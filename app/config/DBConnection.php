<?php

abstract class DBconnection
{
    protected static $db;

    public function __construct()
    {
        if (self::$db === null) {
            self::$db = new Database();
        }
    }

    protected function getDB()
    {
        return self::$db;
    }
}