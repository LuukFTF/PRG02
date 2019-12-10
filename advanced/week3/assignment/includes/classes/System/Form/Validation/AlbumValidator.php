<?php namespace System\Form\Validation;

/**
 * Class AlbumValidator
 * @package System\Form\Validation
 */
class AlbumValidator implements Validator
{
    private $errors = [];
    private $album;

    /**
     * AlbumValidator constructor.
     *
     * @param $album
     */
    public function __construct($album)
    {
        $this->album = $album;
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->album->artist == "") {
            $this->errors[] = 'Artist cannot be empty';
        }
        if ($this->album->name == "") {
            $this->errors[] = 'Album cannot be empty';
        }
        if ($this->album->genre == "") {
            $this->errors[] = 'Genre cannot be empty';
        }
        if ($this->album->year == "") {
            $this->errors[] = 'Year cannot be empty';
        }
        if (!is_numeric($this->album->year) || strlen($this->album->year) != 4) {
            $this->errors[] = 'Year needs to be a number with the length of 4';
        }
        if ($this->album->tracks == "") {
            $this->errors[] = 'Tracks cannot be empty';
        }
        if (!is_numeric($this->album->tracks)) {
            $this->errors[] = 'Tracks need to be a number';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
