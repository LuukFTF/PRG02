<?php namespace StudentsList\SchoolClasses;

/**
 * Class CMGTClass
 */
class CMGTClass implements HRClass
{
    public $name = "Advanced Group";
    public $slogan = "We rock!";
    private $students = [];
    const MAX_STUDENTS = 16;

    /**
     * @return array
     */
    public function getStudents(): array
    {
        return $this->students;
    }

    /**
     * Retrieve students from DB
     *
     * @param $students
     * @throws \Exception
     */
    public function addStudents($students): void
    {
        $this->students = $students;

        if ($this->getTotalStudents() > self::MAX_STUDENTS) {
            throw new \Exception("Too many students!");
        }
    }

    /**
     * @return int
     */
    public function getTotalStudents(): int
    {
        return count($this->students);
    }
}
