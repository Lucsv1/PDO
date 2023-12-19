<?php

namespace Alura\Pdo\Infra\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use PDO;

class PdoStudentRepository implements StudentRepository
{

    private \PDO $connection;

    public function __construct( PDO $concection
    )
    {
        $this->connection = $concection;
    }

    public function allStudents(): array
    {
        $statement = $this->connection->query("SELECT * FROM students");
        $studants = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $studentList = [];
        foreach ($studants as $alunos){
            $studentList[] = new Student(
                $alunos['id'],
                $alunos['name'],
                new \DateTimeImmutable($alunos['birthDate'])
            );
        }
        return $studentList;
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {

    }

    public function saveStudent(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students(id, name, birh_date) VALUES (?,?,?)";
        $statement = $this->connection->prepare($sqlInsert);
        $statement->bindValue(1, $student->id);
        $statement->bindValue(2, $student->name);
        $statement->bindValue(3, $student->birthDate->format('Y-m-d'));
        return $statement->execute();
    }

    public function remove(Student $student): bool
    {
        $sqlDelete = "DELETE FROM students WHERE id = ?";
        $statement = $this->connection->prepare($sqlDelete);
        $statement->bindValue(1, $student->id);
        return $statement->execute();
    }
}