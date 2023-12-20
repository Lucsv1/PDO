<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use Alura\Pdo\Infra\Repository\PdoStudentRepository;

require_once 'vendor\autoload.php';

$conection = ConnectionCreator::createConnection();

$pdo = new PdoStudentRepository($conection);

$conection->beginTransaction();

try {

    $students = new Student(null, 'Maria', new DateTimeImmutable('2013-04-02'));
    $pdo->saveStudent($students);

    $students2 = new Student(null, 'Joana', new DateTimeImmutable('2002-02-09'));
    $pdo->saveStudent($students2);

    if($conection->commit()){
        echo "alunos inseridos";
    }
}catch (RuntimeException $e){
    echo $e->getMessage();
    $conection->rollBack();
}

$conection->rollBack();