<?php namespace System\MusicCollection;

/**
 * Class Album
 * @package System\MusicCollection
 */
class Album
{
    public $id;
    public $name;
    public $artist;
    public $genre;
    public $year;
    public $tracks;
    public $image;

    /**
     * @param \PDO $db
     * @return bool
     */
    public function update($db): bool
    {
        $query = "UPDATE albums
                  SET name = :name, artist = :artist, genre = :genre, year = :year, tracks = :tracks, image = :image
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':name' => $this->name,
            ':artist' => $this->artist,
            ':genre' => $this->genre,
            ':year' => $this->year,
            ':tracks' => $this->tracks,
            ':image' => $this->image,
            ':id' => $this->id
        ]);
    }

    /**
     * @param \PDO $db
     * @return bool
     */
    public function delete($db): bool
    {
        $query = "DELETE FROM albums
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([':id' => $this->id]);
    }
}
