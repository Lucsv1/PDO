<?php

$caminhoBanco =  __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

echo 'con';

$pdo->exec('CREATE TABLE students (
    id INTERGER PRIMARY KEY, 
    name TEXT,
    birth_date TEXT 
)');