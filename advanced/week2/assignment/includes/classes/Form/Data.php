<?php namespace Form;

/**
 * Class Data
 * @package Form
 */
class Data
{
    private $post = [];

    /**
     * Data constructor.
     *
     * @param $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Check if a var exists in the current post state
     *
     * @param $var
     * @return bool
     */
    public function varExists($var): bool
    {
        return array_key_exists($var, $this->post);
    }

    /**
     * Retrieve a var from the post array
     *
     * @param $var
     * @return mixed
     */
    public function getPostVar($var): string
    {
        return htmlentities($this->post[$var]);
    }
}
