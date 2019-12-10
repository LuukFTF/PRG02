<?php namespace StudentsList\Persons;

/**
 * Class Person
 */
class Person
{
    public $name;
    public $birthDate;

    /**
     * @return string
     */
    public function shoutName(): string
    {
        return $this->name;
    }
}
