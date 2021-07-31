<?php
namespace Controller;

use Factory\Repository\MysqlRepositoryFactory;
use Repository\Emails\EmailsMysqlRepository;
use Model\Emails\Emails;

class SubscribeController
{
    /**
     * @var EmailsMysqlRepository
     */
    private $emailsRepository;

    public function __construct()
    {
        $this->emailsRepository = (new MysqlRepositoryFactory)->create(EmailsMysqlRepository::class);
    }

    /**
     * Executes action
     */
    public function execute()
    {
        if (filter_var($this->checkData($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $email = new Emails($_POST['email'], date('Y-m-d H:i:s'));
            $this->emailsRepository->store($email);
            header('Location: /?page=subscribed');
        } else {
            header('Location: /?page=index&status=failed');
        }
    }

    public function checkData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}