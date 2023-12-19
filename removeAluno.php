<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use Alura\Pdo\Infra\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$modelo = new PdoStudentRepository($pdo);
$student = new Student(1, '');
if ($modelo->remove($student)){
    echo "usurio removido";
};




