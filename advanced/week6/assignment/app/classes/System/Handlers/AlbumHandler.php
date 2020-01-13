<?php namespace System\Handlers;

use System\Databases\Database;
use System\Form\Data;
use System\MusicCollection\Album;
use System\MusicCollection\Collection;
use System\Utils\Image;

/**
 * Class AlbumHandler
 * @package System\Handlers
 */
class AlbumHandler extends BaseHandler
{
    use AlbumFillAndValidate;

    /**
     * @var Album
     */
    private $album;

    /**
     * @var Data
     */
    private $formData;

    /**
     * @var Database
     */
    private $db;

    /**
     * AlbumHandler constructor.
     * 
     * @param $templateName
     * @throws \ReflectionException
     */
    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }

    protected function index()
    {
        //Create new instance of MusicCollection & set albums
        $albumCollection = new Collection();
        $albumCollection->add(Album::getAll($this->db));

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Home',
            'albums' => $albumCollection->get(),
            'totalAlbums' => $albumCollection->getTotal()
        ]);
    }

    protected function add()
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: login');
            exit;
        }

        //Set default empty album & execute POST logic
        $this->album = new Album();
        $this->executePostHandler();

        //Special check for add form only
        if (isset($this->formData) && $_FILES['image']['error'] == 4) {
            $this->errors[] = 'Image cannot be empty';
        }

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Store image & retrieve name for database saving
            $image = new Image();
            $this->album->image = 'images/' . $image->save($_FILES['image']);

            //Set user id in Album
            $this->album->user_id = $this->session->get('user')->id;

            //Save the record to the db
            if (Album::add($this->album, $this->db)) {
                $success = "Your new album has been added to the database!";
                //Override to see a new empty form
                $this->album = new Album();
            } else {
                $this->logger->error(new \Exception("DB Error: {$this->db->errorInfo()}"));
                $this->errors[] = "Whoops, something went wrong adding the album";
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Add album',
            'album' => $this->album ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit()
    {
        try {
            //Get the record from the db & execute POST logic
            $this->album = Album::getById($_GET['id'], $this->db);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //If image is not empty, process the new image file
                if ($_FILES['image']['error'] != 4) {
                    //Init image class
                    $image = new Image();

                    //Remove old image
                    $image->delete($this->album->image);

                    //Store new image & retrieve name for database saving (override current image name)
                    $this->album->image = 'images/' . $image->save($_FILES['image']);
                }

                //Save the record to the db
                if ($this->album->update($this->db)) {
                    $success = "Your album has been updated in the database!";
                } else {
                    $this->logger->error(new \Exception("DB Error: {$this->db->errorInfo()}"));
                    $this->errors[] = "Whoops, something went wrong updating the album";
                }
            }

            $pageTitle = 'Edit ' . $this->album->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = "Whoops: " . $e->getMessage();
            $pageTitle = 'Album does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'album' => $this->album ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function detail()
    {
        try {
            //Get the records from the db
            $album = Album::getById($_GET['id'], $this->db);

            //Default page title
            $pageTitle = $album->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $errors[] = $e->getMessage();
            $pageTitle = 'Album does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'album' => $album ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete()
    {
        try {
            //Get the record from the db
            $album = Album::getById($_GET['id'], $this->db);

            //Database magic when no errors are found
            if ($album) {
                //Init image class
                $image = new Image();

                //Save the record to the db
                $album->delete($this->db);

                //Remove image
                $image->delete($album->image);

                //Redirect to homepage after deletion & exit script
                header("Location: " . BASE_PATH);
                exit;
            }
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header("Location: " . BASE_PATH);
            exit;
        }
    }
}
