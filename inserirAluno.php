<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use Alura\Pdo\Infra\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';


$pdo = ConnectionCreator::createConnection();

$modelo = new PdoStudentRepository($pdo);
$student = new Student(null, 'Jota1', new \DateTimeImmutable('2004-01-21'));
if($modelo->saveStudent($student)){
    echo $modelo->saveStudent($student);
} else{
    throw new \RuntimeException("Erro na query do banco ");
}

//if ($modelo->remove($student)){
//    echo "usurio removido" . PHP_EOL;
//}


