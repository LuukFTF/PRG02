<?php namespace MusicCollection;

/**
 * Class Albums
 * @package MusicCollection
 */
class Collection
{
    private $albums = [];

    /**
     * @return mixed
     */
    public function getAlbums(): array
    {
        return $this->albums;
    }

    /**
     * @param mixed $albumRaw
     */
    public function addAlbum($albumRaw): void
    {
        $this->albums[] = new Album(...array_values($albumRaw));
    }

    /**
     * @return int
     */
    public function getTotalAlbums(): int
    {
        return count($this->albums);
    }
} 
