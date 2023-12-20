<?php


namespace Alura\Pdo\Domain\Model;

class Student
{

    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly \DateTimeInterface $birthDate,
        /** @var Phone[] */
        private array $phones = []

    )
    {


    }
    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    /** @return Phone[] */
    public function getPhones(): array
    {
        return $this->phones;
    }


}
