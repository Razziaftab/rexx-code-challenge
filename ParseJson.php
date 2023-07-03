<?php

use JsonMachine\Exception\JsonMachineException;
use \JsonMachine\Items;

class ParseJson
{
    const JSON_FILE_PATH = 'Code-Challenge(Sales).json';

    public static function ParseJsonFile(): Items
    {
        try {
            require_once(__DIR__ . '/vendor/autoload.php');
            return Items::fromFile(self::JSON_FILE_PATH);
        } catch (JsonMachineException $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
            die();
        }
    }
}
