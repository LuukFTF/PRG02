<?php namespace MusicCollection;

/**
 * Class Album
 * @package MusicCollection
 */
class Album
{
    public $name;
    public $artist;
    public $genre;
    public $year;
    public $tracks;

    /**
     * Initialize object
     *
     * @param $name
     * @param $artist
     * @param $genre
     * @param $year
     * @param $tracks
     */
    public function __construct($name, $artist, $genre, $year, $tracks)
    {
        $this->name = $name;
        $this->artist = $artist;
        $this->genre = $genre;
        $this->year = $year;
        $this->tracks = $tracks;
    }
} 
