<?php

namespace Alura\Pdo\Infra\Repository;

use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use http\Exception\RuntimeException;
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
            $studentList[] = $estudante = new Student(
                $alunos['id'],
                $alunos['name'],
                new \DateTimeImmutable($alunos['birthDate'])
            );
            $this->fillPhonesOf($estudante);
            $studentList[] = $estudante;
        }
        return $studentList;
    }

    private function fillPhonesOf(Student $student): void
    {
        $sqlQuery = 'SELECT id, area_code, number FROM phones WHERE student_id = ?';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $student->id, PDO::PARAM_INT);
        $stmt->execute();

        $phoneDataList = $stmt->fetchAll();
        foreach ($phoneDataList as $phoneData ){
            $phone = new Phone(
                $phoneData['id'],
                $phoneData['area_code'],
                $phoneData['number']
            );
            $student->getPhones($phone);
        }
        
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {

    }

    public function saveStudent(Student $student): bool
    {
        $sqlInsert = "INSERT INTO student(id, name, birh_date) VALUES (?,?,?)";
        $statement = $this->connection->prepare($sqlInsert);
        $statement->bindValue(1, $student->id);
        $statement->bindValue(2, $student->name);
        $statement->bindValue(3, $student->birthDate->format('Y-m-d'));
        if ($statement === false){
            throw new \RuntimeException("query ao funfa");
        } else{
            return $statement->execute();
        }

    }

    public function remove(Student $student): bool
    {
        $sqlDelete = "DELETE FROM students WHERE name = ?";
        $statement = $this->connection->prepare($sqlDelete);
        $statement->bindValue(1, $student->name);
        return $statement->execute();
    }
}