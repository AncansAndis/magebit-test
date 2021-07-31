<?php
namespace Repository\Emails;

use Model\Emails\Emails;
use PDO;
use Repository\AbstractMysqlRepository;

class EmailsMysqlRepository extends AbstractMysqlRepository
{
    /**
     * @var PDO
     */
    private $database;

    public function __construct(PDO $pdo)
    {
        $this->database = $pdo;
    }

    public function store(Emails $email)
    {
        $query = $this->database->prepare("INSERT INTO `emails` (`email`, `date_created`) VALUES (:email, :date_created)");
        $query->execute([
            'email' => $email->getEmail(),
            'date_created' => $email->getDateCreated()
        ]);
    }

    public function fetchAll()
    {
        $query = $this->database->prepare("SELECT * FROM `emails` ORDER BY `date_created`");
        $query->execute();
        $items = $query->fetchAll();

        $result = null;
        foreach ($items as $item)
        {
            $result[] = (new Emails($item['id'], $item['email'], $item['date_created']));
        }

        return $result;
    }

    public function removeById($id)
    {
        $query = $this->database->prepare('DELETE FROM `emails` WHERE `id` = :id');
        $query->execute(['id' => $id]);
    }

    public function fetchAllByAttr($attr)
    {
        $query = $this->database->prepare("SELECT * FROM `emails` ORDER BY " . $attr);
        $query->execute();
        $items = $query->fetchAll();

        $result = null;
        foreach ($items as $item)
        {
            $result[] = (new Emails($item['id'], $item['email'], $item['date_created']));
        }

        return $result;
    }

    public function fetchAllByString($attr)
    {
        $query = $this->database->prepare("SELECT * FROM `emails` WHERE `email` LIKE '" . $attr . "' ORDER BY `date_created` ");
        $query->execute();
        $items = $query->fetchAll();

        $result = null;
        foreach ($items as $item)
        {
            $result[] = (new Emails($item['id'], $item['email'], $item['date_created']));
        }

        return $result;
    }

    public function selectMultiple($stringToSelect)
    {
        $query = $this->database->prepare("SELECT * FROM `emails` WHERE `id` IN (" . $stringToSelect . ") ORDER BY `date_created`");
        $query->execute();
        $items = $query->fetchAll();

        $result = null;
        foreach ($items as $item)
        {
            $result[] = (new Emails($item['id'], $item['email'], $item['date_created']));
        }

        return $result;
    }
}