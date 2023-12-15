<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$databasePath =  __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$student = new Student(null, 'Lucas Vinicius ', new \DateTimeImmutable('2004-01-21'));

$sqlInsert = "INSERT INTO students(name, birh_date) VALUES ('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";

echo $sqlInsert;

