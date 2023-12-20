<?php

use Alura\Pdo\Infra\Persistence\ConnectionCreator;

$caminhoBanco = __DIR__ . '/banco.sqlite';

$pdo = new PDO('sqlite:' . $caminhoBanco);

$pdo->exec("INSERT INTO PHONES (area_code, number, student_id) VALUES ('11', '99999999', 1)");
exit();


echo 'con';
$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY(student_id) REFERENCES students(id)
    );
';

$pdo->exec($createTableSql);

