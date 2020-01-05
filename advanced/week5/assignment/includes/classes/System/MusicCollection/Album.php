<?php namespace System\MusicCollection;

/**
 * Class Album
 * @package System\MusicCollection
 */
class Album
{
    public $id, $user_id, $name, $artist, $genre, $year, $tracks, $image;

    /**
     * @param \PDO $db
     * @return bool
     */
    public function update(\PDO $db): bool
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
    public function delete(\PDO $db): bool
    {
        $query = "DELETE FROM albums
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([':id' => $this->id]);
    }

    /**
     * Save a album to the database
     *
     * @param Album $album
     * @param \PDO $db
     * @return bool
     */
    static public function add(Album $album, \PDO $db): bool
    {
        $query = "INSERT INTO albums (user_id, name, artist, genre, year, tracks, image)
                  VALUES (:user_id, :name, :artist, :genre, :year, :tracks, :image)";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':user_id' => $album->user_id,
            ':name' => $album->name,
            ':artist' => $album->artist,
            ':genre' => $album->genre,
            ':year' => $album->year,
            ':tracks' => $album->tracks,
            ':image' => $album->image
        ]);
    }

    /**
     * Get all albums from the database
     *
     * @param \PDO $db
     * @return array
     */
    static public function getAll(\PDO $db): array
    {
        return $db->query("SELECT * FROM albums")->fetchAll(\PDO::FETCH_CLASS, "System\\MusicCollection\\Album");
    }

    /**
     * Get a specific album by its ID
     *
     * @param int $id
     * @param \PDO $db
     * @return Album
     * @throws \Exception
     */
    static public function getById(int $id, \PDO $db): Album
    {
        $statement = $db->prepare("SELECT * FROM albums WHERE id = :id");
        $statement->execute([':id' => $id]);

        if (($album = $statement->fetchObject("System\\MusicCollection\\Album")) === false) {
            throw new \Exception("Album ID is not available in the database");
        }

        return $album;
    }
}
