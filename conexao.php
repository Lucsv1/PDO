<?php

use Alura\Pdo\Infra\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

echo 'con';

$pdo->exec('CREATE TABLE students (
    id INTEGER PRIMARY KEY , 
    name TEXT,
    birth_date TEXT 
)');