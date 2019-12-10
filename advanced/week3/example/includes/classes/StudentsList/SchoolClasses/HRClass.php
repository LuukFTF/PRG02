<?php namespace StudentsList\SchoolClasses;

/**
 * Interface HRCLass
 */
interface HRClass
{
    /**
     * @param $students
     */
    public function addStudents($students): void;

    /**
     * @return array
     */
    public function getStudents(): array;
}
