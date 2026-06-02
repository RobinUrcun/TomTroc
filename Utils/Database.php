<?php

class Database
{
    private ?PDO $pdo = null;

    public function __construct()
    {

        if (!$this->pdo) {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=tom_troc;charset=utf8",
                "root",
                "root"
            );
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
